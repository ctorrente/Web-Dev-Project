<?php
	$conn = mysqli_connect('localhost', 'root', 'sS201211235', 'dcs_project');
	$curriculum_id = $_GET['curriculum_id'];
	$pdfviews = mysqli_query($conn, "UPDATE curriculum_downloads SET download_count_value = download_count_value + 1 WHERE curriculum_id = " . $curriculum_id . ";");
	
    ob_start();
    include('pdf_format.php');
    $content = ob_get_clean();

	require_once('htmlpdf/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('curriculum.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>