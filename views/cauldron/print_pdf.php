<?php

use \Michelf\Markdown;

// create new PDF document
$pdf = new PlainPDF();
$pdf->setupFonts();

$col = 0;

$w = 68;

$mystery_template = '
<h3 class="mysteryname">%s</h3>
<table>
    <tr>
        <td>
            <img src="/assets/home/img/elements/icons/earth_element-25.png" />
        </td>
        <td>
            <img src="/assets/home/img/elements/icons/fire_element-25.png" />
        </td>
        <td>
            <img src="/assets/home/img/elements/icons/air_element-25.png" />
        </td>
        <td>
            <img src="/assets/home/img/elements/icons/water_element-25.png" />
        </td>
        <td>
            <img src="/assets/home/img/elements/icons/water_filled-25.png" />
        </td>
        <td>
            <img src="/assets/home/img/elements/icons/receive_cash_filled_sasha-25.png" />
        </td>
    </tr>
    <tr>
        <td>
            %d
        </td>
        <td>
            %d
        </td>
        <td>
            %d
        </td>
        <td>
            %d
        </td>
        <td>
            %d
        </td>
        <td>
            %d
        </td>
    </tr>
</table>
<p>%s</p>
<p>%s</p>
';

$sheet = false;

foreach($mysteries as $mystery){
    
    if ($mystery['sheet'] != $sheet){
        $pdf->AddPage();
        $col = 0;

        $sheet = $mystery['sheet'];
        $pdf->odcPageHeader($sheet);

        $row_y = $row_h = $pdf->GetY();
    }
    if($col == 3){
        $col = 0;
        $row_y = $row_h + 3;
        $pdf->SetY($row_y);
    }

    //    writeHTMLCell($w, $h, $x, $y, $html='',        $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
    $html = sprintf($mystery_template, 
        $mystery['name'], $mystery['earth'], $mystery['fire'],
        $mystery['air'], $mystery['water'], $mystery['blood'], $mystery['coin'],
        $mystery['effect'], $mystery['type']);


    $pdf->startTransaction();
    $startPage = $pdf->getPage();
    $pdf->writeHTMLCell($w-5, '', ($col*$w)+5, '', $html, 'TRBL', 1, 0, true, 'L', true);

    if($pdf->getPage() == $startPage){
        $pdf->commitTransaction();
    } else {
        error_log('New Page, '.$pdf->getPage().' !== '.$startPage);
        $pdf = $pdf->rollbackTransaction();

        $pdf->AddPage();
        $col = 0;
        $row_y = $row_h = 30;
        $pdf->SetY($row_y);

        $pdf->writeHTMLCell($w-5, '', ($col*$w)+5, '', $html, 'TRBL', 1, 0, true, 'L', true);
    }
    
    $row_h = $pdf->GetY() > $row_h ? $pdf->GetY() : $row_h;
    $pdf->SetY($row_y);

    $col++;
}

$pdf->Output('mysterylist.pdf', 'I');