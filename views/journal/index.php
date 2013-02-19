<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1 centered">
      <img src="/assets/home/img/section-icons/pabodie-field-notes-icon.png" width="50em"/>
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
            <li class="active" id="breadcrumbActive">Deity</li>
        </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span9 offset1">
        <ul class="nav nav-tabs" id="journalTabs">
            <?PHP 
            $options = $journal->journal_type_options();
            foreach($options as $index => $value){
                $unread = $journal->unread_by_type($index);
                echo '<li><a href="#'.$index.'">'.$value.' <span class="badge" title="'.$unread.' Unread by Story">'.$unread.'</span></a></li>';
            } ?>
        </ul>
        <div class="tab-content">            
            <?PHP 
            
            foreach($journal->journal_type_options() as $index => $value){
                $index = preg_replace('/\s+/', '', $index);
                echo '<ul class="tab-pane" id="'.$index.'">';
                $myJournals = Model::factory('Journal')->where('journal_type', $index)->find_many();
                #echo '<div class="span3">Hello</div>';
                $span = 0;
                foreach($myJournals as $journal){
                    if($span == 0){
                        echo '<div class="row-fluid" style="padding-bottom: 1em;">';                        
                    }
                    $unread = $journal->unread_by_journal($journal->id);
                    
                    echo '<li class="span3"><a href="/journals/journal/'.$journal->id.'" class="thumbnail centered" style="height: 120px">
                          <h4>'.$journal->title.' <span class="badge" title="'.$unread.' Unread by Story">'.$unread.'</span></h4>
                            
                            <p>'.$journal->description.'</p>
                            <p>'.$journal->entry_count().' entries</p>
                     </a></li>';
                    if ($span >= 12){
                        echo '</div>';
                        $span = -4;
                    }
                    $span += 4;
                }
                if($span !== 0){
                    echo '</div>';
                }
                echo '</ul >';
            } ?>
        </div>
        
    </div>
      
  </div>
  <script>

    $('#journalTabs a').click(function (e) {
    //e.preventDefault();
    $(this).tab('show');
    })
    
    $('#journalTabs a:first').tab('show');
    
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    } 

    // Change hash for page-reload
    $('.nav-tabs a').on('shown', function (e) {
        window.location.hash = e.target.hash;
        $('#breadcrumbActive').html($(this).html());
    })
    
</script>