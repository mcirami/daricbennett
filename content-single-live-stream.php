<style>
	.chat {
		list-style: none;
		margin: 0;
		padding: 0;
	}
	.chat li {
		margin-bottom: 10px;
		padding-bottom: 5px;
		border-bottom: 1px dotted #B3A9A9;
	}
	.chat li .chat-body p {
		margin: 0;
		color: #777777;
	}
	.panel-body {
		overflow-y: scroll;
		height: 350px;
	}
	::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		background-color: #F5F5F5;
	}
	::-webkit-scrollbar {
		width: 12px;
		background-color: #F5F5F5;
	}
	::-webkit-scrollbar-thumb {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: #555;
	}
</style>

<div class="title">
    <h3><?php the_title(); ?></h3>
</div>

<div class="columns_wrap">
    <div class="column one">
        <div class="video_wrapper">
            <iframe src="<?php the_field('video_embed_link'); ?>/?playsinline=1" frameborder="0"></iframe>
        </div>
    </div>
    <div class="column two">

        <!--<div class="live_chat">
            <iframe src="<?php /*the_field('chat_embed_link'); */?>" frameborder="0" ></iframe>
        </div>-->
<!--
	    <div id="app">
		    <div class="full_width">
			    <div class="panel_wrap">
				    <div class="panel panel-info">
					    <div class="panel-heading">
						    Group Chats <span class="badge">{{ members.count }}</span>
					    </div>
					    <div class="panel-body">
						    <div v-if="joined">
							    <em><span v-text="status"></span></em>
							    <ul class="chat">
								    <li class="left clearfix" v-for="message in messages">
									    <div class="chat-body clearfix">
										    <div class="header">
											    <strong class="primary-font">
												    {{ message.username }}
											    </strong>
										    </div>
										    <p>
											    {{ message.message }}
										    </p>
									    </div>
								    </li>
							    </ul>
							    <div class="panel-footer">
								    <div class="input-group">
									    <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">
									    <span class="input-group-btn">
              <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">Send</button>
            </span>
								    </div>
							    </div>
						    </div>
						    <div v-else>
							    <div class="form-group">
								    <input type="text" class="form-control" placeholder="enter your username to join chat" v-model="username" @keyup.enter="joinChat">
							    </div>
							    <button class="btn btn-primary" @click="joinChat">JOIN</button>
						    </div>
					    </div>
				    </div>
			    </div>
		    </div>
	    </div>-->

	   <!-- <ul class="chatbox" id="chatbox">
		    <?php
/*		    if(get_current_user_id()=="0"){
			    echo "<h2><center>Login to join chat room</center></h2>";
		    }
		    */?>
	    </ul>
	    <br/>
	    <div id="name-group" class="form-group">
		    <textarea class="form-control msg_box" id="msg_box" placeholder="Type here and check the Title in Tab"></textarea>

	    </div>-->

	    <div class="live_chat">
		    <iframe src="https://mscchat.com/" frameborder="0" allowfullscreen></iframe>
            <!--<iframe src='https://minnit.chat/daricstream?embed&transparent' width='1000' height='500' style='border:none;' allowTransparency='true'></iframe>-->
            <!--<div id="arena-chat" data-publisher="daric-bennetts-bass-lessons" data-chatroom="daric-bennetts-bass-lessons-global" data-position="in-page"></div>
            <script src="https://go.arena.im/public/js/arenachatlib.js?p=daric-bennetts-bass-lessons&e=daric-bennetts-bass-lessons-global"></script>-->
            <!--<iframe src='https://go.arena.im/embed/chat/daric-bennetts-bass-lessons/daric-bennetts-bass-lessons-global' style='border: 0; width: 100%; height: 400px; border-radius: 4px;'></iframe>-->
        </div>
    </div>
</div>

<!--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue"></script>
<script src="//js.pusher.com/4.0/pusher.min.js"></script>-->
