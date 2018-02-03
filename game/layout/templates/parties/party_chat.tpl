	{if $inParty.showChat}			
	     <!-- <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>-->
		 <script src="{$config.url}layout/js/socket.io-client/socket.io.min.js"></script>

          <script src="{$config.url}layout/js/hackChat.js?cache=24" ></script>
        
          <script data-no-instant >
            $(document).ready(function(){
              $().hackChat({ 
              		  party: true , 
              		  chatConsole: '#partyChatConsole',
              		  onlineContainer: '#partyOnline',
                      chatInput : '#partyChatInput',
                      chatMessages: '#partyMessages',  
                      chatMessagesContainer: '#partyMessagesContainer', 
                      hash_code: '{$smarty.session.session2}', 
                      
                      }); 
					  
				
            });
          </script>
	
		  <div class="panel panel-glass partyChatContainer">
		  	<div class="panel-heading" >
				<div style="float:right;padding:10xp;cursor:pointer;" id="hidePartyChatButton" ><span class="glyphicon glyphicon-minus"></span></div>
				<a href="{$config.url}parties">party</a> (<span id = "partyOnline">0</span> online)
			</div>
			<div id="partyCollapsable">
			<div class="panel-body" id="partyMessagesContainer"  style="height:250px;border-bottom:0;word-break: break-all; overflow:auto; background: rgba(0, 0, 0, 0.86);">
		 		<ul id="partyMessages">
            	</ul>
			</div>
			<form method="post" id="partyChatConsole">
			  <div class="row"> 
				<div class="col-md-12">
				  <div class="row-fluid"> 
					<div class="col-md-9 nopadding">

					<input type="text" id="partyChatInput" autocomplete="off" maxlength="300" placeholder="type message" data-maxlength-position="bottom"/>

					</div>
					<div class="col-md-3 nopadding">
					  <button type="submit" style="border-left:0">GO</button>
					</div>
				  </div>
				</div>
			  </div>
				</form>
				</div>
		  </div>
          
        {else}
            <div  class="partyChatContainer" >
            <a href="{$config.url}parties" class="button">party</a>
            </div>
        {/if}