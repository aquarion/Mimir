<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
        <h1 class="pull-right">Edit <?PHP echo $name ?></h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
       
    </div>
    <div class="span10">      
        <?PHP if(isset($success)){ ?>
        <div class="alert alert-success">
            <?PHP echo $success; ?>
          </div>
        <?PHP } ?>
        
        <form class="form-horizontal" action="<?PHP echo $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="control-group">
        <?PHP foreach($schema as $index => $line){ ?>
              <label class="control-label" for="input<?PHP echo $index ?>"><?PHP echo ucwords($index) ?></label>
              <div class="controls">
                <?PHP if($line['input'] == "textarea") { ?>
                    <textarea id="input<?PHP echo $index ?>" rows="3" cols="62" placeholder="<?PHP echo $index ?>" name="<?PHP echo $index ?>"><?PHP echo $item->$index ?></textarea>
                  
                <?PHP } else { ?>
                    <input type="<?PHP echo $line['input'] ?>" id="input<?PHP echo $index ?>" placeholder="<?PHP echo $index ?>" name="<?PHP echo $index ?>" value="<?PHP echo $item->$index ?>">
                <?PHP }  ?>
              </div>        
        <?PHP } ?>
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