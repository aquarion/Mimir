<?PHP


// Include the main TCPDF library (search for installation path).
require_once('../lib/tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class OdysseyPDF extends TCPDF {

    static function by_defaults(){
        $pdf = new OdysseyPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetTopMargin(20);

        $pdf->setupFonts();

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 30);
        $pdf->SetFooterMargin(30);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddSpotColor("black", 0, 0, 0 , 100);   

        $pdf->SetFillSpotColor('black', 5);


        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        return $pdf;
    }

    public function setupFonts(){

        $this->font_Candara = TCPDF_FONTS::addTTFfont("../fonts/Candara.ttf", "TrueTypeUnicode", "", 32);
        $this->font_Candara_Italic = TCPDF_FONTS::addTTFfont("../fonts/Candarai.ttf", "TrueTypeUnicode", "", 32);
        $this->font_Candara_Bold = TCPDF_FONTS::addTTFfont("../fonts/Candarab.ttf", "TrueTypeUnicode", "", 32);
        $this->font_Candara_BI = TCPDF_FONTS::addTTFfont("../fonts/Candaraz.ttf", "TrueTypeUnicode", "", 32);

    }

    //Page header
    public function Header() {
        //$pdf->ImageSVG($file='images/testsvg.svg', $x=15, $y=30, $w='', $h='', $link='http://www.tcpdf.org', $align='', $palign='', $border=1, $fitonpage=false);

        // $this->ImageSVG($file='assets/pdf/header.svg', $x=-30, $y=1, $w='', $h='', $link=false, $align='T', $palign='c', $border=0, $fitonpage=false);
        // Logo
        $image_file = 'assets/pdf/header.png';
        $this->Image($image_file, -1, 0, 210, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        //$file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array())

        $this->SetX(0);
        $this->SetY(20);
        // // Set font
    }

    // Page footer
    public function Footer() {
        // // Position at 15 mm from bottom
        $this->SetY(-15);
        $image_file = 'assets/pdf/footer.png';
        $this->Image($image_file, -1, 280, 210, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // // Set font
        // $this->SetFont('helvetica', 'I', 8);
        // // Page number
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        //$this->SetY(-15);
        // $this->ImageSVG($file='assets/pdf/footer.svg', $x=-30, $y=270, $w='', $h='', $link=false, $align='B', $palign='c', $border=0, $fitonpage=false);

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
}
