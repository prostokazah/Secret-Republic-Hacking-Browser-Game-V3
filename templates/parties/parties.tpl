{include file="header_home.tpl"}
<div class="alert alert-danger">
HIGHLY EXPERIMENTAL AND UNSTABLE FEATURE
</div>
{include file="error_success.tpl"}



{if !$user.in_party}

  {foreach from = $invitations item = invite}
    <form method="post">
      <input type="hidden" name="invite" value="{$invite.invitation_id}"/>
    <div class="row">
      <div class="col-md-8">
        <button disabled class="disabled mb10">Party invitation from {$invite.username}</button>
        
      </div>
      <div class="col-md-2">
        <input type="submit" name="accept" value="Accept" class="mb10"/>
      </div>
      
      <div class="col-md-2">
        <input type="submit" name="decline" value="Decline" class="mb10"/>
      </div>
    </div>
  </form>
  {/foreach}
{else}


<div class="panel panel-glass">
	<div class="panel-heading">
		Party - created @ {$party.created}
	</div>
	<div class="panel-body">


<div class="row">
  <div class="col-md-6">
  	<div class="panel panel-future">
		<div class="panel-heading">Participants ({$participants|count})</div>
		
    <div class="panel-body">
    {foreach from = $participants item = participant}
      <div class="row mb10">
        <div class="col-md-4">
          {if $participant.online}
            <button disabled>ONLINE</button>
          {else}
            <button disabled class="disabled">OFFLINE</button>
          {/if}
        </div>
        <div class="col-md-8">
			<a href="{$config.url}profile/hacker/{$participant.username}" class="button text-center">
        		{$participant.username} 
			</a>
        </div>
      </div> 
    {/foreach}
    <div class="text-center ">
      <small>(manual refresh required to update information)</small>
    </div>
    </div>
    
    </div>
  </div>
  <div class="col-md-6">
  	<div class="panel panel-future">
		<div class="panel-heading">Pending Invitees</div>
    <div class="panel-body">
	<div class="row mb10">
    {foreach from = $invitees item = invitee}
		<div class="col-md-6">
			<a href="{$config.url}profile/hacker/{$invitee.username}" class="button text-center mb10">
				{$invitee.username}
			</a>
		</div>
    
    {foreachelse}
		<div class="col-md-12">
      <div class="well">
        no invitations pending
      </div></div>
    {/foreach}
	</div>
	
    {if $invitees|count}
    <div class="text-center">
      <small>(manual refresh required to update information)</small>
    </div>
    {/if} 
	<br/>
	<form method="post">
      <input type="text" name="usernames" placeholder="Usernames separated by comma" class="mb10"/>
      <input type="submit" value="Invite"/>
    </form>
    </div>
    
    
    </div>


</div></div>
</div>
<form method="post">
      <input type="submit" name="leave" value="leave party"/>
    </form>

</div>
{/if}



<div class="row">
<div class="col-md-6">
<div class="well ">
    <p>If any member enters a party mission every other party member can choose to join the same mission instances.</p>
	
	<p>A special floating party chat-box is available to party members.</p>
    
    <strong>A party forcibly ends 3 hours (+ couple dozen minutes) after it's been created or when all members have left.</strong>

  </div>
  {if !$user.in_party}
  
  <form method="post">
    <input type="hidden" name="create" value="emilia"/>
    <input type="submit" value="Create party" class="mb10"/>
  </form>
  {/if}
</div>
<div class="col-md-6">
	<div class="panel panel-future">
		<div class="panel-heading">
			<strong>Specific in-party rules</strong>
		</div>
		<div class="panel-body">
			<p>
			Same network will be shared amongst participants and all will have the same IP and in-mission main server. As a consequence the number of bounces through a server and other such factors will be per party and not per party member.
			<p>
			<p>Your Main server's skills will influence only the execution of your own commands.</p>
			The servers available by default will be of the participant who starts the mission.
		</div>
	</div>
	 {if $smarty.session.premium.removeAds &&  !$smarty.session.premium.partyChat}
	 <div class="alert alert-info">
    The live party chat box will be visible only in the party creation interface (which you are viewing now) or while in mission, unless you use <a href='{$config.url}alpha_coins'>Alpha-Coins</a>.
  </div> 
  {/if}
	
  
</div></div>

