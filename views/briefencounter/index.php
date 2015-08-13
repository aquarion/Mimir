<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Briefing Sheets</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">
     <?PHP foreach($directories as $header => $content){
      $fileset = $content['fileset'];
      $dir = $content['dir'];
      echo '<h1>'.ucwords($header).'</h1>';
      foreach($fileset as $file){
        $file = basename($file);
        echo '<a href="/briefencounter/show/'.urlencode($header).'/'.urlencode($file).'">';
        echo '<img src="/assets/home/img/filetypes/PDF-32.png" valign="middle">';
        echo $file.'</a><br/>';
      }
    }
     ?>
    </div>
  </div>
</div>