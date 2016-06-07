<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8">
        <h1 class="pull-right">Items</h1>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">


<ul id="myTab" class="nav nav-tabs">
<?PHP 

$sheet_id = -1;
$active = true;
foreach($items as $sheet_name => $sheet_items){
  $sheet_id += 1;
  echo '<li '.($active ? 'class="active"' : '').'><a href="#tabContent'.$sheet_id.'" data-toggle="tab">'.$sheet_name.'</a>'.
  '</li>';
  $active = false;
}
?>
</ul>
  <div class="tab-content">
<?PHP

$sheet_id = -1;
$active = true;
foreach($items as $sheet_name => $sheet_items){
  $sheet_id += 1;

  ?>
  <div id="tabContent<?PHP echo $sheet_id ?>" class="tab-pane <?PHP echo ($active ? 'active' : '') ?>">
  <h1><?PHP 
    echo $sheet_name;
    printf('<a class="btn btn-primary" href="/warehouse/printpdfsheet/%s"><i class="icon-print icon-white"></i> Print All</a>', urlencode($sheet_name));
  ?></h1>
  <table class="table-striped table-bordered " width="100%">
  <thead>
    <tr>
      <th>Ribbon #</th>
      <th>Item</th>
      <th>Type</th>
      <th>Phys-rep</th>
      <th>Source</th>
      <th>WOTS</th>
      <th>WOTA</th>
      <th>Column1</th>
      <th>Pack in:</th>

      <!-- <th>Kit</th> -->
  </thead>
  <tbody>
  <?PHP

  foreach($sheet_items as $i => $row){

      unset($row['Rules Effect']);
      unset($row['Descriptor Text']);
      $row['Ribbon #'] = sprintf('<a href="/warehouse/item/%s/%d">%s</a>', urlencode($sheet_name), $i, $row['Ribbon #'] );
      $row['Item'] = sprintf('<a href="/warehouse/item/%s/%d">%s</a>', urlencode($sheet_name), $i, $row['Item'] );
      // unset($row['Pack in:']);
      $row['WOTA'] = ($row['WOTA'] || ($row['WOTA'] != "no")) ? 'Yes' : 'No';
      $row['WOTS'] = ($row['WOTS'] || ($row['WOTS'] != "no")) ? 'Yes' : 'No';
      $row['Print'] = sprintf('<a class="btn btn-primary" href="/warehouse/printpdf/%s/%d"><i class="icon-print icon-white"></i></a>', $sheet_name, $i);
  ?>
  <tr>
         <td><?PHP echo implode("</td><td>", $row); ?></td>
  </tr>
  <?PHP } // end items loop ?>


</tbody>
</table>
</div> <!-- End tab -->
<?PHP 

  $active = false;
} // End sheets loop ?>

</table>

<script type="text/javascript">


$(document).ready(function(){
      $("table").tablesorter();

})


</script>

    </div>
  </div>
</div>