<?php
//require('fpdf.php');
class FromBuilder extends FPDF
{
function box($a,$b=5){
//use this function after all text created to avoid overlap
$x = $this->GetX();
$y = $this->GetY();
$this->Rect($x,$y-$a*$b,195.9,$a*$b); //letter size
}

function checkbox($x,$y,$item,$checked=0,$a=5){
$this->Rect($x,$y,$a,$a);
$this->SetFont('Times');
$this->setFontSize(9);
$this->SetTextColor(0,0,0);
$this->SetFillColor(255,255,255);
if($checked==0){
$tmp = 215.9 - $x - 15; //letter size, 10 mm margin
$this->setX(10+$a+1);
$this->Cell($tmp,$a,$item,0,1,'L',1);
}
else{
$this->SetFont('Arial','B',10);
$this->Cell(5,5,'X',1,0,'L',1);
$tmp = 215.9 - $x - 15; //letter size, 10 mm margin
$this->setX(10+$a+1);
$this->SetFont('Times');
$this->setFontSize(9);
$this->Cell($tmp,$a,$item,0,1,'L',1);
}
}

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

function textline($a,$b=5,$c=8){
$this->SetFont('Times');
$this->setFontSize(9);
$this->SetTextColor(0,0,0);
$this->SetFillColor(255,255,255);
if(strlen($a)>136){
	$this->MultiCell(195.9,$b,$a,0,1,'L',1);
}
else{
	$this->Cell(195.9,$b,$a,0,1,'L',1); //letter size 215.9-20
}
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
