
jQuery.fn.hackChat = function(userOptions)
{
  // Default options
  var options = {
    organization: false,
    party: false,
    hash_code: 'none',
    chatConsole: '#chat',
    chatInput : '#chatInput',
    chatMessages: '#chatMessages',
    chatMessagesContainer: '#chatMessagesContainer',
    onlineContainer : '#onlineCount',
  };
  
  $.extend(options, userOptions);
  var socket;
  if (options.party)
  	 socket = io('http://secretrepublic.net:3002');
  else if (options.organization)
  	 socket = io('http://secretrepublic.net:3001');
  else
  	 socket = io('http://secretrepublic.net:3000');
	
	socket.on('authenticate_yourself', function(){
		socket.emit("authenticate_me", options.hash_code);
	  });
	
	socket.on('online_count_update', function(onlineCount){
	
		$(options.onlineContainer).text(onlineCount);
	  });
	socket.on('latestMessages', function(latestMessages){
		if (latestMessages)
		for(i=0; i<latestMessages.length;i++)
			processMessage(latestMessages[i]);
	  });
  
	function processMessage(data)
	{
		$(options.chatMessages).append("<li><a title='"+data.created+"' href='" + main_url + "profile/hacker/" + data.user.username + "'>" + data.user.username + "</a><small style='font-size:10px'>"+data.created+"</small>: " + data.message + "</li>");
			 $(options.chatMessagesContainer).scrollTop($(options.chatMessagesContainer).get(0).scrollHeight);
		
	}
	
	function setCollapseSymbol(hidden)
				{
					if (hidden == 1)
						$("#hidePartyChatButton").html('<span class="glyphicon glyphicon-plus"></span>');
					else
						$("#hidePartyChatButton").html('<span class="glyphicon glyphicon-minus"></span>');
				}
	
	  socket.on('received_message', function(data){
			processMessage(data);
		  });
	  
	  $(options.chatConsole).on("submit", function(){
		
			var message = $(options.chatInput).val();
			if (message.length >= 1 && message.length <= 300)
			{
				$(options.chatInput).val("");
				var data = {message : message};
				socket.emit("send_message", data);
			}
	  
		  return false;
		});
	
	
	if (options.party)
	{
		
				var checkHidden = getCookie('hidePartyChat');
				
				if (checkHidden == 1)
				{ $("#partyCollapsable").hide();
					setCollapseSymbol(checkHidden);
					}
			   $("#hidePartyChatButton").click(function(){
			   	$( "#partyCollapsable" ).slideToggle( "slow", "linear",function(){ 
						var hidden = $("#partyCollapsable").is(":visible") ? 0 : 1;
						setCookie("hidePartyChat", hidden, 1 ); 
						setCollapseSymbol(hidden);
				});
			   });
	}
	
};


    
    

