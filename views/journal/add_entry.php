<?PHP
$journal_type = preg_replace('/\s+/', '', $journal->journal_type);
?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1 centered">
      <img src="/assets/home/img/section-icons/pabodie-field-notes-icon.png" width="50em"/>
    </div>
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span7">
        <h1 class="pull-right">View Journal</h1>
    </div>
  </div>
  <div class="row-fluid">
  
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="/journals">Journals</a> <span class="divider">/</span></li>
            <li><a href="/journals/#<?PHP echo $journal_type ?>"><?PHP echo $journal->journal_type ?></a> <span class="divider">/</span></li>
            <li><a href="/journals/journal/<?PHP echo urlencode($journal->id) ?>"><?PHP echo $journal->title ?></a> <span class="divider">/</span></li>
            <li class="active">Add Entry</li>
        </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
            <h2>Add Entry to <?PHP echo $journal->title ?></h2>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10">
        
        <?PHP if(isset($errors)){
           echo '<div class="alert alert-error">';
           foreach($errors as $index => $error){
               echo "<li>".$error."</li>";
           }
           echo '</div>';
         } ?>
        <form class="form-horizontal" action="<?PHP echo $_SERVER['REQUEST_URI'] ?>" method="POST">
            <input type="hidden" name="journal_id" value="<?PHP echo $journal->id ?>">
            <div class="control-group">   
                  <label class="control-label" for="inputTitle">Title</label>
                  <div class="controls">
                        <input type="text" name="title" class="input-xlarge" id="inputTitle" value="<?PHP echo $entry->title ?>">
                  </div>        
            </div>
            <div class="control-group">
                  <label class="control-label" for="inputEvent">Event</label>
                  <div class="controls">
                    <select name="event" id="inputEvent">
                        <?PHP
                        $options = Event::options();
                        $selected = 'selected="Selected"';
                        $template = '<option value="%s" %s>%s</option>';
                        foreach($options as $index => $value){
                            $sel = $index == $entry->event ? $selected : '';
                            printf($template, $index, $sel, $value);
                        }
                        ?>
                    </select>
                  </div>       
            </div>     
            <div class="control-group">   
                  <label class="control-label" for="wmd-input">Content</label>
                  <div class="controls">
                      
            <div id="wmd-button-bar"></div>
                        <textarea class="wmd-input input-xxlarge" id="wmd-input" rows="10" cols="62" class="span12" name="content"><?PHP echo $entry->content ?></textarea>
                        
                    <div id="wmd-preview" class="wmd-panel wmd-preview well input-xxlarge" style="margin-top: 1em;" ></div>
               </div>        
            </div>
            <div class="control-group">   
                  <label class="control-label" for="inputPhysrep">Physrep</label>
                  <div class="controls">
                        <input type="text" name="physrep" class="input-xlarge" id="inputPhysrep" value="<?PHP echo $entry->physrep ?>">
                  </div>        
            </div>
            <div class="control-group">   
                  <label class="control-label" for="inputAuthor">Entry Author</label>
                  <div class="controls">
                        <input type="text" name="author" class="input-xlarge" id="inputAuthor" value="<?PHP echo $entry->author ?>">
                  </div>        
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn">Make it so.</button>
              </div>
            </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#inputPhysrep').keyup(function(){
        $('#inputAuthor').val($('#inputPhysrep').val());
    }
    );
        
    var converter1 = Markdown.getSanitizingConverter();
    var editor1 = new Markdown.Editor(converter1);
    editor1.run();
});
</script>