const express = require('express');
const { createServer } = require('http');
const { Server } = require('socket.io');
require('dotenv').config({ path: '../../.env' });
const { checkThresholds } = require('./alarm_threshold');

const app = express();
const httpServer = createServer(app);
const io = new Server(httpServer, {
  cors: {
    origin: process.env.CLIENT_URL || "http://localhost:3000",
    methods: ["GET", "POST"]
  }
});

io.on('connection', (socket) => {
  console.log('Client connected:', socket.id);

  socket.on('disconnect', () => {
    console.log('Client disconnected:', socket.id);
  });

  // Add your custom socket event handlers here
  socket.on('message', (data) => {
    // Handle incoming messages
    console.log('Received message:', data);
    // Broadcast to all clients
    io.emit('message', data);
  });

  // Modified realtime values handler with alarm checking
  socket.on('realtime_values', (data) => {
    console.log('Received realtime values:', data);
    
    // Check for alarms
    const alarmStatus = checkThresholds(data,io);
    // Broadcast realtime values and alarm status to all clients
    io.emit('realtime_values', {
      ...data
    });

    // If there are alarms, emit a separate alarm event
    if (alarmStatus.hasAlarms) {
      io.emit('alarms', alarmStatus);
    }
  });
});

const PORT = process.env.WEBSOCKET_PORT || 3001;

httpServer.listen(PORT, () => {
  console.log(`WebSocket server running on port ${PORT}`);
});

module.exports = { io, app };
