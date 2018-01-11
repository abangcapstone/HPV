<?php

$code = base64_decode($_GET['code']);
function  getdata(){
    include '../../dbconnect.php';
    global $code;
    $query = mysqli_query($dbcon, "SELECT * FROM budgetrequests br  JOIN companies c ON br.brcomp = c.compno  WHERE br.brno = '$code'");
    $result = $query->fetch_object();
    if($result->brstatus == "FOR PRINT"){
    $dbcon->query("UPDATE budgetrequests SET brstatus = 'PENDING' WHERE brno = '$code'");
    }
    $query = mysqli_query($dbcon, "SELECT * FROM budgetrequests br  JOIN companies c ON br.brcomp = c.compno  WHERE br.brno = '$code'");
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
        $this->Image('images/hpventureslogo.jpg',15,19,40,20);

        $this->Cell(0,5,'',0,1);//dummy

        $this->SetFont('Arial','B',15);
        $this->Cell(90,8,'',0,0);//dummy
        $this->Cell(90,8,'BUDGET REQUEST FORM',0,0);

        $this->Cell(0,6,'',0,1);//dummy

        $this->Cell(0,19,'',0,1);//end of line1

        $this->SetFont('Arial','',10);
        $this->Cell(35,5,'COMPANY NAME:',0,0);
        $this->Cell(155,5,$data['compname'],0,0);//input company
        $this->Line(10, 50, 210-10, 50);
        $this->Cell(0,10,'',0,1);//end of line2

        $this->Cell(50,5,'Date Submitted:',1,0);
        $this->Cell(60,5,$data['brdatesubmitted'],1,0);//input date submitted
        $this->Cell(40,5,'Date Needed:',1,0);
        $this->Cell(40,5,$data['brdateneeded'],1,1);//input date needed

        $this->Cell(50,5,'Requested by:',1,0);
        $this->Cell(60,5,$data['brrequestedby'],1,0);//input rqsted
        $this->Cell(40,5,'Attention:',1,0);
        $this->Cell(40,5,$data['brattention'],1,1);//input attention

        $this->Cell(50,5,'Title:',1,0);
        $this->Cell(60,5,$data['brtitle'],1,0);//input title
        $this->Cell(40,5,'Department:',1,0);
        $this->Cell(40,5,$data['brdept'],1,1);//input department

        $this->Cell(0,5,'',0,1);//end of line3

        $this->SetFont('Arial','B',10);
        $this->Cell(50,5,'Quantity',1,0,'C',true);
        $this->Cell(100,5,'Description',1,0,'C',true);
        $this->Cell(40,5,'Amount',1,0,'C',true);


        $this->Cell(0,5,'',0,1);//end of line4



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
        $this->Line(60, 204, 210-95, 204  );
        $this->Cell(40,5,'Others:',0,0);
        $this->Cell(40,5,'',0,1); //input others
        $this->Line(160, 204, 210-10, 204);

        $this->Cell(50,5,'Prepared by:',0,0);
        $this->Cell(60,5,$data['brpreparedby'],0,0); //input prepared by
        $this->Line(60, 209, 210-95, 209);
        $this->Cell(40,5,'Approved by:',0,0);
        $this->Cell(40,5,'',0,1); //input approved by
        $this->Line(160, 209, 210-10, 209);

        $this->Cell(0,10,'',0,1);//end of line6

        $this->SetFont('Arial','B',10);

        $this->Cell(190,5,'RM. 204, TULIPS BLDG., A.S FORTUNA ST., MANDAUE CITY, CEBU 6014',0,1,'L',true);



    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages('{pages}');
$pdf->SetAutoPageBreak(true,10);
$pdf->SetTopMargin(15);
$pdf->AddPage();
$pdf->SetFillColor(193,192,192);

$pdf->SetFont('Arial','',10);

global $code;
$data = getdata();

include '../../dbconnect.php';
$items = mysqli_query($dbcon,"SELECT * FROM budgetrequestsdetails  WHERE brno = '$code' ");
$ctr = 0;
while($ctr <= 20){
    while($dataitem = mysqli_fetch_array($items))
    {
        $cellWidth = 100;
        $cellHeight = 5;
        if($pdf->GetStringWidth($dataitem['brdescription']) < $cellWidth){
            $line = 1;
        }
        else{
            $textLength = strlen($dataitem['brdescription']);
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
                    $tmpString=substr($dataitem['brdescription'],$startChar,$maxChar);
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
        $pdf->Cell(50,($line * $cellHeight),$dataitem['brquantity'],'TLR',0,'C');//input invoice #

        $xPos = $pdf-> GetX();
        $yPos = $pdf-> GetY();
        $pdf->MultiCell($cellWidth,$cellHeight,$dataitem['brdescription'],'TLR');


        $tmpHeight = $line * $cellHeight;

        $pdf->SetXY($xPos + $cellWidth, $yPos );

        $pdf->Cell(40,($line * $cellHeight),'Php '.number_format($dataitem['bramount'] , 2, '.', ','),'TLR',1,'C');//input amount

        $ctr++;
    }

    $pdf->Cell(50,5,'',1,0);//Quantity
    $pdf->Cell(100,5,'',1,0);//Description
    $pdf->Cell(40,5,'',1,1);//Amount

    $ctr++;

};

$pdf->Cell(50,5,'',1,0);
$pdf->Cell(60,5,'',1,0);
$pdf->Cell(40,5,'Total:',1,0);
$pdf->Cell(40,5,'Php '.number_format($data['brtotal'] , 2, '.', ','),'TLR',1,'C');//input amount

//end of line5

//ob_end_clean();

$pdf->Output();
?>