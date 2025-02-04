const mqtt = require('mqtt');
const client = mqtt.connect('mqtt://localhost:1883'); // Adjust MQTT broker URL as needed

// Array of test tokens
const tokens = [
    'E8rkrgQxBwmHp3LOJt3kfOHDhStiXYwB',
    'wOoFD2OeWwgXAeLgoKalw24rcnpg4u6Y',
    '3sDl5fDHPYtW5Jdq1iQy2pZ8b9QSlhUB',
    // Add more tokens as needed
    '2Dxvg0rk5Q0D8ilM1cROvXHp71ZDCfG2',
    'vPaERpmoY1K1OqY5xzkSU5LY3ipeIdT2'
];

// Function to generate random number within range
const randomInRange = (min, max) => {
    return (Math.random() * (max - min) + min).toFixed(4);
};

// Function to generate test payload
const generatePayload = (token) => {
    return {
        pH: randomInRange(6.5, 8.5),
        tss: randomInRange(50, 150),
        nh3n: randomInRange(0, 10),
        cod: randomInRange(100, 300),
        debit: randomInRange(3000, 5000),
        totalizer: (Math.floor(Math.random() * 1000000) + 1000000).toString(),
        datetime: Math.floor(Date.now() / 1000),
        token: token
    };
};

// Publish data for each token at regular intervals
const startPublishing = () => {
    tokens.forEach(token => {
        setInterval(() => {
            const payload = generatePayload(token);
            const topic = `eh/site/888/${token}`; // Sesuaikan SIgnature Topic
            
            client.publish(topic, JSON.stringify(payload), { qos: 1 }, (err) => {
                if (err) {
                    console.error(`Error publishing for token ${token}:`, err);
                } else {
                    console.log(`Published data for token ${token}:`, payload);
                }
            });
        }, 1000); // Publish every 5 seconds, adjust as needed
    });
};

// Connect to MQTT broker and start publishing
client.on('connect', () => {
    console.log('Connected to MQTT broker');
    startPublishing();
});

client.on('error', (err) => {
    console.error('MQTT client error:', err);
});
