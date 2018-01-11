<?php

$code = base64_decode($_GET['code']);
function  getdata(){
    include '../../dbconnect.php';
    global $code;
    $query = mysqli_query($dbcon, "SELECT * FROM paymentrequests pr  JOIN companies c ON pr.prcomp = c.compno  WHERE pr.prno = '$code'");
    $result = $query->fetch_object();
    if($result->prstatus == "FOR PRINT"){
        $dbcon->query("UPDATE paymentrequests SET prstatus = 'PENDING' WHERE prno = '$code'");
    }
    $query = mysqli_query($dbcon, "SELECT * FROM paymentrequests pr  JOIN companies c ON pr.prcomp = c.compno  WHERE pr.prno = '$code'");
    $data = mysqli_fetch_array($query);
    return $data;
}
require('fpdf.php');
class PDF extends FPDF
{
    function Header()
    {
        global $code;
        $data = getdata();

        $this->SetFillColor(193,192,192);
        $this->Cell(190,25,'',1,0);//container
        $this->Image('images/hpventureslogo.jpg',15,26,40,20);

        $this->Cell(0,5,'',0,1);//dummy

        $this->SetFont('Arial','B',15);
        $this->Cell(90,8,'',0,0);//dummy
        $this->Cell(90,8,'PAYMENT REQUEST FORM',0,0);

        $this->Cell(0,6,'',0,1);//dummy

        $this->Cell(0,19,'',0,1);//end of line1

        $this->SetFont('Arial','',10);
        $this->Cell(35,5,'COMPANY NAME:',0,0);
        $this->Cell(155,5,$data['compname'],0,0);//input company
        $this->Line(10, 60, 210-10, 60);
        $this->Cell(0,10,'',0,1);//end of line2

        $this->Cell(50,5,'Date Submitted:',1,0);
        $this->Cell(60,5,$data['prdatesubmitted'],1,0);//input date submitted
        $this->Cell(40,5,'Date Needed:',1,0);
        $this->Cell(40,5,$data['prdateneeded'],1,1);//input date needed

        $this->Cell(50,5,'Requested by:',1,0);
        $this->Cell(60,5,$data['prrequestedby'],1,0);//input rqsted
        $this->Cell(40,5,'Attention:',1,0);
        $this->Cell(40,5,$data['prattention'],1,1);//input attention

        $this->Cell(50,5,'Title:',1,0);
        $this->Cell(60,5,$data['prtitle'],1,0);//input title
        $this->Cell(40,5,'Department:',1,0);
        $this->Cell(40,5,$data['prdept'],1,1);//input department

        $this->Cell(0,5,'',0,1);//end of line3


    }
    function Footer()
    {
        global $code;
        $data = getdata();

        $this->Cell(190,5,'Note:',1,1);
        $this->SetFont('Arial','',10);
        $this->Cell(190,5,'I acknowledge that this funding request, if approved, will be deducted from:',0,1);
        $this->Cell(50,5,'Petty Cash:',0,0);
        $this->Cell(60,5,'',0,0);//input pettycash
        $this->Line(60, 215, 210-95, 215  );
        $this->Cell(40,5,'Others:',0,0);
        $this->Cell(40,5,'',0,1); //input others
        $this->Line(160, 215, 210-10, 215);

        $this->Cell(50,5,'Prepared by:',0,0);
        $this->Cell(60,5,$data['prpreparedby'],0,0); //input prepared by
        $this->Line(60, 220, 210-95, 220);
        $this->Cell(40,5,'Approved by:',0,0);
        $this->Cell(40,5,'',0,1); //input approved by
        $this->Line(160, 220, 210-10, 220);

        $this->Cell(0,10,'',0,1);//end of line6

        $this->SetFont('Arial','B',10);

        $this->Cell(190,5,'RM. 204, TULIPS BLDG., A.S FORTUNA ST., MANDAUE CITY, CEBU 6014',0,1,'L',true);



    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages('{pages}');
$pdf->SetAutoPageBreak(true,10);
$pdf->SetTopMargin(25);
$pdf->AddPage();
$pdf->SetFillColor(193,192,192);

$pdf->Cell(50,5,'INVOICE NO',1,0,'C',true);
$pdf->Cell(60,5,'DESCRIPTION',1,0,'C',true);
$pdf->Cell(40,5,'AMOUNT',1,0,'C',true);
$pdf->Cell(40,5,'DUE DATE',1,0,'C',true);

$pdf->Cell(0,5,'',0,1);//end of line4
global $code;
$data = getdata();

include '../../dbconnect.php';
$items = mysqli_query($dbcon,"SELECT * FROM paymentrequestsdetails p , paymentrequests b  WHERE p.prno = '$code' && b.prno = '$code' ");
$ctr = 0;
while($ctr <= 20){
    while($dataitem = mysqli_fetch_array($items))
    {
        $cellWidth = 60;
        $cellHeight = 5;
        if($pdf->GetStringWidth($dataitem['prdesc']) < $cellWidth){
            $line = 1;
        }
        else{
            $textLength = strlen($dataitem['prdesc']);
            $errMargin = 10;
            $startChar = 0;
            $maxChar = 0;
            $textArray = array();
            $tmpString = "";

            while($startChar < $textLength) {
                while(
                    $pdf->GetStringWidth($tmpString) < ($cellWidth- $errMargin) &&
                    ($startChar+$maxChar) < $textLength){
                    $maxChar++;
                    $tmpString=substr($dataitem['prdesc'],$startChar,$maxChar);
                }
                $startChar= $startChar+$maxChar;
                array_push($textArray,$tmpString);
                $maxChar =0;
                $tmpString='';
            }
            $line = count($textArray);
            $ctr += $line;
        }

        //PRINT
        $pdf->Cell(50,($line * $cellHeight),$dataitem['prinvoiceno'],'TLR',0,'C');//input invoice #

        $xPos = $pdf-> GetX();
        $yPos = $pdf-> GetY();
        $pdf->MultiCell($cellWidth,$cellHeight,$dataitem['prdesc'],'TLR');


        $tmpHeight = $line * $cellHeight;

        $pdf->SetXY($xPos + $cellWidth, $yPos );

        $pdf->Cell(40,($line * $cellHeight),'Php '.number_format($dataitem['pramount'] , 2, '.', ','),'TLR',0,'C');//input amount
        $pdf->Cell(40,($line * $cellHeight),$dataitem['prduedate'],'TLR',1,'C');//input invoice #
        $ctr++;

    }

    $pdf->Cell(50,5,'',1,0);//desc
    $pdf->Cell(60,5,'',1,0);//invoice #
    $pdf->Cell(40,5,'',1,0);//amt
    $pdf->Cell(40,5,'',1,1);//due date


    $ctr++;

};


$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'TOTAL:',1,0);
$pdf->Cell(40,5,'Php '.number_format($data['prtotal'], 2, '.', ','),'TLR',0,'C');
$pdf->Cell(40,5,'',1,1);

//end of line5



$pdf->Output();
?>