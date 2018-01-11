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
$pdf->Cell(90,8,'BUDGET REQUEST FORM',0,0);

$pdf->Cell(0,6,'',0,1);//dummy

$pdf->SetFont('Arial','',15);
$pdf->Cell(22,5,'',0,0);//dummy
$pdf->Cell(45,5,'VENTURES, Inc.',0,0);

$pdf->Cell(0,19,'',0,1);//end of line1

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,5,'COMPANY NAME:',0,0);
$pdf->Cell(155,5,'',0,0);//input company
$pdf->Line(10, 55, 210-10, 55);


$pdf->Cell(0,10,'',0,1);//end of line2

$pdf->Cell(50,5,'Date Submitted:',1,0);
$pdf->Cell(60,5,'',1,0);//input date submitted
$pdf->Cell(40,5,'Date Needed:',1,0);
$pdf->Cell(40,5,'',1,1);//input date needed

$pdf->Cell(50,5,'Requested by:',1,0);
$pdf->Cell(60,5,'',1,0);//input rqsted
$pdf->Cell(40,5,'Attention:',1,0);
$pdf->Cell(40,5,'',1,1);//input attention

$pdf->Cell(50,5,'Title:',1,0);
$pdf->Cell(60,5,'',1,0);//input title
$pdf->Cell(40,5,'Department:',1,0);
$pdf->Cell(40,5,'',1,1);//input department

$pdf->Cell(0,5,'',0,1);//end of line3



$pdf->Cell(50,5,'Quantity',1,0,'C',true);
$pdf->Cell(100,5,'Description',1,0,'C',true);
$pdf->Cell(40,5,'Amount',1,0,'C',true);


$pdf->Cell(0,5,'',0,1);//end of line4

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,5,'',1,0);//Quantity
$pdf->Cell(100,5,'',1,0);//Description
$pdf->Cell(40,5,'',1,1);//Amount

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(100,5,'',1,0);
$pdf->Cell(40,5,'',1,1);


$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'Total:',1,0);
$pdf->Cell(40,5,'',1,1);//input total

//end of line5

$pdf->Cell(190,5,'Note:',1,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,'I acknowledge that this funding request, if approved, will be deducted from:',0,1);
$pdf->Cell(50,5,'Petty Cash:',0,0);
$pdf->Cell(60,5,'',0,0);//input pettycash
$pdf->Line(60, 154, 210-95, 154);
$pdf->Cell(40,5,'Others:',0,0);
$pdf->Cell(40,5,'',0,1); //input others
$pdf->Line(160, 154, 210-10, 154);

$pdf->Cell(50,5,'Prepared by:',0,0);
$pdf->Cell(60,5,'',0,0); //input prepared by
$pdf->Line(60, 159, 210-95, 159);
$pdf->Cell(40,5,'Approved by:',0,0);
$pdf->Cell(40,5,'',0,1); //input approved by
$pdf->Line(160, 159, 210-10, 159);

$pdf->Cell(0,10,'',0,1);//end of line6

$pdf->SetFont('Arial','B',10);

$pdf->Cell(190,5,'RM. 204, TULIPS BLDG., A.S FORTUNA ST., MANDAUE CITY, CEBU 6014',0,1,'L',true);






$pdf->Output();
?>