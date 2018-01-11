<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->SetTopMargin(40);
$pdf->AddPage();

$pdf->Image('images/infotradelogo.jpg',10,10,-300);

$pdf->SetFont('Arial','',8);
$pdf->Cell(190,3,'Corporate Address: Room 407, 4th floor, Tulip Center, A.S. Fortuna Street, Barangay Bakilid, Mandaue City',0,1);
$pdf->Cell(190,2,'',0,1);//dummy
$pdf->Cell(190,3,'Plant Site Address: Sitio Kamanggahan, Barangay Labogon, Mandaue City',0,1);
$pdf->Cell(190,2,'',0,1);//dummy
$pdf->Cell(190,3,'Tel No. 032-3439651 | Fax No. 032-3433897',0,1);

$pdf->Cell(190,3,'',0,1);//end 

$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'PURCHASE ORDER',1,1,'C');
//end

$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,7,'',1,0);
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(95,7,'',1,0);//push
$pdf->Cell(25,7,'',1,0);//push
$pdf->Cell(35,7,'P.O. No',1,0);
$pdf->Cell(35,7,'TEST-IT12318',1,1);

//end
$pdf->SetFont('Arial','',9);
$pdf->Cell(95,14,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(27,5,'Supplier Name:',0,0);
$pdf->Cell(68,5,'VISAYAN DISTRIBUTOR TEST ',0,0);
$pdf->Cell(25,14,'',0,0);
$pdf->Cell(35,14,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(120,0,'',0,0);//push
$pdf->Cell(35,5,'Date',0,0);
$pdf->Cell(35,14,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(155,0,'',0,0);//push
$pdf->Cell(35,5,'TEST DATE',0,1);


$pdf->Cell(0,9,'',0,1);//end

$pdf->Cell(95,7,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(27,5,'Contact No:',0,0);
$pdf->Cell(68,5,'TEST CONTACT',0,0);
$pdf->Cell(25,7,'',0,0);
$pdf->Cell(35,7,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(120,0,'',0,0);//push
$pdf->Cell(35,5,'Term',0,0);
$pdf->Cell(35,7,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(155,0,'',0,0);//push
$pdf->Cell(35,5,'CASH',0,1);

$pdf->Cell(0,2,'',0,1);//end

$pdf->Cell(95,7,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(27,5,'Fax No:',0,0);
$pdf->Cell(68,5,'',0,0);
$pdf->Cell(25,7,'',0,0);
$pdf->Cell(35,7,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(120,0,'',0,0);//push
$pdf->Cell(35,5,'Reference',0,0);
$pdf->Cell(35,7,'',1,0);//container
$pdf->Cell(0,0,'',0,1);//dummy
$pdf->Cell(155,0,'',0,0);//push
$pdf->Cell(35,5,'',0,1);

$pdf->Cell(0,2,'',0,1);//end


$pdf->Cell(27,8,'Contact Person:','TL',0);
$pdf->Cell(68,5,'','TR',0);//input
$pdf->Cell(25,8,'','LR',0);
$pdf->Cell(70,8,'','LR',1);

$pdf->Cell(65,12,'Please Deliver this item/items on this Date:','LB',0);
$pdf->Cell(30,12,'','B',0);//input
$pdf->Cell(25,12,'','B',0);
$pdf->Cell(70,12,'','RB',1);


$pdf->SetFont('Arial','B',10);
$pdf->Cell(85,7,'PURCHASE ORDER',1,0,'C');
$pdf->Cell(23,7,'QUANTITY',1,0,'C');
$pdf->Cell(22,7,'UOM',1,0,'C');
$pdf->Cell(30,7,'UNIT PRICE',1,0,'C');
$pdf->Cell(30,7,'AMOUNT',1,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(85,7,'INPUT',1,0,'C');
$pdf->Cell(23,7,'INPUT',1,0,'C');
$pdf->Cell(22,7,'INPUT',1,0,'C');
$pdf->Cell(30,7,'INPUT',1,0,'C');
$pdf->Cell(30,7,'INPUT',1,1,'C');

$pdf->Cell(190,50,'',1,0);//container
$pdf->Cell(0,0,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(140,7,'TERMS AND CONDITION','L',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,7,'TOTAL:',0,0);
$pdf->Cell(30,7,'','R',0);
$pdf->Line(170, 137, 210-15, 137);

$pdf->Cell(0,7,'',0,1);//end

$pdf->SetFont('Arial','',9);
$pdf->Cell(130,5,'For failure of supplier to deliver within the above specified','L',0);
$pdf->Cell(30,5,'Requested By:',0,0);
$pdf->Cell(30,5,'','R',1);
$pdf->Line(170, 143, 210-15, 143);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,5,'INFOTRADE RESOURCES','L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(150,5,'reserves the right to cancel any or all items under','R',1);
$pdf->Cell(190,5,'this Purchase Order or impose penalties for delays','LR',1);
$pdf->Cell(20,5,'Prepared by:','L',0);
$pdf->Cell(170,5,'','R',0);
$pdf->Line(30, 158, 210-140, 158);

$pdf->Cell(0,15,'',0,1);

$pdf->Cell(28,5,'Terms/Conditions:',0,0);
$pdf->Cell(97,5,'',0,0);
$pdf->Line(38, 175, 210-120, 175);

$pdf->Cell(30,5,'Approved by:',0,0);
$pdf->Cell(35,5,'',0,1);
$pdf->Line(155, 175, 210-15, 175);

$pdf->Cell(0,2,'',0,1);

$pdf->Cell(110,5,'Suppliers Authorized Representative',0,1,'C');













$pdf->Output();
?>