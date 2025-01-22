const mqtt = require('mqtt');
const io = require('socket.io-client');
require('dotenv').config({ path: '../../.env' }); //root path

// MQTT Configuration
const config = {
  host: process.env.MQTT_HOST || 'localhost',
  port: process.env.MQTT_PORT || '1883',
  clientId: `mqtt_${Math.random().toString(16).slice(3)}`,
  topic: process.env.MQTT_TOPIC_SIGNATURE || 'eh/site/007/#',
  options: {
    clean: true,
    connectTimeout: 4000,
    username: process.env.MQTT_USERNAME,
    password: process.env.MQTT_PASSWORD,
    reconnectPeriod: 1000,
  }
};

// Create MQTT client instance
const connectUrl = `mqtt://${config.host}:${config.port}`;
const client = mqtt.connect(connectUrl, {
  clientId: config.clientId,
  ...config.options
});

// Initialize Socket.IO client with reconnection options
const socket = io(process.env.WEBSOCKET_SERVER_URL || 'http://localhost:3000', {
  reconnection: true,
  reconnectionAttempts: Infinity,
  reconnectionDelay: 1000,
  reconnectionDelayMax: 5000,
  timeout: 20000,
  autoConnect: true
});

// Event handlers
const handleConnect = () => {
  console.log('MQTT Client Connected');
  // Subscribe to specific topic pattern from env
  client.subscribe(config.topic, (err) => {
    if (err) {
      console.error('Subscribe error:', err);
    } else {
      console.log(`Subscribed to ${config.topic}`);
    }
  });
};

const handleError = (error) => {
  console.error('MQTT Connection error:', error);
  if (error.name === 'TransportError') {
    console.log('Attempting to reconnect MQTT client...');
    client.reconnect();
  }
};

const handleReconnect = () => {
  console.log('Reconnecting...');
};

const handleMessage = (topic, message) => {
  console.log('Received Message:', topic, message.toString());
  try {
    const parsedMessage = JSON.parse(message.toString());
    console.log('Parsed Message:', parsedMessage);
    
    // Emit the parsed message to Socket.IO
    socket.emit('realtime_values', {
      topic,
      data: parsedMessage
    });
  } catch (error) {
    console.error('Error parsing message:', error);
  }
};

// Add new handler for publish events
const handlePublish = (topic, message) => {
  if (topic.includes('eh/site')) {
    console.log('Published Message:', topic, message.toString());
  }
};

// Attach event listeners
client.on('connect', handleConnect);
client.on('error', handleError);
client.on('reconnect', handleReconnect);
client.on('message', handleMessage);
client.on('publish', handlePublish);  // Add publish event listener

// Enhanced Socket.IO error handling
socket.on('connect_error', (error) => {
  console.error('Socket.IO Connection error:', error);
  const nextDelay = Math.min(1000 * Math.pow(2, socket.reconnectAttempts), 60000);
  console.log(`Will attempt reconnection in ${nextDelay/1000} seconds...`);
  
  setTimeout(() => {
    console.log('Attempting to reconnect Socket.IO...');
    socket.connect();
  }, nextDelay);
});

socket.on('connect', () => {
  console.log('Socket.IO Connected successfully');
  socket.reconnectAttempts = 0;
});

socket.on('disconnect', (reason) => {
  console.log('Socket.IO Disconnected:', reason);
  if (reason === 'io server disconnect') {
    console.log('Server initiated disconnect, attempting to reconnect...');
    socket.connect();
  }
});

socket.on('reconnecting', (attemptNumber) => {
  console.log(`Socket.IO Reconnection attempt #${attemptNumber}`);
});

socket.on('reconnect_failed', () => {
  console.error('Socket.IO Reconnection failed after all attempts');
});

module.exports = client;
