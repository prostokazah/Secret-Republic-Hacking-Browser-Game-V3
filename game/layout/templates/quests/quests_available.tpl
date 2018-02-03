{include file="header_home.tpl"} 
<div class="futureNav middle ">
       <ul>
          <li><a href="{$config.url}parties">{if $user.in_party}<strong>PARTY</strong>{else}Parties{if $user.partyInvites} [{$user.partyInvites}]{/if}{/if}</a></li>
         
         
        </ul>
        
      </div>
{include file="error_success.tpl"}

{if $user.in_party}
	<div class="alert alert-info">
  You are in party mode and can only browse missions which can be initiated in a party.
  </div>
  <div class="panel panel-glass">
  	<div class="panel-heading">
  		mission instances
	</div>
 
  <div class="panel-body">
  {foreach from = $instances item = instance}
    <div class="row mb10">
	  <div class="col-md-3">
	  	<a href="{$config.url}profile/hacker/{$instance.username}" class="button text-center">
		{$instance.username}
		</a>
	  </div>
      <div class="col-md-5">
        <div class="well black nomargin">{$instance.title}</div>
      </div>
      <div class="col-md-4">
        <form method="post">
          <input type="hidden" name="instance" value="{$instance.instance_id}"/>
          <input type="submit" value="Enter"/>
        
        </form>
      </div>
    </div>
  {foreachelse}
  <button class="disabled mb10" disabled>no one from your party has initiated a party mission instance</button>
  {/foreach}
  </div>
  <div class="panel-footer text-right">
  	any participant can initiate a party mission that everyone else can join - the initiator's servers are used by default - <a href="{$config.url}parties">read party-specific rules</a>
  </div>
  </div>
  <br/>
{/if}
{$questsCached}