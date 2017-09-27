<?php
//require('fpdf.php');
class FromBuilder extends FPDF
{
function Leftcol($a,$b=35,$c=10){
$this->SetFont('Arial','B',12);
$this->SetTextColor(0,0,0);
$this->SetFillColor(255,255,255);
$this->Cell($b,$c,$a.":",1,0,'R',1);
}

function Textcol($a,$b=1,$c=10){
$this->SetFont('Times');
$this->SetTextColor(0,0,0);
$this->SetFillColor(255,255,255);
if($b==1){
$x = $this->GetX();
$tmp = 215.9 - $x - 10; //letter size, 10 mm margin
$this->Cell($tmp,$c,$a,1,0,'L',1);
}
else{
$this->Cell($b,$c,$a,1,0,'L',1);
}
}
}
?>
