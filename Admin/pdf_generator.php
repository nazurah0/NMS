<?php
include('../db_connect.php');
require('../fpdf184/fpdf.php');

$id=$_GET['id'];

$qry = $conn->query("SELECT * from 
fee f 
 LEFT OUTER JOIN payment m ON (m.fee_id = f.fee_id)
JOIN child c ON c.child_id = f.child_id  
JOIN parent p ON p.parent_id = c.parent_id  
where f.fee_id= $id " );
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}

$pagesize = array(210, 240);
$pdf = new FPDF('P','mm',$pagesize);

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )



$pdf->Image('../image/logo1.png',10,6,50);
$pdf->Ln(30);
$pdf->Cell(120	,7,'TASKA UMMI SAKIZA',0,0);
$pdf->Cell(35	,7,'INVOICE #',0,0);
$pdf->Cell(34	,5, $invoice_no ,0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(120	,5,'',0,0);
$pdf->Cell(35	,5,'',0,0);
$pdf->Cell(34	,5, '',0,1);//end of line

$pdf->Cell(120	,5,'No.49 Jalan Stulang Baru',0,0);
$pdf->Cell(35	,5,'Invoice Date',0,0);
$pdf->Cell(34	,5,$fee_date,0,1);//end of line

$pdf->Cell(120	,5,'81100 Johor Bahru Johor',0,0);
$pdf->Cell(35	,5,'Payment Method',0,0);
$pdf->Cell(34	,5,isset($payment_id)? $payment_type : '-',0,1);//end of line

$pdf->Cell(120	,5,'umianas@gmail.com',0,0);
$pdf->Cell(35	,5,'Payment Status',0,0);
$pdf->Cell(34	,5,$fee_status,0,1);//end of line

$pdf->Cell(120	,5,'013-747 9174',0,0);
$pdf->Cell(35	,5,'Amount Paid',0,0);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(34	,5, isset($payment_id)? "RM ".number_format($payment_amount,2): '-' ,0,1);//end of line


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

$pdf->SetFont('Arial','',12);

//billing address
$pdf->Cell(100	,5,'Bill to:',0,1);//end of line

//add dummy cell at beginning of each line for indentation

$pdf->Cell(90	,5, $father_name!=NULL ||$father_name!=""? $father_name: $mother_name,0,1);


$pdf->Cell(90	,5,$father_phoneNum!=NULL ||$father_phoneNum!=""? $father_phoneNum: $mother_phoneNum,0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(25	,6,'No.',1,0);

$pdf->Cell(130	,6,'Description',1,0);
$pdf->Cell(34	,6,'Amount',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(25	,6,'1.',1,0);

$pdf->Cell(130	,6,$fee_desc,1,0);
$pdf->Cell(34	,6,number_format($fee_amount,2),1,1,'R');//end of line



//summary
$pdf->Cell(130	,6,'',0,0);
$pdf->Cell(25	,6,'Total:',0,0);
$pdf->Cell(10	,6,'RM',1,0);
$pdf->Cell(24	,6,number_format($fee_amount,2),1,1,'R');//end of line



$pdf->Output('', "Invoice - $child_nickname.pdf");

?>