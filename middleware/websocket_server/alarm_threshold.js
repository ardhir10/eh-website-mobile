const axios = require('axios');
require('dotenv').config({ path: '../../.env' });


// Cache for alarm settings
let alarmSettingsCache = null;
let lastFetchTime = 0;
const CACHE_DURATION = 5 * 60 * 1000; // 5 minutes

// Add a cache to track triggered alarms
let triggeredAlarms = new Map(); // Store parameter + site_token -> trigger state
let activeAlarms = new Map(); // Store currently active alarms

async function getAlarmSettings() {
  try {
    // Return cached settings if they're still valid
    if (alarmSettingsCache && (Date.now() - lastFetchTime) < CACHE_DURATION) {
      return alarmSettingsCache;
    }


    const response = await axios.get(`${process.env.APP_URL}/api/alarm-settings`, {
      timeout: 5000 // 5 second timeout
    });


    if (response.data.success) {
      alarmSettingsCache = response.data.data;
      lastFetchTime = Date.now();
      return alarmSettingsCache;
    }
    
    // If API call successful but returned error
    console.warn('Failed to fetch alarm settings:', response.data.message);
    return alarmSettingsCache || []; // Return cached data or empty array
    
  } catch (error) {
    // Log error but don't throw
    console.error('Error fetching alarm settings:', error.message);
    return alarmSettingsCache || []; // Return cached data or empty array
  }
}

function evaluateCondition(value, formula, setPoint) {
  switch (formula) {
    case '>': return value > setPoint;
    case '>=': return value >= setPoint;
    case '<': return value < setPoint;
    case '<=': return value <= setPoint;
    case '=': return value === setPoint;
    default: return false;
  }
}

async function checkThresholds(data,io) {
  const alarms = [];
  const normalStates = [];
  const listActiveAlarms = []; // New array for active alarms
  
  try {
    // Convert string values to numbers for comparison
    const values = {
      ph: parseFloat(data.data.pH),
      tss: parseFloat(data.data.tss),
      nh3n: parseFloat(data.data.nh3n),
      cod: parseFloat(data.data.cod),
      debit: parseFloat(data.data.debit)
    };

    // Get current alarm settings
    const alarmSettings = await getAlarmSettings();
    const siteToken = data.data.token;
     
    // Filter alarm settings by site token and check each value
    alarmSettings
      .filter(setting => setting.site?.site_token === siteToken)
      .forEach(setting => {
        const value = values[setting.parameter];
        if (value === undefined || isNaN(value)) return;

        const alarmKey = `${siteToken}-${setting.parameter}`;
        const isTriggered = triggeredAlarms.get(alarmKey);

        if (evaluateCondition(value, setting.formula, setting.set_point)) {
          const alarmData = {
            parameter: setting.parameter,
            value: value,
            message: `${setting.parameter} ${setting.formula} ${setting.set_point}: Current value ${value}`,
            description: setting.description,
            site_id: setting.site_id,
            site_token: siteToken,
            site_name: setting.site.site_name,
            status: 'alarm'
          };

          // Only push alarm if not already triggered
          if (!isTriggered) {
            alarms.push(alarmData);
            // Set trigger state to true
            triggeredAlarms.set(alarmKey, true);
            // Add to active alarms
            activeAlarms.set(alarmKey, alarmData);
          }
          
          // Add to list of active alarms regardless of trigger state
          listActiveAlarms.push(activeAlarms.get(alarmKey));
        } else {
          // Value has returned to normal
          if (isTriggered) {
            normalStates.push({
              parameter: setting.parameter,
              value: value,
              message: `${setting.parameter} has returned to normal: Current value ${value}`,
              description: setting.description,
              site_id: setting.site_id,
              site_token: siteToken,
              site_name: setting.site.site_name,
              status: 'normal'
            });
            // Reset trigger state and remove from active alarms
            triggeredAlarms.set(alarmKey, false);
            activeAlarms.delete(alarmKey);
          }
        }
      });

      // Convert activeAlarms to an array of objects
      const activeAlarmsArray = Array.from(activeAlarms.values());
      io.emit('realtime_alarm_active', activeAlarmsArray);   
      io.emit('realtime_alarm_notification', alarms);

  } catch (error) {
    console.error('Error in checkThresholds:', error.message);
  }

  return {
    hasAlarms: alarms.length > 0,
    alarms: alarms,
    normalStates: normalStates,
    listActiveAlarms: listActiveAlarms, // Add list of active alarms to return
    timestamp: data.datetime
  };
}

module.exports = { checkThresholds };
