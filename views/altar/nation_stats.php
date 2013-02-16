<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
        <?PHP include("navigation.php"); ?>
    </div>
  </div>
  <div class="row-fluid">  
    <div class="span2 centered">
        <img src="/assets/home/img/nations/smaller/<?PHP echo $nation?>.png" />
    </div>
    <div class="span6">
        <h1><?PHP echo $title ?></h1>
    </div>
  </div>
  <div class="row-fluid">  
     <div class="span2 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav" data-spy="affix" >
          <li><a href="/altar/stats"><i class="icon-chevron-left"></i> Back to Global</a></li>
          <li><a href="#groups"><i class="icon-chevron-right"></i> Groups</a></li>
          <li><a href="#gods"><i class="icon-chevron-right"></i> Gods</a></li>
          <li><a href="#priests"><i class="icon-chevron-right"></i> Priests</a></li>
        </ul>
      </div>
      
    <div class="span6">
        <section id="groups">
        <h2>Groups</h2>
        <table class="table table-striped table-bordered ">
            <thead><tr><th>Group</th><th>Kudos</th></tr></thead>
            <tbody>
            <?PHP foreach($groups as $group){ 
                $link = sprintf('<a href="/altar/stats/%s/group/%s" title="Show Group Stats">%s</a>', $nation, urlencode($group->group_name), $group->group_name);
                $view_link = sprintf('<a class="icon-search" href="/altar/?group_name=%s"title="Kudos Tracker search"></a>', urlencode($group->group_name));
                ?>
                <tr><td><?PHP echo $link; ?> (<?PHP echo $view_link ?>)</td><td><?PHP echo $group->totalize ?> </tr>
            <?PHP } // end foreach?>
            </tbody>
        </table>
        <hr/>
        </section>
        
        <section id="gods">
        <h2>Gods</h2>
        <table class="table table-striped table-bordered ">
            <thead><tr><th>Deity</th><th>Kudos</th></tr></thead>
            <tbody>
            <?PHP foreach($deities as $deity){
                $link = sprintf('<a href="/altar/stats/%s/deity/%s" title="Show Deity Stats">%s</a>', $nation, urlencode($deity->deity), $deity->deity);
                $view_link = sprintf('<a class="icon-filter" href="/altar/?deity=%s"title="Kudos Tracker filter"></a>', urlencode($deity->deity));
                ?>
                <tr><td><?PHP echo $link; ?> (<?PHP echo $view_link ?>)</td><td><?PHP echo $deity->totalize ?></td></tr>
            <?PHP } // end foreach?>
            </tbody>
        </table>
        <hr/>
        </section>
        
        <section id="priests">
        <h2>Priests</h2>
        <table class="table table-striped table-bordered ">
            <thead><tr><th>Priest</th><th>Kudos</th></tr></thead>
            <tbody>
            <?PHP foreach($priests as $priest){ 
                $link = sprintf('<a href="/altar/stats/%s/priest/%s" title="Show Priest Stats">%s</a>', $nation, urlencode($priest->priest_name), $priest->priest_name);
                $view_link = sprintf('<a class="icon-filter" href="/altar/?priest_name=%s"title="Kudos Tracker filter"></a>', urlencode($priest->priest_name));
                ?>
                <tr><td><?PHP echo $link; ?> (<?PHP echo $view_link ?>)</td><td><?PHP echo $priest->totalize ?></td></tr>
            <?PHP } // end foreach?>
            </tbody>
        </table>
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
