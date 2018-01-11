<?php

$code = base64_decode($_GET['code']);
function  getdata(){
    include '../../dbconnect.php';
    global $code;
    $query = mysqli_query($dbcon, "SELECT * FROM vouchers,budgetrequests WHERE voucherno = '$code' 
    && voucheridentifier = brno  ");
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

        $this->Image('images/hpventureslogo.jpg',15,25,40,20);

        $this->Cell(190,20,'',1,0);//container

        $this->Cell(0,5,'',0,1);//dummy

        $this->SetFont('Arial','B',15);
        $this->Cell(140,8,'',0,0);//dummy
        $this->Cell(50,8,'CASH VOUCHER',0,0);

        $this->Cell(0,15,'',1,1);//dummy

        $this->SetFont('Arial','',10);
        $this->Cell(190,25,'',1,0);//container
        $this->Cell(0,2,'',0,1);//dummy
        $this->Cell(25,5,'CHARGE TO:',0,0);
        $this->Cell(110,5,$data['vouchercomp'],0,0);//input
        $this->Cell(15,5,'NO.:',0,0);
        $this->Cell(45,5,$code,0,0);//input
        $this->Cell(0,10,'',0,1);//dummy
        $this->Cell(25,5,'PAY TO:',0,0);
        $this->Cell(110,5,$data['voucherclient'],0,0);//input
        $this->Cell(15,5,'DATE.:',0,0);
        $this->Cell(45,5,$data['voucherdate'],0,0);//input
        $this->Cell(0,7,'',0,1);//dummy
        $this->Cell(25,5,'ADDRESS:',0,0);
        $this->Cell(0,5,$data['voucheraddr'],0,0);//input

        $this->Cell(0,6,'',0,1);//end of line2

        $this->SetFont('Arial','B',10);

        $this->Cell(35,5,'INVOICE NO.',1,0,'C');
        $this->Cell(120,5,'DESCRIPTION/PARTICULAR',1,0,'C');
        $this->Cell(35,5,'AMOUNT',1,1,'C');

    }
    function Footer()
    {
        global $code;
        $data = getdata();


        $this->Cell(0,0,'',0,1); //end of line 4

        $this->SetFont('Arial','B',10);
        $this->Cell(190,5,'',1,0);//container
        $this->Cell(0,0,'',0,1);//dummy
        $this->Cell(35,5,'',1,0);
        $this->Cell(0,0,'',0,1);//dummy
        $this->Cell(40,5,'',0,0);//push dummy
        $this->Cell(60,5,'PREPARED BY:',0,0);
        $this->Cell(60,5,'APPROVED BY:',0,0);
        $this->Cell(0,0,'',0,1);//dummy
        $this->Cell(155,5,'',0,0);//push dummy
        $this->Cell(35,5,'RECEIVED BY:',1,0);

        $this->Cell(0,5,'',1,1); //end of line 5


        $this->SetFont('Arial','',10);
        $this->Cell(190,30,'',1,0);//container
        $this->Cell(0,0,'',0,1);//dummy
        $this->Cell(35,30,'CASH','R',0);
        $this->Cell(0,5,'',0,1);//dummy
        $this->Cell(40,5,'',0,0);//push dummy
        $this->Cell(55,5,$data['voucherpreparedby'],0,0);//input prepared by
        $this->Cell(60,5,'OLIVIA A. POBLADOR',0,0);
        $this->Cell(35,5,'',0,0);//input received by
        $this->Cell(0,0,'',0,1);//dummy
        $this->Cell(105,0,'',0,0);//push dummy
        $this->Cell(85,20,'NOTED BY:',0,0);
        $this->Cell(0,20,'',0,1);//dummy
        $this->Cell(95,0,'',0,0);//push dummy
        $this->Cell(85,5,'HENRY C. POBLADOR',0,1);
        $this->Cell(0,10,'Page ' .$this->PageNo(). "/ {pages}",0,0,'C');

    }

}



$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages('{pages}');
$pdf->SetAutoPageBreak(true,10);
$pdf->SetTopMargin(25);
$pdf->AddPage();


$pdf->SetFont('Arial','',10);

include '../../dbconnect.php';
$items = mysqli_query($dbcon,"SELECT * FROM voucherdetails  WHERE voucherno = '$code' ");
$ctr = 0;
while($ctr <= 30){
    while($dataitem = mysqli_fetch_array($items))
    {
        $cellWidth = 120;
        $cellHeight = 5;
        if($pdf->GetStringWidth($dataitem['voucherdesc']) < $cellWidth){
            $line = 1;
        }
        else{
        $textLength = strlen($dataitem['voucherdesc']);
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
                $tmpString=substr($dataitem['voucherdesc'],$startChar,$maxChar);
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
        $pdf->Cell(35,($line * $cellHeight),$dataitem['voucherinvoiceno'],'TLR',0,'C');//input invoice #

        $xPos = $pdf-> GetX();
        $yPos = $pdf-> GetY();
        $pdf->MultiCell($cellWidth,$cellHeight,$dataitem['voucherdesc'],'TLR');


       $tmpHeight = $line * $cellHeight;

        $pdf->SetXY($xPos + $cellWidth, $yPos );

        $pdf->Cell(35,($line * $cellHeight),'Php '.number_format($dataitem['voucheramount'] , 2, '.', ','),'TLR',1,'C');//input amount

        $ctr++;
    }

        $pdf->Cell(35,5,'','1',0,'C');//input invoice #
        $pdf->Cell(120,5,'','1',0,'C');//input desc
        $pdf->Cell(35,5,'','1',1,'C');//input amount
        $ctr++;

};


//ob_end_clean();
$pdf->Output();
?>