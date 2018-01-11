<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->SetTopMargin(20);
$pdf->AddPage();
$pdf->SetFont('Arial','B',50);
$pdf->Cell(190,20,'HP',1,0);//container

$pdf->Cell(0,5,'',0,1);//dummy
    
$pdf->SetFont('Arial','B',15);
$pdf->Cell(140,8,'',0,0);//dummy 
$pdf->Cell(50,8,'CHECK VOUCHER',0,0);

$pdf->Cell(0,6,'',1,1);//dummy

$pdf->SetFont('Arial','',15);
$pdf->Cell(22,5,'',0,0);//dummy
$pdf->Cell(45,5,'VENTURES, Inc.',0,0);

$pdf->Cell(0,9,'',0,1);//end of line1


$pdf->SetFont('Arial','',10);
$pdf->Cell(190,25,'',1,0);//container
$pdf->Cell(0,2,'',0,1);//dummy
$pdf->Cell(25,5,'CHARGE TO:',0,0);
$pdf->Cell(110,5,'',0,0);//input
$pdf->Cell(15,5,'NO.:',0,0);
$pdf->Cell(45,5,'',0,0);//input
$pdf->Cell(0,10,'',0,1);//dummy
$pdf->Cell(25,5,'PAY TO:',0,0);
$pdf->Cell(110,5,'',0,0);//input
$pdf->Cell(15,5,'DATE.:',0,0);
$pdf->Cell(45,5,'',0,0);//input
$pdf->Cell(0,7,'',0,1);//dummy
$pdf->Cell(25,5,'ADDRESS:',0,0);
$pdf->Cell(0,5,'',0,0);//input

$pdf->Cell(0,6,'',0,1);//end of line2

$pdf->SetFont('Arial','B',10);

$pdf->Cell(35,5,'INVOICE NO.',1,0,'C');
$pdf->Cell(120,5,'DESCRIPTION/PARTICULAR',1,0,'C');
$pdf->Cell(35,5,'AMOUNT',1,1,'C');


$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,'','LR',0);//input invoice #
$pdf->Cell(120,5,'','LR',0);//input desc
$pdf->Cell(35,5,'','LR',1);//input amount

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);

$pdf->Cell(35,5,'','LR',0);
$pdf->Cell(120,5,'','LR',0);
$pdf->Cell(35,5,'','LR',1);




$pdf->Cell(0,0,'',0,1); //end of line 4

$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(35,5,'',1,0);
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(40,5,'',0,0);//push dummy
$pdf->Cell(60,5,'PREPARED BY:',0,0);
$pdf->Cell(60,5,'APPROVED BY:',0,0);
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(155,5,'',0,0);//push dummy
$pdf->Cell(35,5,'RECEIVED BY:',1,0);

$pdf->Cell(0,5,'',1,1); //end of line 5


$pdf->SetFont('Arial','',10);
$pdf->Cell(190,30,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(35,30,'CHECK #','R',0);
$pdf->Cell(0,5,'',0,1);//dummy
$pdf->Cell(40,5,'',0,0);//push dummy
$pdf->Cell(55,5,'',0,0);//input prepared by
$pdf->Cell(60,5,'OLIVIA A. POBLADOR',0,0);
$pdf->Cell(35,5,'',0,0);//input received by
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(105,0,'',0,0);//push dummy
$pdf->Cell(85,20,'NOTED BY:',0,0);
$pdf->Cell(0,20,'',0,1);//dummy
$pdf->Cell(95,0,'',0,0);//push dummy
$pdf->Cell(85,5,'HENRY C. POBLADOR',0,0);



    












$pdf->Output();
?>