const pusher = new Pusher('5262ff28a038d2616775', {
	cluster: 'us2',
	encrypted: true,
	authEndpoint: 'pusher/auth'
});

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

            var data = {username: this.username};

			axios.post('wp-json/wp/v2/posts/', Qs.stringify(data))
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
			})
            .catch(function (error) {
                console.log(error);
            });

            /*var protocol = window.location.protocol;
            var data = JSON.stringify({username: this.username});
            var domain = window.location.hostname;
            var url = protocol + "//" + domain + "/wp-admin/admin-ajax.php";

            $.ajax({
                url: url,
                type: "POST",
                async: true,
                dataType: 'json',
                data: data,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("X-WP-Nonce", currentUser.nonce);
                    xhr.setRequestHeader("authorization", "OAuth oauth_consumer_key='IWmItGndx8oY',oauth_token='x3pmlsoef6ayQEdkasPgG01h',oauth_signature_method='HMAC-SHA1',oauth_timestamp='1497396491',oauth_nonce='Lqz1LK',oauth_version='1.0',oauth_signature='EnWnLRtpkruPc1bTtKVhMgECFWg%253D'");
                    xhr.setRequestHeader("cache-control", "no-cache");
                    xhr.setRequestHeader("postman-token", "25dc514c-3ad3-0c17-95e8-9dcc960c9ca0");
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                },
                success: function (data, xhr) {
                    console.log(data);
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
                },
                failure: function (data) {
                    //alert(xhr.send(data));
                    xhr.send(data);
                    console.log(JSON.stringify(data));
                }
            })*/
		},
		sendMessage() {
			let message = {
				username: this.username,
				message: this.newMessage
			};
            console.log(message);
			// Clear input field
			this.newMessage = '';
			axios.post('wp-json/wp/v2/posts/', Qs.stringify(message));
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