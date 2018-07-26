const pusher = new Pusher('5262ff28a038d2616775', {
	cluster: 'us2',
	encrypted: true,
	authEndpoint: 'pusher/auth'
});

console.log(pusher);
const app = new Vue({
	el: '#app',
	data: {
		joined: false,
		username: '',
		members: '',
		newMessage: '',
		messages: [],
		status: ''
	},
	methods: {
		joinChat() {
			axios.post('join-chat', {username: this.username})
			.then(response => {
				// User has joined the chat
				this.joined = true;
				const channel = pusher.subscribe('presence-groupChat');
				channel.bind('pusher:subscription_succeeded', (members) => {
					this.members = channel.members;
				});
				// User joins chat
				channel.bind('pusher:member_added', (member) => {
					this.status = `${member.id} joined the chat`;
				});
				// Listen for chat messages
				this.listen();
			});
		},
		sendMessage() {
			let message = {
				username: this.username,
				message: this.newMessage
			}
			// Clear input field
			this.newMessage = '';
			axios.post('/send-message', message);
		},
		listen() {
			const channel = pusher.subscribe('presence-groupChat');
			channel.bind('message_sent', (data) => {
				this.messages.push({
					username: data.username,
					message: data.message
				});
			});
		}
	}
});