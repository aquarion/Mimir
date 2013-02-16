<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Priest Statistics</h1>
    </div>
  </div>
  <div class="row-fluid">  
    <div class="span2 centered">
        <img src="/assets/home/img/nations/smaller/<?PHP echo $nation?>.png" />
    </div>
    <div class="span8">
        <h1><?PHP echo $priest_name ?></h1>
    </div>
  </div>
  <div class="row-fluid">  
     <div class="span2 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav" data-spy="affix" >
          <li><a href="/altar/stats/<?PHP echo $nation?>"><i class="icon-chevron-left"></i> Back to <?PHP echo $capnation; ?></a></li>
        </ul>
      </div>
      
    <div class="span6">
        
        <section id="gods">
        <h2>Gods</h2>
        <table class="table table-striped table-bordered ">
            <thead><tr><th>Deity</th><th>Kudos</th></tr></thead>
            <tbody>
            <?PHP foreach($deities as $deity){
                $link = sprintf('<a href="/altar/stats/%s/deity/%s" title="Show Deity Stats">%s</a>', $nation, urlencode($deity->deity), $deity->deity);
                $view_link = sprintf('<a class="icon-search" href="/altar/?deity=%s"title="Kudos Tracker search"></a>', urlencode($deity->deity));
                ?>
                <tr><td><?PHP echo $link; ?> (<?PHP echo $view_link ?>)</td><td><?PHP echo $deity->totalize ?></td></tr>
            <?PHP } // end foreach?>
            </tbody>
        </table>
        <hr/>
        </section>
    </div>
  </div>
    
</div>


<script type="text/javascript">
    Altar = {
    
	make_table_sortable : function(){
	    // With customizations
	    $("table").tablesorter();
	},
    
	add_init : function(){
	    Altar.make_table_sortable()
        
	}
    
    }
    $(document).ready(Altar.add_init)
</script>
