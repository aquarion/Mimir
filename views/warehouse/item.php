<?PHP

use \Michelf\Markdown;


?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span8 text-right">
        <h1 class="text-right"><?PHP echo $item['Item'] ?></h1>


		<p class="text-right"><i><?PHP echo Markdown::defaultTransform($item['Descriptor Text']); ?></i></p>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">

	</div>
  </div>
  <div class="row-fluid">
    <div class="span10 offset1">

		<p><?PHP echo Markdown::defaultTransform($item['Rules Effect']); ?></p>

		<h2>Wisdom of the Seer</h2>
			<p><?PHP echo Markdown::defaultTransform($item['WOTS']); ?></p>

		<h2>Wisdom of the Ages</h2>
			<p><?PHP echo Markdown::defaultTransform($item['WOTA']); ?></p>
	
	<h2>Other</h2>
	<table class="table table-striped">
		<tr>
			<th>Ribbon ID</th>
			<td><?PHP echo $item['Ribbon #'] ?></td>
		</tr>
		<tr>
			<th>Type</th>
			<td><?PHP echo $item['Type'] ?></td>
		</tr>
		<tr>
			<th>Phys-rep</th>
			<td><?PHP echo $item['Phys-rep'] ?></td>
		</tr>
		<tr>
			<th>Source</th>
			<td><?PHP echo $item['Source'] ?></td>
		</tr>
		<tr>
			<th>Pack In:</th>
			<td><?PHP echo $item['Pack in:'] ?></td>
		</tr>
	</table>
	<a class="btn btn-primary" href="<?PHP printf('/warehouse/printpdf/%s/%d', $sheet, $row); ?>"><i class="icon-print icon-white"></i> Print</a>
	</div>


  </div>
