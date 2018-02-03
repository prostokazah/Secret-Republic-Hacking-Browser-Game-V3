{include file="header_home.tpl" no_sidebar=true}

   
			{include file="error_success.tpl"}
				{include file="chat/chat.tpl" full = true}
				<div class="row">
					<div class="col-md-4">
					<h2>hackdown</h2>
					<hr/>
				<a href="{$config.url}hackdown">
			<div class="panel panel-future">
				<div class="panel-body">
					
						 {if !$hackdownRemaining}
						  {include file="components/hackdown.tpl" countdownFrom=$nextSaturdayRemaining totalCountdown=6*24*60*60
                                                    id='hackdown' textCountdown = "true" 
                                                    progressBarCountdown = "true" reloadOnFinish = true 
                                                    textFinish = "Hackdown in progress"
                                                    progressBarClass = "progress-small" 
													textLeft="Hackdown begins in"}
 
      					{else}
							{include file="components/hackdown.tpl" countdownFrom=$hackdownRemaining totalCountdown=24*60*60
                                                    id='hackdown' textCountdown = "true" 
                                                    progressBarCountdown = "true" reloadOnFinish = true 
                                                    textFinish = "Hackdown ended"
                                                    progressBarClass = "progress" textLeft="HACKDOWN in progress"}
						{/if}
	  			
				
		  		</div>
				<a href="{$config.url}hackdown"><img src="{$config.url}layout/img/events/hackdown_main.jpg" class="  imageOpacity" title="Hackdown"/></a>

			</div></a>
			</div>
			<div class="col-md-8">
		<h2 class="text-right">latest articles</h3>
		<hr/>
		<div class="row">
		{foreach from = $articles item = article}
			<div class="col-md-4">
				<div class="well black cut-text">
					<a href="{$config.url}blogs/article/{$article.article_id}">{$article.title}</a>
				</div>
			</div>
		{/foreach}
		
		</div>
			</div>
		</div>