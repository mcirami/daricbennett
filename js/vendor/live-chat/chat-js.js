( function( $ ) {
	var socket = io();
	var uid=1;
	socket.emit('validate',uid);

	$('.msg_box').keypress(function(event){

		if ( event.which == 13 ) {
			data={
				id:uid,
				msg:$("#msg_box").val()
			};
			socket.emit('send msg',data);
			$("#msg_box").val('');
		}
	});

	socket.on('user entrance',function(data){
		if(uid!="0"){
			$("#chatbox").append("<div class='col-xs-12'><h2><center>"+data.info+"</center></h2></div>");
			console.log(data.message);
			for(var i=0;i<data.message.length;i++){
				if(data.message[i]['uid']==uid){
					$("#chatbox").append("<li class='actual_msg' style='text-align:right;float:right'><section><strong style='margin-right: -15px;'>You:</strong><br>"+data.message[i].messages+"</section><span class='date'>"+data.message[i].time+"</span></li>");
				}else{
					$("#chatbox").append("<li class='actual_msg' style='text-align:left;float:left'><section><strong style='margin-left: -15px;'>"+data.message[i].name+": </strong><br>"+data.message[i].messages+"</section><span class='date'>"+data.message[i].time+"</span></li>");
				}
			}
			$("#chatbox").animate({scrollTop: $("#chatbox").get(0).scrollHeight},900);
		}
	});

	socket.on('exit',function(data){
		if((data.message).trim()!="undefined"){
			$("#chatbox").append("<div class='col-xs-12'><h2><center>"+data.message+" is offline</center></h2></div>");
		}
	});

	socket.on('get msg',function(data){
		//to scroll the div
		$("#chatbox").animate({scrollTop: $("#chatbox").get(0).scrollHeight},900);
		if(data.id==uid){
			$("#chatbox").append("<li class='actual_msg' style='text-align:right;float:right'><section><strong style='margin-right: -15px;'>You:</strong><br>"+data.message+"</section><span class='date'>"+data.date+"</span></li>");
		}else{
			$("#chatbox").append("<li class='actual_msg' style='text-align:left;float:left'><section><strong style='margin-left: -15px;'>"+data.user+": </strong><br>"+data.message+"</section><span class='date'>"+data.date+"</span></li>");
		}
	});

} )( jQuery );

