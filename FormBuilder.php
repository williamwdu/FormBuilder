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
$this->Cell($tmp,$c,$a,1,1,'L',1);
}
else{
$this->Cell($b,$c,$a,1,0,'L',1);
}
}

function h1($a,$b=10,$c=12){
$this->SetFont('Arial','B',$c);
$this->SetTextColor(255,255,255);
$this->SetFillColor(255,203,6);
$this->Cell(195.9,$b,$a,1,1,'C',1); //letter size 215.9-20
}

function h2($a,$b=5,$c=11){
$this->SetFont('Arial','B',$c);
$this->SetTextColor(0,0,0);
$this->SetFillColor(230,230,230);
$this->Cell(195.9,$b,$a,1,1,'C',1); //letter size 215.9-20
}

function custompagenumber($a=25){
    // 15mm margin both side
    $this->SetY($a);
	$this->SetX(-$a);
	$this->SetFont('Times');
	$this->SetFontSize(10);
	$this->AliasNbPages();
    $this->Cell(0,0,'Page '.$this->PageNo().' of '.'{nb}',0,0,'L');
}

function customheader($logo,$title,$y_axis_initial=10){
	$this->SetFont('Arial','B',12);
	$this->SetY($y_axis_initial);
	$this->Image($logo,10,10,-100);
	$this->SetX(95);
	$this->Cell(50,10,$title,0,1,'C');
	$this->Line(10,30,205.9,30);
	$this->Ln();
}
}
?>
