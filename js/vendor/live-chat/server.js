require('../../../.env').config();
const express    = require('express');
const path       = require('path');
const bodyParser = require('body-parser');
const session    = require('express-session');
const Pusher     = require('pusher');

const app = express();

// Session middleware
app.use(session({
	secret: 'somesuperdupersecret',
	resave: true,
	saveUninitialized: true
}))

// Body parser middleware
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// Serving static files
app.use(express.static(path.join(__dirname, 'public')));

// Create an instance of Pusher
const pusher = new Pusher({
	appId:     process.env.PUSHER_APP_ID,
	key:       process.env.PUSHER_APP_KEY,
	secret:    process.env.PUSHER_APP_SECRET,
	cluster:   process.env.PUSHER_APP_CLUSTER,
	encrypted: true
});

app.get('/', (req, res) => {
	res.sendFile('index.html');
});

app.post('/join-chat', (req, res) => {
	// store username in session
	req.session.username = req.body.username;
	res.json('Joined');
});

app.post('/pusher/auth', (req, res) => {
	const socketId = req.body.socket_id;
	const channel = req.body.channel_name;
	// Retrieve username from session and use as presence channel user_id
	const presenceData = {
		user_id: req.session.username
	};
	const auth = pusher.authenticate(socketId, channel, presenceData);
	res.send(auth);
});

app.post('/send-message', (req, res) => {
	pusher.trigger('presence-groupChat', 'message_sent', {
		username: req.body.username,
		message:  req.body.message
	});
	res.send('Message sent');
});

app.listen(3000, () => {
	console.log('Server is up on 3000')
});