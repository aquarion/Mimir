<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Import Player List</h1>
    </div>
  </div>

  <div class="row-fluid">
    <div class="span10 offset1">
      <p>Expected format is:<br/>
        <code>Pid,Player,Location,Character,Group Name,Nation,Path,Using Kit?,Email Address</code>
    </div>
  </div>
  <div class="row-fluid">

    <div class="span10 offset1">      
        <form class="form-horizontal" enctype="multipart/form-data" action="/players/import" method="POST">
              <!-- MAX_FILE_SIZE must precede the file input field -->

        <div class="control-group">
          <label class="control-label" for="inputFilename">Import CSV</label>
          <div class="controls">
             <input name="userfile" id="inputFilename" type="file" />
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