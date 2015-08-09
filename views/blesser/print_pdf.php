<?php

use \Michelf\Markdown;

// create new PDF document
$pdf = OdysseyPDF::by_defaults();

foreach($characters as $character){
    // add a page
    $pdf->AddPage();

    $pdf->SetY(20);

    $pdf->odcPageHeader('Exceptional Abilities for '.Event::title());

    $pdf->odcFontHeading();
    $pdf->Cell(100, 10, $character['name'], 'B', 0, 'L', 1, '', 0, false, 'M', 'M');
    $pdf->Cell(90, 10, $character['pid'], 'B', 1, 'R', 1, '', 0, false, 'M', 'M');
    $pdf->odcFontNormal();

    $pdf->AddY(5);

    $tokens = array();

    foreach($character['blessings'] as $blessing){
        // $pdf->MultiCell(100, 0, $blessing->effect, 'B', 1, 'L', 1, '', 0, false, 'T', 'M');
        //$pdf->MultiCell(100, 0, $blessing->effect, 'B', 1, 'L', 1, '', 0, false, 'T', 'M');
        //$pdf->write(5, $blessing->effect, false, false, 'L', true, 0, false, false, false, false, array('L' => 30));
        $y = $pdf->GetY();

        if($blessing->has_tokens()){
            $tokens = array_merge($tokens, $blessing->tokens());
        }

        #$pdf->writeHTMLCell(60, '', '', $y, $blessingstuff, 0, 0, 0, true, 'L', true);

        //$pdf->Cell(w, h, txt, border, ln, align, fill, link, stretch, ignore_min, calign, valign);
        $pdf->SetTextColor    (128, 128, 128, false, false, 'black'); 
        $pdf->Cell(20, 3, "From", '', 0, 'L');
        $pdf->AddY(7);
        $pdf->Cell(20, 3, "Nation", '', 0, 'L');
        $pdf->AddY(7);
        $pdf->Cell(20, 3, "Reason", '', 0, 'L');
        $pdf->AddY(12);
        $pdf->Cell(20, 3, "Duration", '', 0, 'L');
        
        $x = 25;
        $pdf->SetY($y);
        $pdf->SetTextColor    (0, 0, 0, false, false, 'black'); 

        $blam = explode(":", $blessing->issuer, 2);
        if(count($blam) > 1){
            $issuer = trim($blam[1]);
        } else {
            $issuer = $blam[0];
        }

        $pdf->SetX($x);
        $pdf->MultiCell(50, 0, $issuer, '', 'L', 0, 0);
        $pdf->AddY(7);

        $pdf->SetX($x);
        $pdf->MultiCell(50, 0, $blessing->target_nation, '', 'L', 0, 0);
        $pdf->AddY(7);
        
        $pdf->SetX($x);
        $pdf->MultiCell(50, 0, $blessing->reason, '', 'L', 0, 0);
        $pdf->AddY(12);
        
        $pdf->SetX($x);
        $pdf->MultiCell(50, 0, $blessing->duration, '', 'L', 0, 0);

        $left_y = $pdf->GetY();

        $pdf->SetY($y);
        //    writeHTMLCell($w, $h, $x, $y, $html='',        $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

        $blessingText = '';
        if($blessing->description) {
            $blessingText .= Markdown::defaultTransform($blessing->description)."<hr/>";
        }
        if($blessing->effect) {
            $blessingText .= Markdown::defaultTransform($blessing->effect);
        }


        $pdf->writeHTMLCell(120, '', 80, '', $blessingText, 0, 1, 0, true, 'L', true);

        if($pdf->GetY() < $left_y){
            $pdf->SetY($left_y);
        }

        $pdf->AddY(5);
        $pdf->Cell(0, 10, " ", 'B', 1, 'R', false, '', 0, false, 'M', 'M');
        $pdf->AddY(5);

        $blessing->date_printed = date(DATETIME_MYSQL);
        $blessing->save();
    }

    if(count($tokens)){

        $pdf->odcFontHeading();
        $pdf->Cell(0, 10, $character['name']." Handout Tokens", 'B', 0, 'L', 0, '', 0, false, 'M', 'M');
        $pdf->odcFontNormal();
        $pdf->AddY(7);

        $pdf->SetTextColor    (0, 0, 0, false, false, 'black'); 

        foreach($tokens as $token){
            for ($i=0; $i < $token['count']; $i++) {


                $html = '';

                
                if($token['target']){
                    $html .= sprintf("<h2>%s</h2>", $token['target']);
                }
                $html .= '<br/>'.$token['effect'];
                $html .= sprintf('<br/><i>%d/%d/%d/%d</i>', $token['blessing'],  $token['token_id'], $i, $token['count']);

                $pdf->startTransaction();
                $startPage = $pdf->getPage();
                $pdf->SetCellPadding(2);
                $pdf->writeHTMLCell(0, '', 10, '', $html, 'TLRB', 1, 0, true, 'L', true);

                if($pdf->getPage() == $startPage){
                    $pdf->commitTransaction();
                } else {
                    $pdf = $pdf->rollbackTransaction();
                    $pdf->AddPage();
                    $pdf->SetCellPadding(2);
                    $pdf->writeHTMLCell(0, '', 10, '', $html, 'TLRB', 1, 0, true, 'L', true);
                }
                

                $pdf->AddY(6);
            }
        }
    }

}

$pdf->Output('blessingslist.pdf', 'I');