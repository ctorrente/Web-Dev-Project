<?php 

if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}

require_once('http://localhost/program/htmlpdf/html2pdf/html2pdf.class.php');

class Htmlpdf {
    var $ci;
    public function __construct(){
        $this->ci =& get_instance();
    }
    
    public function convert($data, $program_code, $curriculum_year){
        $width = 8.5 * 25.4; $height = 11 * 25.4;
        $html = new HTML2PDF('P',array($width,$height),'en');
        $html->writeHTML($data);
				header('Cache-Control: private, max-age=0, must-revalidate');
        $html->Output('curriculum-'."$program_code-$curriculum_year".'.pdf');
    }
}

?>