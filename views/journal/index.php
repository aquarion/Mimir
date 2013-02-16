<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1 centered">
      <img src="/assets/home/img/section-icons/pabodie-field-notes-icon.png" width="50em"/>
    </div>
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span7">
        <h1 class="pull-right">Journals </h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span9 offset1">
        <ul class="nav nav-tabs" id="journalTabs">
            <?PHP 
            $options = $journal->journal_type_options();
            foreach($options as $index => $value){
                $index = preg_replace('/\s+/', '', $index);
                
                echo '<li><a href="#'.$index.'">'.$value.'</a></li>';
            } ?>
        </ul>
        <div class="tab-content">            
            <?PHP 
            
            foreach($journal->journal_type_options() as $index => $value){
                $index = preg_replace('/\s+/', '', $index);
                echo '<ul class="tab-pane" id="'.$index.'">';
                $myJournals = Model::factory('Journal')->where('journal_type', $value)->find_many();
                #echo '<div class="span3">Hello</div>';
                $span = 0;
                foreach($myJournals as $journal){
                    if($span == 0){
                        echo '<div class="row-fluid" style="padding-bottom: 1em;">';
                    }
                    echo '<li class="span3"><a href="/journals/journal/'.$journal->id.'" class="thumbnail centered" style="height: 120px">
                          <h4>'.$journal->title.'</h4> '.$journal->description.' 
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
    })
    
</script>