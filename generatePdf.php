<?php
// function fetch_data($enter)  
// {  
//    if($enter == 'all'){
//      $enter = '';
//    }
//        return $enter;
// }  


require_once('TCPDF/tcpdf.php');

if (isset($_POST['htmlContent'])) {
    // Get the HTML content from the AJAX request
    $htmlContent = $_POST['htmlContent'];
    $priceCon = $_POST['priceCon'];
  
    

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
    // Set document information
    $pdf->SetCreator('Your Creator');
    $pdf->SetAuthor('Your Author');
    $pdf->SetTitle('HTML Table to PDF');

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // // Add a page
    $pdf->AddPage();

    $left_column  = 'Sea Break Cafe'."\n".'Address: Baroro Bacnotan, La Union';
    $right_column  = 'Date: '.date('m/d/Y')."\n".'Total Sales: '.$priceCon;

    $pdf->SetfillColor(255,255,255);
    $pdf->SetTextColor(45, 106, 79);
    $pdf->SetFont('Helvetica', 'BI', 18);
    // write the first column
    $pdf->MultiCell(80, 0, $left_column, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
    $pdf->SetTextColor(8, 28, 21);
    $pdf->SetfillColor(255,255,255);
    $pdf->SetFont('Helvetica', 'BI', 10);
    $pdf->MultiCell(80, 0, $right_column, 0, 'R', 1, 0, '', '', true, 0, false, true, 0);
    $pdf->Ln(25);
    
    
    $pdf->ln(15);
    $pdf->SetTextColor(8, 28, 21;
    $pdf->SetFont('Helvetica', 8);
    $html = $htmlContent;
    $pdf->writeHTML($html, true, false, true, true, '');

   


    
    

    // // Save the PDF to a temporary file
    $pdf->lastPage();
    $upload = __DIR__ . '/seabreak.pdf';
    $pdf->Output($upload, 'F');

    $pdf->Output('seabreak.pdf', 'I');
    
echo $priceCon;
} else {
  
    header('Location: index.html');
}