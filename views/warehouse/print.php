<?PHP

use \Michelf\Markdown;

$pdf = OdysseyPDF::by_defaults();

$pdf->AddPage();

$pdf->SetY(20);

$pdf->odcFontHeading();
$pdf->Cell(0, 10, $item['Item'], 'B', 1, "C", True);
$pdf->AddY(3);
$pdf->odcFontItalic();
$pdf->Cell(0, 0, $item['Descriptor Text'], '', 1, "C", false);
$pdf->odcFontNormal();
$pdf->AddY(3);


$pdf->SetCellPadding(2);

$pdf->MultiCell(0, 0, $item['Rules Effect'], 'TRBL', "L", false);

$pdf->AddY(3);


$image_file = 'assets/pdf/pdlogo.png';
$pdf->Image($image_file, false, false, false, false, 'PNG', '', 'T', false, 150, '', false, false, 0, false, false, false);

$text = 'This artefact cannot be destroyed by normal means. You should call RESIST to any CRUSH that would damage this item, although the call affects your other items as normal.
This artifact physrep is the Property of Profound Decisions and must be returned at end of event

To be able to use this artefact you must have either read this rules sheet while in possession of the item or consulted a referee and shown them the item.';

$pdf->odcFontItalic(9);
$pdf->MultiCell(130, 0, $text, '', "L", false, 0, 40);

$pdf->odcFontHeading();
$pdf->Cell(30, 30, $item['Ribbon #'], 'TRBL', 0, "C", true, '', True);

/* ?>

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

	</div>


  </div>

<?PHP */
$pdf->Output('blessingslist.pdf', 'I');