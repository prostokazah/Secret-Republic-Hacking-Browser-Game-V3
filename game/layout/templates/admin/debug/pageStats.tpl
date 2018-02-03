{include file="header_home.tpl" no_sidebar=true}

{include file="admin/debug/debug_header.tpl"}

	
    {foreach from=$pages item=p}
      <div class="row mb10">
        <div class="col-md-12">
          <div class="row-fluid">
            <div class="col-md-3 nopadding">
              <button disabled>
                {$p.page}
              </button>
              
            </div>
            <div class="col-md-2">
              <div class="well black text-center">
                {$p.nr_queries} queries
              </div>
             
            </div>
            
            <div class="col-md-2 nopadding">
              <div class="well black text-center">
                {$p.total_time} s
              </div>
             
            </div>
            
            
            <div class="col-md-3 ">
              <div class="well black text-center">
                {$p.used_memory} kb mem.
              </div>
            </div>
             <div class="col-md-2 nopadding">
              <div class="well black text-center">
                {$p.nrl} logs
              </div>
            </div>
           
          </div>
        </div>
      </div>
    {/foreach}
					
					
    <div class="text-center">
      {$pages}
    </div>
	
		