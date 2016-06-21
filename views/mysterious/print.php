<?PHP

use \Michelf\Markdown;

$pdf = OdysseyPDF::by_defaults();

/*

    $newmystery->event_id = Event::current();
    $newmystery->sign_requirement = Event::current_attribute('sign');
    $newmystery->set = substr($sheet0, 15);

    $newmystery->code = $mystery[0];
    $newmystery->name = $mystery[1];
    // Focus
    $newmystery->short_desc = $mystery[3];
    $newmystery->flavour = $mystery[4];
    $newmystery->mystery_type = $mystery[$sheet];

    $newmystery->effect_type  = $mystery[5];
    $newmystery->culture = $mystery[6];
    $newmystery->drachma = $mystery[7];
    $newmystery->prime = $mystery[8];
    $newmystery->quin_fire = $mystery[9];
    $newmystery->quin_earth = $mystery[10];
    $newmystery->quin_air = $mystery[11];
    $newmystery->quin_water = $mystery[12];
    $newmystery->blood = $mystery[13];

    $newmystery->duration = $mystery[15];
    $newmystery->aquisition_type = $mystery[16];
    $newmystery->effect = $mystery[17];
*/

foreach($mysteries as $mystery ){
	$pdf->AddPage();

	$pdf->SetY(20);

	$pdf->odcFontHeading();
	$pdf->Cell(0, 10, $mystery->name, 'B', 1, "C", True);
	$pdf->AddY(3);
	$pdf->odcFontItalic();
	// $pdf->Cell(0, 0, $item['Descriptor Text'], '', 1, "C", false);

	$pdf->MultiCell(0, 0, $mystery->flavour, '', "C", false);
	$pdf->odcFontNormal();
	$pdf->AddY(3);

    $pdf->SetFont($pdf->font_Candara_Italic, 'I', 18);

    $titleWidth = 40;
	$pdf->AddX(10);

	$pdf->Cell($titleWidth, 10, "Fire", 'TBL', 0, "R", False);
	$pdf->Cell(10, 10,  $mystery->quin_fire ? $mystery->quin_fire : 0, 'TRB', 0, "C", False);
	$pdf->AddX(10);

	$pdf->Cell($titleWidth, 10, "Water", 'TBL', 0, "R", False);
	$pdf->Cell(10, 10,  $mystery->quin_water ? $mystery->quin_water : 0, 'TRB', 0, "C", False);
	$pdf->AddX(10);

	$pdf->Cell($titleWidth, 10, "Blood", 'TBL', 0, "R", False);
	$pdf->Cell(10, 10,  $mystery->blood ? $mystery->blood : 0, 'TRB', 1, "C", False);
	$pdf->AddY(10);
	// New line

	$pdf->AddX(10);
	$pdf->Cell($titleWidth, 10, "Earth", 'TBL', 0, "R", False);
	$pdf->Cell(10, 10,  $mystery->quin_earth ? $mystery->quin_earth : 0, 'TRB', 0, "C", False);
	$pdf->AddX(10);

	$pdf->Cell($titleWidth, 10, "Air", 'TBL', 0, "R", False);
	$pdf->Cell(10, 10,  $mystery->quin_air ? $mystery->quin_air : 0, 'TRB', 0, "C", False);
	$pdf->AddX(10);

	$pdf->Cell($titleWidth, 10, "Drachma", 'TBL', 0, "R", False);
	$pdf->Cell(10, 10,  $mystery->drachma ? $mystery->drachma : 0, 'TRB', 1, "C", False);
	$pdf->AddY(10);

	$pdf->odcFontNormal();
	$pdf->SetCellPadding(2);

	$pdf->MultiCell(0, 0, $mystery->effect, 'TRBL', "L", false);

	$pdf->AddY(3);

	$pdf->odcFontBoldItalic(9);
	$pdf->MultiCell(0, 0, "This Greater Mystery may only be cast once at the ".ucwords(Event::ordinal())." Annual unless otherwise specified, and may only be cast under the Sign of ".$mystery->sign_requirement, '', "C", false);

	$pdf->odcFontNormal(9);


	$image_file = 'assets/pdf/pdlogo.jpg';
	$pdf->Image($image_file, false, false, false, false, 'JPG', '', 'T', false, 150, '', false, false, 0, false, false, false);

	$text = 'This sheet represets the information available through the use of the Lesser Mystery "Wisdom of the Seer" on a Greater Mystery focus. This information is valid only for the '.ucwords(Event::ordinal()).' Annual. 

This is an OOC document, but represents IC knowledge your character has gained of the purpose of the Greater Mystery and the ritual and ceremony necessary for the casting of it.';

	$pdf->odcFontItalic(9);
	$pdf->MultiCell(130, 0, $text, '', "L", false, 0, 40);

	$pdf->odcFontHeading();
	$pdf->Cell(30, 30, $mystery->code, 'TRBL', 0, "C", true, '', True);

}

$pdf->Output('mystery.pdf', 'I');
