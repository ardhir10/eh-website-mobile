const axios = require('axios');
const moment = require('moment');

async function insertTestData(
    startDate, 
    endDate, 
    endpoint = 'http://localhost:8000/api/api-log', 
    minuteInterval = 2,
    token = "wOoFD2OeWwgXAeLgoKalw24rcnpg4u6Y"
) {
    try {
        const start = moment(startDate);
        const end = moment(endDate);
        
        // Loop through dates with custom minute intervals
        for (let current = start; current <= end; current = moment(current).add(minuteInterval, 'minutes')) {
            const testData = {
                pH: (7 + Math.random()).toFixed(4),
                tss: (100 + Math.random() * 50).toFixed(4),
                nh3n: (1 + Math.random() * 2).toFixed(4),
                cod: (200 + Math.random() * 20).toFixed(4),
                debit: (4000 + Math.random() * 200).toFixed(4),
                totalizer: Math.floor(1500000 + Math.random() * 50000).toString(),
                datetime: moment(current).unix(),
                token: token,
                status_send: "success"
            };

            // Send data to custom API endpoint
            await axios.post(endpoint, testData);
            // console.log(`Data inserted for: ${moment(current).format('YYYY-MM-DD HH:mm:ss')}`);
        }
        
        // console.log('Data insertion completed successfully');
    } catch (error) {
        console.error('Error inserting test data:', error.message);
    }
}

// Example usages:
// Default (2 minutes interval, default endpoint, default token)
// insertTestData('2024-03-20 00:00:00', '2024-03-21 00:00:00');

// Custom endpoint, interval, and token
insertTestData(
    '2025-01-10 00:00:00', 
    '2025-01-15 00:00:00',
    'http://localhost:8000/api/api-log',
    2,
    'E8rkrgQxBwmHp3LOJt3kfOHDhStiXYwB'
);

module.exports = { insertTestData };
