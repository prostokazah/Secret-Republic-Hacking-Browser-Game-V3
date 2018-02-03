
      </div> <!-- span -->
      </div> <!-- row -->
	  
	  {if $user.rewardsToReceive}
	  	<a href="{$config.url}rewards" >
	  	<button class="rewards-icon"  title="{$user.rewardsToReceive} rewards to claim">
		
		
		<span class="glyphicon glyphicon-gift" id="rewards2"></span>
		
		</button></a>
	  {/if}
	  
	   {if $user.newMsg}
	  	<a href="{$config.url}conversations" >
	  	<button class="messages-icon"  title="{$user.newMsg} unread emails">
		<span class="glyphicon glyphicon-envelope" id="newMsg2"></span>

		</button></a>
	  {/if}

	{if $myModals|count}	  
	  {foreach $myModals as $myModal}
	  {if $myModal.title}
		{include file="dialogs/osx_dialog_box.tpl" id='modalPopup{$myModal.id}' title=$myModal.title content=$myModal.content}

	  {/if}

	  {/foreach}
	  
	   
 	<script type="text/javascript">$(window).load(function(){
 	{foreach $myModals as $myModal}
		{if $myModal.show}
		$('#myModalmodalPopup{$myModal.id}').modal('show'); 
		{/if}
	{/foreach}
	
	});
	</script>

{/if}
 
   

      {if $inParty}
	  	{include file = "parties/party_chat.tpl"}
        
      {/if}
	  
	  
      {if !$no_footer && !$detectDevice.mobile}
	
		
        {if !$no_footer_bar}
        <div class="row-fluid mb10">
   				<div class="col-md-12">
				<div style="height:111px"></div>
				</div>
              <div class="col-md-10  ">
              
                <div class="well black ">
				

							<small>&copy; {"Y"|date} the secret republic</small>

                </div>
              </div>
              <div class="col-md-2  visible-md visible-lg">
                {if $logged}
                  <a href="{$config.url}logout" class="button text-center"><span class="glyphicon glyphicon-off"></span></a>
                {else}
                  <a href="{$config.url}" class="text-center button">GUEST</a>
                {/if}
              </div>
          
        </div>
       
		
        {/if}
      
			<div class="row-fluid  ">
			  <div class="col-md-12 text-center footer">
			  <br/>
			  <p>
			  
			  
			  <a href="{$config.url}theWorld" title="Stats of the hacking competition"> World stats</a>
				<a href="{$config.url}rankings" title="Hacker rankings">Rankings</a>
				
        <a href="{$config.url}blogs/" title="Hacker blogs">blogs</a>
        <a href="{$config.url}blogs/latestArticles/eve" title="Latest articles">articles</a>
        <a href="{$config.url}frequently-asked-questions" title="Frequently Asked Questions">f.a.q.</a>
        <a href="{$config.url}pages/page/beginner-tutorial">beginner intro</a>

				
				</p>
        <p>
          <a href="{$config.url}pages/page/about">about</a>
        <a href="{$config.url}forum" title="Secret Republic Public Forums">Forums</a>
          <a href="{$config.url}pages/page/media">artwork</a>
          <a href="{$config.url}pages/page/terms-of-service">t.o.s. & privacy</a>
        <a href="{$config.url}support">support</a>
        <a href="mailto:bugs@secretrepublic.net">report bug</a>

        </p>
				<p><h3>
				<a href="https://www.facebook.com/theSecretRepublic" target="_blank"><i class="fa fa-facebook"></i></a>  <a href="https://twitter.com/iSecretRepublic" target="_blank"><i class="fa fa-twitter"></i></a>  
				<a href="https://www.youtube.com/user/TheSecretRepublicCom/" target="_blank"><i class="fa fa-youtube"></i></a>
        <!--
					<a href="https://itunes.apple.com/us/app/secret-republic-hacking-online/id946777766?" target="_blank"><i class="fa fa-apple"></i></a>
					-->
				   <a href="https://play.google.com/store/apps/details?id=com.codevolution.secretrepublic" target="_blank"><i class="fa fa-android"></i></a>
					</h3>
				</p>
        <p>
            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FtheSecretRepublic&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=820318067994880" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;width: 80px; display:inline" allowtransparency="true">
            </iframe>
        </p>

				<a onclick="scrollToElement('#body');"><span class="glyphicon glyphicon-chevron-up"></span></a>



			  </div>
			</div>
			<div class="row-fluid">
			<div class="col-md-12">
			<div style="height:20px">
			</div>
			</div></div>
		{else}
		<div class="row-fluid">
			<div class="col-md-12">
			<div style="height:100px">
			</div>
			</div></div>
       {/if}
       
       {if !$detectDevice.mobile && $user.view_debug}
       
        {include file="footer_debug.tpl"}
       {/if}
	 	</div>

    

	</div>
	

	

	
    
    <script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
	  



    <script type="text/javascript" src="{$config.url}layout/js/global.js?cache=3ffsf44ff"></script>
   <!--
    <script type="text/javascript" data-no-instant src="{$config.url}layout/js/bootstrap.min.js"></script>
  -->
  
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    

{if $messenger|count or $GET.currentPage eq "quests/quests"}
		<!-- MESSENGER -->
		<script type="text/javascript" src="{$config.url}layout/messenger/js/messenger.min.js"></script>
		<script type="text/javascript" src="{$config.url}layout/messenger/js/messenger-theme-future.js"></script>
		  <link rel="stylesheet" href="{$config.url}layout/messenger/css/messenger.min.css" type="text/css"/>


		  <script type="text/javascript">

			Messenger.options = {}

			{foreach from=$messenger item=message}
			  Messenger().post({
			  message: "{$message.message}",
			  {if isset($message.type)}
			  type: '{$message.type}',
			  {/if}
			});
			{/foreach}

		  </script>
		  {/if}
		  
		  
		  
	 
	  <!-- Google Analytics -->
		<script>
  (function(i,s,o,g,r,a,m){ i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52068010-1', 'auto');
  ga('send', 'pageview');

</script>
	
	
  
</body>
</html>
