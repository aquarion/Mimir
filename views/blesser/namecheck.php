<?PHP 
use \Michelf\Markdown;
$print = array();
?>
<style type="text/css">
.panel {
  border: 1px solid #666;
  border-radius: 7px;
  padding: 1em;
  margin-bottom: 1em;
}
</style>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span6">
        <h1 class="pull-right"><?PHP 
        if ($lnav_active == "deity"){
          echo "By Issuer";
        } elseif (isset($lnav_active)){
          echo ucwords($lnav_active);
        } else {
          echo 'View';
          $lnav_active = '';
        }
        ?> Blessings</h1>

        <?PHP if($lnav_active == 'review') { ?>
          <p>There is no coming back from clicking one of these buttons unless you're supposed to. 
          You are being watched, and those who watch will wait.</p>
        <?PHP } ?>
    </div>
  </div>
<?PHP

foreach($players as $id => $data){
  $p = false;
  if (!$id){
    echo "<h1>No PID supplied</h1>";
  } elseif (!$data['player']){
    // echo "<pre>"; var_dump($data);echo "</pre>";
    $b = $data['blessings'][0];
    printf("<h1>%s - %s<span class=\"label label-important\">No Booking Found for PID</span></h1>", $b->target_id, $b->target_name);
  } else {
    $p = $data['player'];
    printf("<h1>%s - %s</h1>", $p->pid, $p->character_name);
  }
  foreach($data['blessings'] as $b){ 
    $warnings = array();

    if ($p && $b->target_name != $p->character_name){
      $warnings[] = '<span class="label label-warning">Names don\'t match</span>';
    }

    $warning = implode($warnings);

    $effect = substr($b->effect, 0, 72)."&hellip;";
    printf("Blessing of <b>%s</b> - Source <b>%s</b> for <b>%s</b> %s <p>%s <a href=\"/blesser/create?id=%d\" class=\"btn btn-mini\"><i class=\"icon-trash icon-edit\"></i> Edit</a></p>",
      $b->issuer, $b->blessing_type, $b->target_name, $warning, $effect, $b->id);
    // echo "<pre>"; var_dump($b);echo "</pre>";
  }
}