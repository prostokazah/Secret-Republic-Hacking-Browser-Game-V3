{include file="header_home.tpl"}
{include file="alpha_coins/alpha_coins_header.tpl"}
<div style="background-image:url({$config.url}layout/img/modules/bird_red.png); background-repeat:no-repeat; background-position:50% 50%">

	{if $smarty.get.fortumo}


	<script  type="text/javascript">$(document).ready(function(){ jQuery.noConflict();});</script>
	<script src="//fortumo.com/javascripts/fortumopay.js" type="text/javascript"></script>
	<div class="row">
		<div class="col-xs-4">
			<a href="{$config.url}alpha_coins" class="button text-center">BACK TO A-COINS</a>
		</div>
	</div><br/>
	<div class="well black mb10">
		Fortumo is not available in all countries and it's much preferred that you use <strong>PAYPAL</strong> instead. Delivery of Alpha Coins will be close to instant but please allow up to 6 hours before reporting a delivery problem.
	</div><br/><br/>
	<div class="text-center">
		<a id="fmp-button" href="#" rel="536a2e22f4be80dd131aebb74fba3ca3/{$user.id}">
			<img src="//fortumo.com/images/fmp/fortumopay_96x47.png" width="96" height="47" alt="Mobile Payments by Fortumo" border="0" />
		</a></div>

		{else}


		<br/>
		<div class="row">
			<div class="col-md-6">
				<blockquote>

						<h1 class=" nomargin" >{$user.alphaCoins|number_format}</h1>
					<div>Alpha Coins</div>
				</blockquote>
			</div>


			<div class="col-md-6">
				<blockquote class="pull-right">


						<h1 class="nomargin">10 A-C / $</h1>

						<div>
							
							<strong>all orders over {$config.ac_bonus_when_above - 1} Alpha-C receive {$config.ac_bonus_percent}% <span class="glyphicon glyphicon-gift"></span> </strong> (for {$config.ac_bonus_when_above}AC, {($config.ac_bonus_when_above/100)*$config.ac_bonus_percent}AC extra)

						</div>

				</blockquote>

			</div>



						





		</div>

		<div class="row">
							<div class="col-xs-7">



								<form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="text-center" >

									<!-- Identify your business so that you can collect the payments. -->
									<input type="hidden" name="business" value="do-not-reply@secretrepublic.net">

									<!-- Specify a Buy Now button. -->
									<input type="hidden" name="cmd" value="_xclick">

									<!-- Specify details about the item that buyers will purchase. -->
									<input type="hidden" name="item_name" value="{$user.username} @ 10 A-Coins">
									<input type="hidden" name="amount" value="1">
									<input type="hidden" name="currency_code" value="USD">
									<input type="hidden" name="custom" value="{$user.id}">

									<!-- Prompt buyers to enter their desired quantities. -->
									<input type="hidden" name="undefined_quantity" value="1">

									<!-- Display the payment button. -->
									<input type="image" name="submit" border="0"
									src="{$config.url}layout/img/paypal.png"
									alt="PayPal - The safer, easier way to pay online" style="max-width:100%;max-height:35px;" >


								</form> 
							</div>
							<div class="col-xs-5">

								<a href="{$config.url}alpha_coins/fortumo/true">
									<img src="//fortumo.com/images/fmp/fortumopay_96x47.png" width="96" height="47" alt="Mobile Payments by Fortumo" border="0" />
								</a>

							</div>
						</div>

		<br/>
		{include file="error_success.tpl"}
		{if $GET.option}
		<script type="text/javascript">
		$(window).load(function(){
			scrollToElement('#{$GET.option}');
		});

		</script>
		{/if}

				
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<form method="post">

				<h2>active services</h2>
				<hr/>

				{foreach from = $items item = item}
				{if $item.alreadyActive}
					{assign found true}
					{include file='alpha_coins/alpha_coins_item_bit.tpl'}	
				{/if}

					{/foreach}
					{if !$found}
					<div class="alert alert-warning">
						No active services. Top up your Alpha Coins and activate some goodness ASAP!
					</div>
					{/if}
					<br/>

					<h2>take your pick</h2>
					<hr/>

				

					{assign found false}
					{foreach from = $items item = item}
						{if !$item.alreadyActive}
							{assign found true}
							{include file='alpha_coins/alpha_coins_item_bit.tpl'}	
						{/if}

						{/foreach}

						{if !$found}
						<div class="alert alert-warning">
							All available services are active. <a href="#" title="Good Game, Well played!">GG WP!</a>
						</div>
						{/if}

					</form></div>
				</div>
				<br/>
				<h2> Coupon </h2>
				<div class="alert alert-info">
					Coupon codes can be obtained on large Alpha-C transactions, special events or by simply being an awesome hacker.
				</div>
				<form method="post">
					<div class="row">
						<div class="col-xs-8">
							<input type="text" class="text-center" placeholder="Coupon Code" name="coupon"/>
						</div>
						<div class="col-xs-4">
							<button type="submit"><span class="glyphicon glyphicon-gift"></span></button>
						</div>
					</div>
				</form>
				{/if}


