<div class="container-fluid">
  <div class="row-fluid">
    <div class="span1 centered">
      <img src="/assets/home/img/section-icons/pabodie-field-notes-icon.png" width="50em"/>
    </div>
    <div class="span5">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span6">
        <h1 class="pull-right">Add New Journal</h1>
    </div>
  </div>
  <div class="row-fluid">
  
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="/journals">Journals</a> <span class="divider">/</span></li>
            <li class="active">Create Journal</li>
        </ul>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span11 offset1">
        <?PHP if(isset($errors)){
           echo '<div class="alert alert-error">';
           foreach($errors as $index => $error){
               echo "<li>".$error."</li>";
           }
           echo '</div>';
         } ?>
        <form class="form-horizontal" action="<?PHP echo $_SERVER['REQUEST_URI'] ?>" method="POST">
            <div class="control-group">   
                  <label class="control-label" for="inputTitle">Name</label>
                  <div class="controls">
                        <input type="text" name="title" id="inputTitle" value="<?PHP echo $journal->title ?> ">
                  </div>        
            </div>
            <div class="control-group">
                  <label class="control-label" for="inputType">Type</label>
                  <div class="controls">
                    <select name="journal_type" id="inputType">
                        <?PHP
                        $options = $journal->journal_type_options();
                        $selected = 'selected="Selected"';
                        $template = '<option value="%s" %s>%s</option>';
                        foreach($options as $index => $value){
                            $sel = $index == $journal->journal_type ? $selected : '';
                            printf($template, $index, $sel, $value);
                        }
                        ?>
                    </select>
                  </div>       
            </div>     
            <div class="control-group">   
                  <label class="control-label" for="inputDescription">Description</label>
                  <div class="controls">
                        <textarea id="inputDescription" rows="3" cols="62"  name="description"><?PHP echo $journal->description ?></textarea>
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