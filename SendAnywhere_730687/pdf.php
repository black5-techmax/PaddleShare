<?php
include('fpdf.php');

if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Set title font
    $pdf->SetFont("Arial", "B", 24);
    
    // Add logo
    $pdf->Image('logo.png', 10, 10, 30, 30);
    
    // Center the title
    $pdf->SetX(50);
    $pdf->Cell(0, 20, "Paddle-Share", 0, 1, 'C');
    
    // Add a horizontal line under the title
    $pdf->Line(10, 40, 200, 40);

    // Set the font for the details
    $pdf->SetFont("Arial", "", 14);

    // Calculate the available space for the details to be centered vertically
    $pageHeight = $pdf->GetPageHeight();
    $topMargin = 50;  // Top margin from the top of the page
    $bottomMargin = 20; // Bottom margin before the footer
    $contentHeight = $pageHeight - $topMargin - $bottomMargin;

    // Total number of lines for the details
    $lines = 8;  // (One for each field: R_Id, Driver Name, Date, etc.)

    // Calculate the height for each line and adjust the starting point
    $lineHeight = 10;  // Each line has a height of 10mm
    $contentHeightUsed = $lines * $lineHeight;
    $startY = ($pageHeight - $contentHeightUsed) / 2; // Vertically center the content
    
    // Set the Y position to start from the calculated center
    $pdf->SetY($startY);

    // Add the details in the center
    $pdf->Cell(40, 10, 'R_Id:', 0, 0); 
    $pdf->Cell(0, 10, '001', 0, 1);
    
    $pdf->Cell(40, 10, 'Driver Name:', 0, 0);
    $pdf->Cell(0, 10, 'John Doe', 0, 1);
    
    $pdf->Cell(40, 10, 'Date:', 0, 0);
    $pdf->Cell(0, 10, '2025-03-04', 0, 1);
    
    $pdf->Cell(40, 10, 'Time:', 0, 0);
    $pdf->Cell(0, 10, '12:00 PM', 0, 1);
    
    $pdf->Cell(40, 10, 'Source:', 0, 0);
    $pdf->Cell(0, 10, 'Location A', 0, 1);
    
    $pdf->Cell(40, 10, 'Destination:', 0, 0);
    $pdf->Cell(0, 10, 'Location B', 0, 1);
    
    $pdf->Cell(40, 10, 'Price:', 0, 0);
    $pdf->Cell(0, 10, '$50.00', 0, 1);
    
    $pdf->Cell(40, 10, 'Payment Mode:', 0, 0);
    $pdf->Cell(0, 10, 'Credit Card', 0, 1);
    
    // Output the PDF
    $pdf->Output();
}
?>
