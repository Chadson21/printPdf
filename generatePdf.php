<?php
include_once("TCPDF/tcpdf.php");
if (isset($_POST['htmlContent'])) {
    // Get the HTML content from the AJAX request
    $htmlContent = $_POST['htmlContent'];
    $priceCon = $_POST['priceCon'];

    // Create a PDF object
    
    $pdf = new TCPDF();
    // Set document information
    $pdf->SetCreator('Your Creator');
    $pdf->SetAuthor('Your Author');
    $pdf->SetTitle('HTML Table to PDF');

    // // Add a page
    $pdf->AddPage();
    $html = $htmlContent;
    $html .= $priceCon;
    // // Set HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    

    // // Save the PDF to a temporary file
    
    $upload = __DIR__ . '/seabreak.pdf';
    $pdf->Output($upload, 'F');

    $pdf->Output('seabreak.pdf', 'I');

    // $pdfFilePath = __DIR__.'pdf';
    // $pdf->Output($pdfFilePath.'pdf', 'F');
    // $pdf->Output($pdfFilePath.'pdf', 'I');
    

    // echo json_encode(['pdfUrl' => $upload]);
    // echo json_encode($upload);
    
echo $priceCon;
} else {
  
    header('Location: index.html');
}