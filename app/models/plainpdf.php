<?PHP
// Include the main TCPDF library (search for installation path).
require_once('../lib/tcpdf/tcpdf.php');

class PlainPDF extends TCPDF {
    
    public function setupFonts(){

        $this->font_Candara = TCPDF_FONTS::addTTFfont("../fonts/Candara.ttf", "TrueTypeUnicode", "", 32);
        $this->font_Candara_Italic = TCPDF_FONTS::addTTFfont("../fonts/Candarai.ttf", "TrueTypeUnicode", "", 32);
        $this->font_Candara_Bold = TCPDF_FONTS::addTTFfont("../fonts/Candarab.ttf", "TrueTypeUnicode", "", 32);
        $this->font_Candara_BI = TCPDF_FONTS::addTTFfont("../fonts/Candaraz.ttf", "TrueTypeUnicode", "", 32);

    }
    public function AddY($int){
      $y = $this->GetY();
      $this->SetY($y+$int);
    }

    public function odcFontHeading($size=18){
        $this->SetFont($this->font_Candara_Italic, 'I', $size);
        //$pdf->SetTextColor    ($r, $g, $b, $k, $ret, $name);
        $this->SetTextColor    (31, 73, 125, false, false, 'darkblue'); 
    }

    public function odcFontNormal($size=10){
        $this->SetFont($this->font_Candara, '', 10);
        $this->SetTextColor    (0, 0, 0, false, false, 'black'); 
    }

    public function odcPageHeader($words){

        $this->odcFontHeading();
        $this->Write(0, $words, '', 0, 'R', 2, 0, false, false, 0);
        $this->odcFontNormal();
        $this->AddY(5);
    }

    //Page header
    public function Header() {
        return;
    }

    // Page footer
    public function Footer() {
        return;
    }
}