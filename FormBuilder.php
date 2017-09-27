<?php
//require('fpdf.php');
class FromBuilder extends FPDF
{
function Leftcol($a,$b=35,$c=10){
$this->SetFont('Arial','B',10);
$this->SetTextColor(0,0,0);
$this->SetFillColor(255,255,255);
$x = $this->GetX();
$y = $this->GetY();

if(strlen($a) < 20){
	$this->Cell($b,$c,"\r\n".$a,1,0,'R',1);
}
else{
$this->SetFont('Arial','B',8);
$this->MultiCell($b,5,$a,1,0,'R',1);
$this->setXY($x+35,$y);
}
}

function Textcol($a,$b=1,$c=10){
$this->SetFont('Times');
$this->SetFontSize(10);
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
