<?php

// Connect to server and select databse.
$root = $_SERVER['DOCUMENT_ROOT'];
$config = parse_ini_file($root.'/private/config.ini'); 
$con=mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);
include($root."/fpdf181/fpdf.php");
require($root.'/FormBuilder.php');

//init
$height = 10;
$leftsize = 35;
//Create new pdf file
$pdf=new FromBuilder('P','mm','Letter');
//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();
//set initial y axis position per page
$y_axis_initial = 10;

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;

//header
$logo=$root.'\logo_viarail.png';
$title="Application For Right-of-Way Enchroachement";
$pdf->customheader($logo,$title);
$pdf->Cell(35,$height,'Application Date:');
$pdf->SetFont('Times');
$pdf->Cell(70,$height,date('l jS \of F Y'));
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,$height,'Application Number:');
$pdf->SetFont('Times');
$pdf->Cell(60,$height,'VIA0001384947');
$pdf->Ln();
//end of header
//project owner info
$pdf->h1('Section 1: Project Owner Information');
$pdf->h2('Project Owner/Legal Company Identification (Required)');
$sql="SELECT c.*,a.city,a.postalcode,a.line1,a.line2,b.name as province1,d.name as bustype FROM RailRequest.company as c
LEFT JOIN RailRequest.address as a
ON c.address = a.id
LEFT JOIN RailRequest.province as b
ON a.province = b.id
LEFT JOIN business_type as d
ON c.type = d.id";
$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
	$pdf->Leftcol('Owner\'s Complete Legal Company Name');
	$pdf->Textcol($row['name']);
	$pdf->Leftcol("Legal Address (1)");
	$pdf->Textcol($row['line1']);
	$pdf->Leftcol("Legal Address (2)");
	$pdf->Textcol($row['line2']);
	$pdf->Leftcol("City");
	$pdf->Textcol($row['city'],45);
	$pdf->Leftcol("Province",20);
	$pdf->Textcol($row['province1'],30);
	$pdf->Leftcol("Postal Code",30);
	$pdf->Textcol($row['postalcode']);
	$pdf->Leftcol("Business type");
	$pdf->Textcol($row['bustype']);
	}
	//blling info
	$pdf->h2('Billing Address');
	//$sql="SELECT * FROM RailRequest.contact;";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
	$pdf->Leftcol("Billing Address (1)");
	$pdf->Textcol($row['line1']);
	$pdf->Leftcol("Billing Address (2)");
	$pdf->Textcol($row['line2']);
	$pdf->Leftcol("City");
	$pdf->Textcol($row['city'],45);
	$pdf->Leftcol("Province",20);
	$pdf->Textcol($row['province1'],30);
	$pdf->Leftcol("Postal Code",30);
	$pdf->Textcol($row['postalcode']);
	}
	//project owner info
	$pdf->h2('Project Owner Contact Information');
	$sql="SELECT * FROM RailRequest.contact;";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
	$pdf->Leftcol("Contact Name");
	$pdf->Textcol($row['name'],45);
	$pdf->Leftcol("Contact Title");
	$pdf->Textcol($row['title']);
	$pdf->Leftcol("Office Phone");
	$pdf->Textcol($row['office'],45);
	$pdf->Leftcol("Mobile Phone");
	$pdf->Textcol($row['mobile']);
	$pdf->Leftcol("Email");
	$pdf->Textcol($row['email'],45);
	$pdf->Leftcol("Emergency Phone");
	$pdf->Textcol($row['emergency']);
	}
	//project contact infomation
	$pdf->h1('Section 2: Project Contact Information');
	$pdf->h2('Project Engineer/Consultant/Agent Information');
	$sql="SELECT c.*,a.city,a.postalcode,a.line1,a.line2,b.name as province1,d.name as bustype FROM RailRequest.company as c
LEFT JOIN RailRequest.address as a
ON c.address = a.id
LEFT JOIN RailRequest.province as b
ON a.province = b.id
LEFT JOIN business_type as d
ON c.type = d.id";
$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
	$pdf->Leftcol('Owner\'s Complete Legal Company Name');
	$pdf->Textcol($row['name']);
	$pdf->Leftcol("Legal Address (1)");
	$pdf->Textcol($row['line1']);
	$pdf->Leftcol("Legal Address (2)");
	$pdf->Textcol($row['line2']);
	$pdf->Leftcol("City");
	$pdf->Textcol($row['city'],45);
	$pdf->Leftcol("Province",20);
	$pdf->Textcol($row['province1'],30);
	$pdf->Leftcol("Postal Code",30);
	$pdf->Textcol($row['postalcode']);
	}
$sql="SELECT * FROM RailRequest.contact;";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
	$pdf->Leftcol("Contact Name");
	$pdf->Textcol($row['name'],45);
	$pdf->Leftcol("Contact Title");
	$pdf->Textcol($row['title']);
	$pdf->Leftcol("Office Phone");
	$pdf->Textcol($row['office'],45);
	$pdf->Leftcol("Mobile Phone");
	$pdf->Textcol($row['mobile']);
	$pdf->Leftcol("Email");
	$pdf->Textcol($row['email'],45);
	$pdf->Leftcol("Emergency Phone");
	$pdf->Textcol($row['emergency']);
	}
	$pdf->custompagenumber();

	//second page
	$pdf->AddPage();
	$pdf->customheader($logo,$title);
	$pdf->h1('Section 3: Project Information/Location');
	$pdf->h2('Project Reference');

	$pdf->textline('Is the current work connected to an existing agreement, license, or easement between SCRRA, a Member Agency, or a prior Railroad?');
	//TODO: pull from database
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Yes    Provide Agreement # or Title and Date:'.' VIA0001384945',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'No');
	$pdf->box(3);
	//TODO: pull from database
	$pdf->textline('Is this project related to another project or activity involving SCRRA or to which SCRRA is a party?');
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Yes    Describe:'.'');
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'No',1);
	$pdf->box(3);
	//TODO: pull from database
	$pdf->Leftcol("Utility owner project reference number",70);
	$pdf->Textcol('hydroOne 1118274912641204');
	//project scope
	$pdf->h2('Project Scope');
	//TODO: pull from database
	$pdf->textline('Check box to indicate type of entry request:');
	$pdf->textline('General Access:',5,8,1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Bridge Inspection (if checked, must include DOT Bridge Numbers)',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Field Review of Proposed Improvements',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Utility Location',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Monitoring (Vibration, Structural, etc)',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Construction Job Walk',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Surveying',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Film Shooting',1);
//
	$pdf->textline('Fiber Optic, Petroleum or Gas Pipeline Access or Investigation:',5,8,1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Annual Maintenance Permit',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Relocation of Existing Utility',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Protection of Existing Utility',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Potholing of Existing Utilities',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Other',1);
//
	$pdf->textline('Environmental Investigation:',5,8,1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Groundwater Sampling',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Sediment Sampling',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Soil Sampling',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Remediation',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Monitoring Wells',1);
	$pdf->textline('If state or Federal Site, provide Site #:');
//
	$pdf->textline('Construction of New Pipeline or Underground Conduit (See Section 4)',5,8,1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Construct Storm Drain or Sanitary Sewer',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Construct Petroleum or Gas Pipeline',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Construct New Fiber Optic Facilities',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Construct New Undergound Power Line',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Construct Underground Cable not Otherwise Described Above',1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Other Pipeline or Underground Conduit',1);
//
	$pdf->textline('Railroad Operations:',5,8,1);
	$pdf->textline('How close will the proposed activity be to the nearest railroad track:');
	$pdf->textline('Will the proposed activity require crossing railroad track(s):');
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Yes'.'  Describe:',0);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'No',1);
	$pdf->box(34);
	$pdf->custompagenumber();

	//page3:
	$pdf->AddPage();
	$pdf->customheader($logo,$title);
	$pdf->h1('Section 3: Project Information/Location');
	$pdf->h2('Project Description');
	$pdf->textline('Description / Scope (Include: purpose, scope of work, materials, equipment, geographic features, special conditions):');
	$pdf->box(1);
	//TODO: some text handling here:
	for ($i=0;$i<=35;$i++){
	$pdf->Ln();
	}
	$pdf->box(36);	
	//
	$pdf->h2('Project Location');
$sql="SELECT * FROM RailRequest.contact;";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
	$pdf->Leftcol("City",20);
	$pdf->Textcol($row['name'],45);
	$pdf->Leftcol("County",20);
	$pdf->Textcol($row['title'],45);
	$pdf->Leftcol("State",20);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Street Address (if applicable)");
	$pdf->Textcol($row['mobile']);
	$pdf->Leftcol("Subdivison:");
	$pdf->Textcol($row['email'],45);
	$pdf->Leftcol("Mile Post");
	$pdf->Textcol($row['emergency']);
	}
	$pdf->custompagenumber();	
	//page4:
	$pdf->AddPage();
	$pdf->customheader($logo,$title);
	$pdf->h1('Section 4: Underground Structure Information');
	//TODO: Pull From DB
	$pdf->Leftcol("Carrier Pipe",50,5);
	$pdf->Textcol($row['office'],1,5);
	$pdf->Leftcol("Non-Flammable Substance",50,5);
	$pdf->Textcol($row['office'],1,5);
	$pdf->Leftcol("Flammable Substance",50,5);
	$pdf->Textcol($row['office'],1,5);
	//TODO: Pull From DB
	$pdf->Leftcol("Nearest Cross Streets",50);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Angle of Crossing with Track",50);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Pipe Slope or Gradient",50);
	$pdf->Textcol($row['office']);
	$pdf->h2('Measurement');
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Metric (mm)');
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Imperial (inch)',1);
	$pdf->box(2);
	$pdf->Leftcol('',85.9,5);
	$pdf->Leftcol("Carrier Pipe",55,5);
	$pdf->Leftcol('Casing Pipe',55,5);
	$pdf->Ln();
	//TODO: pull from DB
	$pdf->Leftcol("Content to be Handled",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Nominal Diameter",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Pipe Material",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Specifications and Grade",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Wall Thickness",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Operating Pressure/Maximum Pressure",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Minimum Yield Strength",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Type Joints",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Coating Material",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Length of Casing",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Longitudinal Distance from Centerline of Track",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Distance from Centerline of Track",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Base of Rail to Top of Casing",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Roadway Ditches",85.9);
	$pdf->Textcol($row['office'],55);
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Vents");
	$pdf->Textcol($row['office'],55);
	$pdf->Leftcol("Depth");
	$pdf->Textcol($row['office']);
	$pdf->textline('Method of Installation:',5,8,1);
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Dry Bore');
	$pdf->checkbox($pdf->GetX(),$pdf->GetY(),'Directional Bore',1);
	$pdf->box(3);
	$pdf->custompagenumber();
	
	//page4:
	$pdf->AddPage();
	$pdf->customheader($logo,$title);
	$pdf->h1('Section 4: Underground Structure Information');
	$pdf->h2('Insulator Supports');
	$pdf->Leftcol("Type");
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Size");
	$pdf->Textcol($row['office']);
	$pdf->Leftcol("Spacing");
	$pdf->Textcol($row['office']);
//echo"$user--->$passcode----->$hashed[1]";
	$pdf->Output();


?>