<?php
//require('fpdf.php');
class FromBuilder extends FPDF
{
function Leftcol($a,$b=35,$c=10){
$this->SetFont('Arial','B',12);
$this->SetTextColor(0,0,0);
$this->SetFillColor(255,255,255);
$this->Cell($b,$c,$a.":",1,1,'R',1);
}
}
?>
