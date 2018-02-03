{include file="header_home.tpl" no_menu=true noHackBody = true}
<div id="cann">
	<canvas id="can" class="transparent_class"></canvas>
</div>
<script src="{$config.url}layout/js/crazyIntro.js"></script>
 {if $showVideo} {include file="dialogs/osx_dialog_box.tpl" id='introVideo' title='SECRET REPUBLIC' content='
<div class="text-center">
	<iframe class=" alphaGlow" src="http://www.youtube.com/embed/6thfiGb-b7c?origin=http://secretrepublic.net&amp;controls=0&amp;autohide=2&amp;modestbranding=1&amp;showinfo=0&autoplay=false" frameborder="0" style="width:100%;height:250px;">
	</iframe>
	<h3>
	<a href="https://www.facebook.com/theSecretRepublic" target="_blank"><i class="fa fa-facebook"></i></a>
	 <a href="https://twitter.com/iSecretRepublic" target="_blank"><i class="fa fa-twitter"></i></a>
	<a href="https://www.youtube.com/user/TheSecretRepublicCom/" target="_blank"><i class="fa fa-youtube"></i></a>
	</h3>
</div>
<div class="row">
	<div class="col-xs-7">
		<button type="button" data-dismiss="modal">HOME</button>
	</div>
	<div class="col-xs-5">
		<a href="{$config.url}register"><button type="button">JOIN US</button></a>
	</div>
</div>
 '}
<script type="text/javascript">$(window).load(function(){ $('#myModalintroVideo').modal('show'); });</script>
 {/if}
<div class="row text-center" style="margin-top: 50px;">
	<div class="col-md-4 col-xs-10 col-sm-9 inline mb10 nofloat">
<br/><br/>
	{include file="error_success.tpl"}

		<div class="logo-container">
			<div class="loginContainer alphaGlow mb10">
				<form method="post">
					<input type="hidden" name="process" value="true"/>
					<input type="text" maxlength="15" placeholder="USER" name="username" required="required" class="text-center" style="border-bottom:0"/>
					<input type="password" maxlength="20" placeholder="PASSWORD" class="text-center" data-no-voice name="password" required="required"/>
					<button type="submit" class="connect"><span class="glyphicon glyphicon-flash"></span></button>
				</form>
			</div>
			<div class="login_links">
				<div class="row ">
					<div class="col-md-6 mb10">
						<a href="{$config.url}register" title="in less than a minute">create new account</a>
					</div>
					<div class="col-md-6 mb10">
						<a href="{$config.url}register/forgot/password">forgot user | pass</a>
					</div>
				</div>
				<br/>
			</div>
			<div class="alert alert-warning text-center">
					This game version is being deprecated. <br/>
					Try out the new <a href="http://alpha.secretrepublic.net">Secret Republic Alpha</a> (iOS app available). Send us your feedback and we'll keep adding content.
			</div>

		</div>

	<br/>
	<a href="{$config.url}hackdown">
		 		 <div class="panel panel-future">
				<div class="panel-body">
					{if $hackdownRemaining}
						  {include file="components/hackdown.tpl" countdownFrom=$hackdownRemaining totalCountdown=24*60*60
                                                    id='hackdown' textCountdown = "true"
                                                    progressBarCountdown = "true" reloadOnFinish = true
                                                    textFinish = "Hackdown ended"
                                                    progressBarClass = "progress" textLeft="HACKDOWN in progress"}

      				{else}
						  {include file="components/hackdown.tpl" countdownFrom=$nextSaturdayRemaining totalCountdown=6*24*60*60
                                                    id='hackdown' textCountdown = "true"
                                                    progressBarCountdown = "true" reloadOnFinish = true
                                                    textFinish = "Hackdown in progress"
                                                    progressBarClass = "progress-small"
													textLeft="Hackdown begins in"}


	  				{/if}

		  		</div>
				<img src="{$config.url}layout/img/events/hackdown_main.jpg" class="  imageOpacity" title="Hackdown"/>

			</div></a>
		 {$main_stats} <br/>

	</div>
</div>



<div class="row-fluid text-center">
	<iframe  class="youtubeIntro alphaGlow " src="https://www.youtube.com/embed/?list=PLHxmav9PZJKaiBGqv_2gOxpGhKmtY3j7V&loop=1&origin=http://secretrepublic.net&autohide=1&modestbranding=1&showinfo=0" frameborder="0" style="max-width:25%"></iframe>


	<iframe class=" alphaGlow" src="https://www.youtube.com/embed/6thfiGb-b7c?origin=http://secretrepublic.net&amp;controls=0&amp;autohide=2&amp;modestbranding=1&amp;showinfo=0" frameborder="0" style="max-width:30%;height:170px;margin:10px">
	</iframe>
	<iframe class="youtubeIntro alphaGlow" src="https://www.youtube.com/embed/JE1-Mew1N-E?origin=http://secretrepublic.net&amp;controls=0&amp;autohide=2&amp;modestbranding=1&amp;showinfo=0" frameborder="0" style="max-width:25%">
	</iframe>
<br/><br/><br/><br/>
</div>
