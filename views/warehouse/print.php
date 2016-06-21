<?PHP

use \Michelf\Markdown;

$pdf = OdysseyPDF::by_defaults();

foreach($items as $item ){
	$pdf->AddPage();

	$pdf->SetY(20);

	$pdf->odcFontHeading();
	$pdf->Cell(0, 10, $item['Item'], 'B', 1, "C", True);
	$pdf->AddY(3);
	$pdf->odcFontItalic();
	// $pdf->Cell(0, 0, $item['Descriptor Text'], '', 1, "C", false);
	$pdf->MultiCell(0, 0, $item['Descriptor Text'], '', "C", false);
	$pdf->odcFontNormal();
	$pdf->AddY(3);


	$pdf->SetCellPadding(2);

	$pdf->MultiCell(0, 0, $item['Rules Effect'], 'TRBL', "L", false);

	$pdf->AddY(3);


	$image_file = 'assets/pdf/pdlogo.jpg';
	$pdf->Image($image_file, false, false, false, false, 'JPG', '', 'T', false, 150, '', false, false, 0, false, false, false);

	$text = 'This artefact cannot be destroyed by normal means. You should call RESIST to any CRUSH that would damage this item, although the call affects your other items as normal.

This artifact physrep is the Property of Profound Decisions and must be returned at end of event, This information is valid only for the '.ucwords(Event::ordinal()).' Annual. 

To be able to use this artefact you must have either read this rules sheet while in possession of the item or consulted a referee and shown them the item.';

	$pdf->odcFontItalic(9);
	$pdf->MultiCell(130, 0, $text, '', "L", false, 0, 40);

	$pdf->odcFontHeading();
	$pdf->Cell(30, 30, $item['Ribbon #'], 'TRBL', 0, "C", true, '', True);

}

$pdf->Output('blessingslist.pdf', 'I');