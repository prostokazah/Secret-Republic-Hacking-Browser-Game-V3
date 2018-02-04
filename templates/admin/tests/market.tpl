{include file="header_home.tpl"}

<div class="row mb10">
	<div class="col-xs-6">
		<a href="{$config.url}admin/view/tests/market/go">
			<button>Hardware</button>
		</a>
	</div>
	<div class="col-xs-6">
		<a href="{$config.url}admin/view/tests/market/go/software/m">
			<button>Software</button>
		</a>
	</div>
	
</div>
{foreach $testData as $testCase}

	<div class="row mb10">
		<div class="col-md-4">
			<button disabled>{$testCase.item.name}</button>
		</div>
		<div class="col-md-2">
			<button disabled>DMG: {$testCase.item.damage}%</button>
		</div>
		
		<div class="col-md-2">
			<button disabled>SUC. RATE: {$testCase.successPercent}%</button>
		</div>
		<div class="col-md-2">
			<button disabled>SKILL L.: {$testCase.skill.level}</button>
		</div>
		<div class="col-md-2">
			<button disabled>REP. C.: {$testCase.item.repair_coefficient|round:2}</button>
		</div>
	</div>

{/foreach}