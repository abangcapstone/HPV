<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->SetTopMargin(20);
$pdf->AddPage();
$pdf->SetFillColor(193,192,192);
$pdf->SetFont('Arial','B',50);
$pdf->Cell(190,20,'HP',1,0);//container

$pdf->Cell(0,5,'',0,1);//dummy
    
$pdf->SetFont('Arial','B',15);
$pdf->Cell(90,8,'',0,0);//dummy 
$pdf->Cell(90,8,'PAYMENT REQUEST FORM',0,0);

$pdf->Cell(0,6,'',0,1);//dummy

$pdf->SetFont('Arial','',15);
$pdf->Cell(22,5,'',0,0);//dummy
$pdf->Cell(45,5,'VENTURES, Inc.',0,0);

$pdf->Cell(0,19,'',0,1);//end of line1

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,5,'COMPANY NAME:',0,0);
$pdf->Cell(155,5,'',0,0);//input comp
$pdf->Line(10, 55, 210-10, 55);

$pdf->Cell(0,10,'',0,1);//end of line2

$pdf->Cell(50,5,'Date Submitted:',1,0);
$pdf->Cell(60,5,'',1,0);//input
$pdf->Cell(40,5,'Date Needed:',1,0);
$pdf->Cell(40,5,'',1,1);//input

$pdf->Cell(50,5,'Requested by:',1,0);
$pdf->Cell(60,5,'',1,0);//input
$pdf->Cell(40,5,'Attention:',1,0);
$pdf->Cell(40,5,'',1,1);//input

$pdf->Cell(50,5,'Title:',1,0);
$pdf->Cell(60,5,'',1,0);//input
$pdf->Cell(40,5,'Department:',1,0);
$pdf->Cell(40,5,'',1,1);//input

$pdf->Cell(0,5,'',0,1);//end of line3



$pdf->Cell(50,5,'DESCRIPTION',1,0,'C',true);
$pdf->Cell(60,5,'INVOICE NO',1,0,'C',true);
$pdf->Cell(40,5,'AMOUNT',1,0,'C',true);
$pdf->Cell(40,5,'DUE DATE',1,0,'C',true);

$pdf->Cell(0,5,'',0,1);//end of line4

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,5,'',1,0);//desc
$pdf->Cell(60,5,'',1,0);//invoice #
$pdf->Cell(40,5,'',1,0);//amt
$pdf->Cell(40,5,'',1,1);//due date

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);


$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'TOTAL:',1,0);
$pdf->Cell(40,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

//end of line5

$pdf->Cell(190,5,'Note:',1,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,'I acknowledge that this funding request, if approved, will be deducted from:',0,1);
$pdf->Cell(50,5,'Petty Cash:',0,0);
$pdf->Cell(60,5,'',0,0);//input
$pdf->Line(60, 149, 210-95, 149);
$pdf->Cell(40,5,'Others:',0,0);
$pdf->Cell(40,5,'',0,1);//input
$pdf->Line(160, 149, 210-10, 149);

$pdf->Cell(50,5,'Prepared by:',0,0);
$pdf->Cell(60,5,'',0,0);//input
$pdf->Line(60, 154, 210-95, 154);
$pdf->Cell(40,5,'Approved by:',0,0);
$pdf->Cell(40,5,'',0,1);//input
$pdf->Line(160, 154, 210-10, 154);

$pdf->Cell(0,10,'',0,1);//end of line6

$pdf->SetFont('Arial','B',10);

$pdf->Cell(190,5,'RM. 204, TULIPS BLDG., A.S FORTUNA ST., MANDAUE CITY, CEBU 6014',0,1,'L',true);






$pdf->Output();
?>