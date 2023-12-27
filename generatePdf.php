<?php
include_once("TCPDF/tcpdf.php");
if (isset($_POST['htmlContent'])) {
    // Get the HTML content from the AJAX request
    $htmlContent = $_POST['htmlContent'];

    // Create a PDF object
    
    $pdf = new TCPDF();
    // Set document information
    $pdf->SetCreator('Your Creator');
    $pdf->SetAuthor('Your Author');
    $pdf->SetTitle('HTML Table to PDF');

    // // Add a page
    $pdf->AddPage();

    // // Set HTML content
    $pdf->writeHTML($htmlContent, true, false, true, false, '');
    

    // // Save the PDF to a temporary file
    
    $upload = __DIR__ . '/seabreak.pdf';
    $pdf->Output($upload, 'F');

    $pdf->Output('example_002.pdf', 'I');

    // $pdfFilePath = __DIR__.'pdf';
    // $pdf->Output($pdfFilePath.'pdf', 'F');
    // $pdf->Output($pdfFilePath.'pdf', 'I');
    

    // echo json_encode(['pdfUrl' => $upload]);
    // echo json_encode($upload);
    
echo "file has been saved";
} else {
  
    header('Location: index.html');
}