
<?php

 $pocode = base64_decode($_GET['code']);
    function  getdata(){
        include '../../dbconnect.php';
        global $pocode;
        $query = mysqli_query($dbcon, "SELECT * FROM purchaseorder,clients,companies,contacts,branches WHERE ponumber = '$pocode' && poclient = clientcode  && pocompany LIKE compno && compno = branchcode ");
        $data = mysqli_fetch_array($query);
        return $data;
    }


require('fpdf.php');

class PDF extends FPDF
{

    function Header()
    {

        global $pocode;
        $data = getdata();
        $this->Image('images/hpventureslogo.jpg',15,18,40,22);
        $this->SetFont('Arial', '', 8);
        $this->Cell(60, 5, '', 0, 0);
        $this->Cell(130, 4, 'Unit 204, 2nd Floor Tulips Center, A.S. Fortuna St., Bakilid, Mandaue City, Cebu', 0, 1);
        //$pdf->Cell(0,1,'',0,1);
        $this->Cell(60, 5, '', 0, 0);
        $this->Cell(130, 5, '(032)343-9651 | (032)343-3897', 0, 1);
        $this->Cell(60, 5, '', 0, 0);
        $this->Cell(130, 5, 'Email: info@infovisionresearch.com', 0, 1);
        $this->Cell(60, 5, '', 0, 0);
        $this->Cell(130, 5, 'Website:www.infovisionresearch.com', 0, 1);

        $this->Cell(0, 2, '', 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(190, 5, 'PURCHASE ORDER', 1, 1, 'C');


        $this->SetFont('Arial', '', 9);
        $this->Cell(25, 5, 'TO:', 1, 0);
        $this->Cell(120, 5, $data['clientname'], 1, 0);//input
        $this->Cell(20, 5, 'P.O. NO    :', 1, 0);
        $this->Cell(25, 5, $pocode, 1, 1);//input

        $this->Cell(25, 5, 'Address:', 1, 0);
        $this->Cell(120, 5, $data['clientaddr'], 1, 0);//input
        $this->Cell(20, 5, 'Date          :', 1, 0);
        $this->Cell(25, 5, $data['podate'], 1, 1);//input

        $this->Cell(25, 5, 'Contact Number:', 1, 0);
        $this->Cell(120, 5, $data['clienttelno'], 1, 0);//input
        $this->Cell(20, 5, 'Terms       :', 1, 0);
        $this->Cell(25, 5, $data['clientterms'], 1, 1);//input

        $this->Cell(25, 5, 'Fax Number:', 1, 0);
        $this->Cell(120, 5, $data['clientfaxno'], 1, 0);//input
        $this->Cell(20, 5, 'Reference :', 1, 0);
        $this->Cell(25, 5, $data['poreference'], 1, 1);//input

        $this->Cell(25, 5, 'Contact Person:', 1, 0);
        $this->Cell(120, 5, $data['poclientcontact'], 1, 0);//input
        $this->Cell(45, 5, '', 'R', 1);

        $this->Cell(145, 5, 'Pls. Deliver the following materials/items not later than', 1, 0);
        $this->Cell(45, 5, $data['podaterqst'], 'R', 1,'C');

        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 5, 'Requesting Entity:', 1, 0);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(120, 5, $data['compname'], 1, 0);//input
        $this->Cell(45, 5, '', 'R', 1);

        $this->SetFont('Arial', '', 9);
        $this->Cell(25, 5, 'Address:', 1, 0);
        $this->Cell(120, 5, $data['branchaddr'], 1, 0);//input
        $this->Cell(20, 5, 'Tel #', 1, 0, 'R');
        $this->Cell(25, 5, $data['branchtelno'], 1, 1);//input

        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(255, 255, 255);

        $this->Cell(190, 105, '', 1, 0);
        $this->Cell(0, 0, '', 0, 1);
        $this->Cell(25, 5, 'ITEM', 1, 0, 'C', true);
        $this->Cell(25, 5, 'QTY', 1, 0, 'C', true);
        $this->Cell(95, 5, 'DESCRIPTION', 1, 0, 'C', true);
        $this->Cell(20, 5, 'UNIT PRICE', 1, 0, 'C', true);
        $this->Cell(25, 5, 'AMOUNT', 1, 1, 'C', true);

    }

    function Footer()
    {

        $data = getdata();
        $this->SetY(-95);
        $this->Cell(0, 5, '', 0, 1);//end

        $this->SetFont('Arial', '', 8);

        $this->Cell(75, 20, '', 1, 0);
        $this->Cell(70, 5, 'TERMS AND CONDITIONS:', 0, 0, 'C');
        $this->Cell(0, 0, '', 0, 1);//dummynl
        $this->Cell(20, 5, 'Special Instruction:', 0, 1);
        $this->Cell(90, 5, '', 0, 0);
        $this->Cell(70, 5, 'For failure of supplier to deliver within the above specified period', 0, 1);
        $this->Cell(90, 5, '', 0, 0);
        $this->Cell(70, 5, 'HP Ventures Inc. reserves the right to cancel any or all items under', 0, 1);
        $this->Cell(90, 5, '', 0, 0);
        $this->Cell(70, 5, 'this purchase Order; or impose penalties for delays', 0, 1);

        $this->Cell(0, 10, '', 0, 1);

        $this->Cell(30, 5, 'Prepared By:', 0, 0, 'R');
        $this->SetFont('', 'U');
        $this->Cell(30, 5, $data['popreparedby'], 0, 1, 'C');//input
        $this->SetFont('Arial', '', 6);
        $this->Cell(55, 3, 'Purchasing Officer', 0, 0, 'R');
        $this->Cell(0, 7, '', 0, 1);

        $this->SetFont('Arial', '', 8);
        $this->Cell(30, 5, 'Approved By:', 0, 0, 'R');
        $this->SetFont('', 'U');
        $this->Cell(30, 5, 'Henry C. Poblador', 0, 0, 'C');//input

        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, 'Confirmed By:', 0, 0, 'R');//input
        $this->Cell(35, 5, '', 0, 1);


        $this->SetFont('Arial', '', 6);
        $this->Cell(45, 3, 'CEO', 0, 0, 'R');
        $this->Cell(85, 5, '', 0, 0);
        $this->Cell(30, 3, 'Vendor', 'T', 1, 'C');

        $this->Cell(0, 4, '', 0, 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(30, 5, 'Checked By:', 0, 0, 'R');
        $this->SetFont('', 'U');
        $this->Cell(30, 5, 'Olivia Poblador', 0, 0, 'C');//input

        $this->SetFont('Arial', '', 6);
        $this->Cell(70, 5, '', 0, 0);
        $this->Cell(30, 5, 'Date', 'T', 1, 'C');//input

        $this->Cell(47, 5, 'Finance', 0, 1, 'R');
        $this->Cell(0,10,'Page ' .$this->PageNo(). "/ {pages}",0,0,'C');


    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages('{pages}');
$pdf->SetAutoPageBreak(true,10);
$pdf->SetTopMargin(20);

$pdf->AddPage();

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);

include '../../dbconnect.php';
$items = mysqli_query($dbcon,"SELECT * FROM podetails  WHERE poitemcode = '$pocode' ");

$ctr = 0;
while($ctr <= 20){
    while($dataitem = mysqli_fetch_array($items))
    {
        $cellWidth = 95;
        $cellHeight = 5;
        if($pdf->GetStringWidth($dataitem['poitemdesc']) < $cellWidth){
            $line = 1;
        }
        else{
            $textLength = strlen($dataitem['poitemdesc']);
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
                    $tmpString=substr($dataitem['poitemdesc'],$startChar,$maxChar);
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
        $pdf->Cell(25,($line * $cellHeight),$dataitem['poitemname'],'TLR',0,'C');
        $pdf->Cell(25,($line * $cellHeight),$dataitem['poitemquantity'],'TLR',0,'C');
        $xPos = $pdf-> GetX();
        $yPos = $pdf-> GetY();
        $pdf->MultiCell($cellWidth,$cellHeight,$dataitem['poitemdesc'],'TLR');


        $tmpHeight = $line * $cellHeight;

        $pdf->SetXY($xPos + $cellWidth, $yPos );

        $pdf->Cell(20,($line * $cellHeight), 'Php '.number_format($dataitem['poitemprice'], 2, '.', ','),'TLR',0,'C');
        $pdf->Cell(25,($line * $cellHeight),'Php '.number_format($dataitem['poitemtotal'], 2, '.', ','),'TLR',1,'C');
        $ctr++;
    }

    $pdf->Cell(25,5,'',1,0,'C');
    $pdf->Cell(25,5,'',1,0,'C');
    $pdf->Cell(95,5,'',1,0,'C');
    $pdf->Cell(20,5,'',1,0,'C');
    $pdf->Cell(25,5,'',1,1,'C');
    $ctr++;

};

$data = getdata();
$pdf->Cell(50,5,'',0,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(115,5,'GRAND TOTAL',1,0,'R');
$pdf->Cell(25,5,'Php '.number_format($data['pototal'], 2, '.', ','),1,1,'C');//input
/*$pdf->AddPage();*/
//ob_end_clean();
$pdf->Output();

?>