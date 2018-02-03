  <div class="row-fluid">
  
   
    <div class="col-md-6">
			{$page}<br/>
			Page generated in aprox. {$total_time} seconds<br/>
			Around {$nr_queries} database queries were necessary to generate the page<br/>
			{$used_memory} kb used memory<br/>
			
			
		</div>
    <div class="col-md-6">

    {foreach from=$mysql_queries key = k item = q}
      [{$k}] {$q}<br/>
    {/foreach}
	  </div></div>
