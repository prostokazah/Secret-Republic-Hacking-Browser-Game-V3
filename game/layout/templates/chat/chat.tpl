
	<!--<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>-->
	<script src="{$config.url}layout/js/socket.io-client/socket.io.min.js"></script>
	<script src="{$config.url}layout/js/hackChat.js?c=2"></script>
				
	<a class="text-center button mb10" onclick="$(this).slideUp(); $('#chatHidden').slideDown();">
    <span class="glyphicon glyphicon-bullhorn"></span> CHAT
  </a>
	  <div class="panel panel-glass" style="display:none;" id="chatHidden">
	  	<div class="panel-heading">
      		<span class="glyphicon glyphicon-bullhorn"></span> (<span id="onlineCount">0</span> in chat) {if $GET.page ne "chat"}{if !$full}<a href="{$config.url}chat{if $orgChat}/org/delusion{/if}"><span class="glyphicon glyphicon-resize-full" title="Full"></span></a>{/if}{/if}
        </div>
		
      <div  class="panel-body chatBox  overflow" id="chatMessagesContainer" data-height="400">
        <ul id="chatMessages">
        </ul>
      </div>
	 	<form method="post" id="chat">
      <div class="row">
        <div class="col-md-12">
          <div class="row-fluid">
            <div class="col-xs-9 nopadding">
          
            <input type="text" id="chatInput" autocomplete="off" maxlength="300" placeholder="type message" data-maxlength-position="bottom" style="border:0; border-top:1px solid rgba(70, 120, 185, 0.36)"/>
        
            </div>
            <div class="col-xs-3 nopadding">
              <button type="submit" style="border-bottom:0; border-right:0;background-color:rgba(0, 87, 132, 0.18)"><span class="glyphicon glyphicon-send" ></span></button>
            </div>
          </div>
        </div>
      </div>
        </form>
		{if !$orgChat}
		<div class="panel-footer text-center">
				<small><strong>
					<a href="https://www.facebook.com/theSecretRepublic" target="_blank"><i class="fa fa-facebook"></i></a>  <a href="https://twitter.com/iSecretRepublic" target="_blank"><i class="fa fa-twitter"></i></a>  
				<a href="https://www.youtube.com/user/TheSecretRepublicCom/" target="_blank"><i class="fa fa-youtube"></i></a>
        <!--
					<a href="https://itunes.apple.com/us/app/secret-republic-hacking-online/id946777766?" target="_blank"><i class="fa fa-apple"></i></a>
					-->
				   <a href="https://play.google.com/store/apps/details?id=com.codevolution.secretrepublic" target="_blank"><i class="fa fa-android"></i></a>
          	</strong></small>
		</div>
		{/if}
	  </div>
	  <script type="text/javascript">
		
		
          {if $orgChat}
            $().hackChat({ organization: true, hash_code:"{$smarty.session.session2}" }); 
          {else}
          	$().hackChat({ organization: false, hash_code:"{$smarty.session.session2}" }); 
          {/if}
        
      </script>
     