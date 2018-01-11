<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFillColor(193,192,192);
$pdf -> SetY(100);    // set the cursor at Y position 5
$pdf -> SetX(100);
$pdf -> SetFont('Arial', 'I', 12);  // set the font
$pdf->Cell(40,12,'Descritpion',1,0,'T');  // draw a cell at pos 5 that has a a width 40 and height 400



$pdf->Output();
?>