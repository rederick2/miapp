$(function(){
	// get user
	var mjmChatUser = mjmChatConfig.user;
	var mjmChatConnect = false;
	
	// connect to socket
	var mjmChatHostPort = mjmChatConfig.host+':'+mjmChatConfig.port;
	var socket = io.connect(mjmChatHostPort);

	//console.log(mjmChatConfig.user);
	
	//if(mjmChatConfig.user == 'red'){
  
		socket.on('connect', function()
		{
			
			socket.emit("user" , mjmChatUser , function(data){

				console.log(data);

				$('#mjmChatRooms li').each(function (index, elem){

					var str = $(elem).text();

					var username = str.split('|');

					$(elem).text(username[0]+ '|0' );

					data.forEach(function (item){
						//console.log(item);
						if(username[0] == item){
							$(elem).text(item + '|1' );
						}
					});
				//console.log(str);

				});

			});

			//socket.emit("usersOnline");

			socket.on('mjmChatMessage', function(username, data , room)
			{
				// view message 
				if(! $(".room_"+room+" #mjmChatMessages").is(":focus")){
					$(".room_"+room+" #mjmChatRoomHead").css('background-color', '#A1C000');
					$(".room_"+room).attr('active', '0');
				}
				
				$(".room_"+room+" #mjmChatMessages").append('<li><strong>' + username + ':</strong> ' + data + '</li>');
				mjmChatScrollDown();
				//console.log(room);

				/*$.pnotify({
			        title: 'Chat Notice from user: '+username,
			        text: data
			    });*/
			});

			socket.on('mjmChatStatusUser', function (data , room)
			{
				// show connect & disconnect User
				$(".room_"+room+" #mjmChatMessages").append('<li class=\'mjmChatEvent\'>' + data + '</li>');
				mjmChatScrollDown();

				/*$.pnotify({
			        title: 'Disconnect',
			        text: data
			    });*/
			});
			
			socket.on('mjmChatUsers', function (users , room) {
				$(".room_"+room+" #mjmChatUsersList").empty();
				$.each(users, function(key, value)
				{
					var my = '';
					if(value == mjmChatUser) my = ' class=\'mjmChatMyUser\' ';
					$(".room_"+room+" #mjmChatUsersList").append('<li'+my+'>' + value + '</li>');
				});
			});

			socket.on('usersOnline' , function (users){
				console.log(users);
				$('#mjmChatRooms li').each(function (index, elem){

					var str = $(elem).text();

					var username = str.split('|');

					$(elem).text(username[0]+ '|0' );

					users.forEach(function (item){
						//console.log(item);
						if(username[0] == item){
							$(elem).text(item + '|1' );
						}
					});
				//console.log(str);

				});
			});

			socket.on('visto' , function (room, date){

				var active = $(".room_"+room).attr('active');

				

				$(".room_"+room+" #mjmChatMessages").append('<li class=\'mjmChatEvent\'>visto:' + date + '</li>');
				mjmChatScrollDown();

				//console.log($(".room_"+room+" #mjmChatMessages").is(":focus"));
				

				

			});
		});

	//	console.log(mjmChatConfig.user + 'connect');
	//}

	/***************************************/
	//var socket = io.connect('http://localhost:3000/notify');

	//try
	//{
	    //var io = require('socket.io-client');

	    

	   /* socket.on("connect", function() {
	        console.log("connected");

	        socket.emit("user" , {Id : mjmChatUser});

	        setTimeout(function() {
	            socket.emit("push", { Id: 'alex2013', Counts: { NewMessages: 3 } });
	            setTimeout(function() {
	                socket.emit("push", { Id: 'rederick2013', Counts: { NewMessages: 5 } });
	            }, 2000);
	        }, 4000);

	        socket.on("update", function(data) {
	        	console.log(data);
	       });
	    });

	    

	//} catch (e) { console.log(e); }

	/****************************************/
	
	$("#mjmChatRooms li").click(function()
	{	
		/*if(mjmChatConnect)
			socket.emit('mjmChatEnterRoom', $(this).attr('title'));
		else
			socket.emit('mjmChatAddUser', mjmChatUser, $(this).attr('title'));*/

	//$("#mjmChatRooms li").click(function()
	//{	
		//$('.room_'+$(this).attr('title')+' #mjmChatMessages').empty();

		//console.log($(this).attr('title'));
		mjmChatConnect = true;
		//socket.emit("push", { Id: 'rederick2013', Counts: { NewMessages: 5 } });
	});

	$('textarea#mjmChatMessage').focus(function(){

		var room = $(this).parent().parent().attr('class').split('room_');
		var User = $(this).parent().parent().children('#mjmChatRoomHead').children('#mjmChatRoomTitle').text();

		$(this).parent().parent().children('#mjmChatRoomHead').css('background-color' , '#C9E0ED');

		var active = $(this).parent().parent().attr('active');

		if(active == "0"){
			socket.emit('visto' , User.split('|')[0], room[1]);
		}

		
		$(this).parent().parent().attr('active' , '1');

		mjmChatConnect = true;

		//console.log(room);

	});
	
	// sent message to socket
	$("button#mjmChatSend").click(function() {
		var room = $(this).parent().parent().attr('class').split('room_');
		var User = $(this).parent().parent().children('#mjmChatRoomHead').children('#mjmChatRoomTitle').text();
		var data = $(this).parent().children('#mjmChatMessage').val();

		//console.log(room);

		if($(this).parent().children('#mjmChatMessage').val() != '')
		{
			socket.emit('mjmChatMessage', data , room[1] , User.split('|')[0]);
			$(this).parent().children('#mjmChatMessage').val('');
		}

		$(".room_"+room[1]+" #mjmChatMessages").append('<li><strong>' + mjmChatUser + ':</strong> ' + data + '</li>');
		//$(this).parent().children('#mjmChatMessage').focus();
		//console.log($(this).parent().children('#mjmChatMessage').val());
		return false;
	});
	
	$('textarea#mjmChatMessage').keypress(function(e) {
		if(e.which == 13) {
			$(this).parent().children('#mjmChatSend').focus().click();
			e.preventDefault();
			$(this).parent().children('#mjmChatMessage').focus();
		}
	});
	
	function mjmChatScrollDown()
	{
		var height = $('#mjmChatMessages')[0].scrollHeight;
		$('#mjmChatMessages').scrollTop(height);
	}
});