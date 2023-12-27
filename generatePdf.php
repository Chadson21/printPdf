<?php
require_once('TCPDF/tcpdf.php');

if (isset($_POST['htmlContent'])) {
    // Get the HTML content from the AJAX request
    $htmlContent = $_POST['htmlContent'];

// echo $htmlContent;
    // Create a PDF object
    
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // Set document information
    $pdf->SetCreator('Your Creator');
    $pdf->SetAuthor('Your Author');
    $pdf->SetTitle('HTML Table to PDF');

    // // Add a page
    $pdf->AddPage();

    // // Set HTML content
    $pdf->writeHTML($htmlContent, true, false, true, false, '');
    

    // // Save the PDF to a temporary file
    $pdfFilePath = 'generated_pdf';
    $upload = __DIR__.$pdfFilePath.'.pdf';
    $pdf->Output($upload, 'F');
    $pdf->Output($pdfFilePath, 'I');

    // $pdfFilePath = __DIR__.'pdf';
    // $pdf->Output($pdfFilePath.'pdf', 'F');
    // $pdf->Output($pdfFilePath.'pdf', 'I');
    

    echo json_encode(['pdfUrl' => $upload]);
} else {
  
    header('Location: index.html');
}