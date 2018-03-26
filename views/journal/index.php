<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1 centered">
      <img src="/assets/home/img/section-icons/Literature-100.png"/>
    </div>
    <div class="span6">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span5">
        <h1 class="pull-right">Journals </h1>
    </div>
  </div>
    
  <div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="/journals">Journals</a> <span class="divider">/</span></li>
            <li class="active" id="breadcrumbActive">NPCs</li>
        </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span9">
        <h2>Journals for <?PHP echo Event::title() ?></h2>
    </div>
    <div class="span3">
      <form class="form-search input-prepend" method="GET" action="/journals/search">
          <span class="add-on"><i class="icon-search"> </i></span>
          <input type="text" class="input-medium" name="q">
          <button type="submit" class="btn">Search</button>
      </form>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">

        <div class="centered">
            <a class="btn btn-large btn-primary" href="/journals/add"  >Add Journal</a>
        </div>
        <ul class="nav nav-list sidebar" id="journalTabs">
            <?PHP 
            echo "<li class=\"nav-header\">Journal Categories</li>\n";
            $options = $journal->journal_type_options();
            foreach($options as $index => $value){
                $unread = $journal->unread_by_type($index);
                echo '<li><a href="#'.$index.'" title="'.$value.'"><i class="icon-chevron-right"></i>'.$value.' <span class="badge" title="'.$unread.' Unread by Story">'.$unread.'</span></a></li>';
            } ?>
        </ul>
    </div>

    <div class="span9">
        <div class="tab-content">            
            <?PHP 
            
            foreach($journal->journal_type_options() as $index => $value){
                $index = preg_replace('/\s+/', '', $index);
                echo '<div class="tab-pane" id="'.$index.'">';
                $myJournals = Model::factory('Journal')->where('journal_type', $index)->order_by_asc("title")->find_many();
                $emptyJournals = array();

                $inRow = false;
                $journal_count = 0;

                foreach($myJournals as $journal){
                    $entry_count = $journal->entry_count();
                    if($entry_count){

                        $journal_count++;

                        if(!$inRow){
                            echo '<div class="row-fluid">';
                            $inRow = true;
                        }


                        $unread = $journal->unread_by_journal($journal->id);

                        echo '<div class="span3"><a href="/journals/journal/'.$journal->id.'" class="thumbnail centered" style="height: 10em; overflow: hidden; margin-bottom: 1em; text-overflow: ellipsis;">
                               <h4>'.$journal->title.' <span class="badge" title="'.$unread.' Unread by Story">'.$unread.'</span></h4>
                                
                                 <p>'.$journal->description.'</p>
                                 <p>'.$entry_count.' entries</p>
                         </a></div>';


                        if($inRow && $journal_count % 4 == 0){
                            echo '</div><!-- End row -->';
                            $inRow = false;
                        }

                    } else {
                        $emptyJournals[] = $journal;
                    }

                }
                if($inRow){
                    echo '</div><!-- End final row -->';
                }

                if(count($emptyJournals)){
                    echo "<h2>Journals with no entries for ".Event::title()."</h2> <ul>";

                    foreach($emptyJournals as $journal){
                        echo '<li><a href="/journals/journal/'.$journal->id.'">'.$journal->title.'</a></li>';
                    }
                }
                echo "</ul>";

                echo '</div>'; // End tab
            } ?>
        </div>
        
    </div>
      
  </div>
  <script>

    $('#journalTabs a').click(function (e) {
    //e.preventDefault();
    $(this).tab('show');
        e.preventDefault();
        console.log(this);
        window.location.hash = this.href.split('#')[1];
        $('#breadcrumbActive').html($(this).attr("title"));
    })
    
    $('#journalTabs a:first').tab('show');
    
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    } 

    // Change hash for page-reload
    $('.nav-tabs a').on('shown', function (e) {
        window.location.hash = e.target.hash;
        $('#breadcrumbActive').html($(this).attr("title"));
    })


    
</script>
