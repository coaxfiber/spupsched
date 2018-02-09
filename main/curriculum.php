<?php
session_start();
require('fpdf/fpdf.php');


$pdf = new FPDF('P','mm',array(330.2,215.9));
$pdf->AddPage('P');
$pdf->AddFont('Times','','times.php');
$pdf->Setfont('Times','',12);

$image1 = 'fpdf/spuplogo.png';
$pdf->Image($image1, 55, 19, 20,20);


$pdf->Setfont('Times','B',16);
$pdf -> SetY(19);
$pdf -> SetX(75);
$pdf->Cell(0,20,'St. Paul University Philippines');

$pdf->Setfont('Times','',12);
$pdf -> SetY(25);
$pdf -> SetX(80);
$pdf->Cell(0,20,'Tuguegarao City, Cagayan 3500');


$pdf->Setfont('Times','B',12);
$pdf -> SetY(37);
$pdf -> SetX(72);
$pdf->Cell(0,20,'OFFICE OF THE GRADUATE SCHOOL');

$pdf->Text(110-$pdf->GetStringWidth("ENRICHED GRADUATE SCHOOL CURRICULUM")/2,57,"ENRICHED GRADUATE SCHOOL CURRICULUM");

	include_once '../config/database.php';
	include_once '../objects/programs.php';
	include_once '../objects/subjects.php';
	$database = new Database();
	$db = $database->getConnection();
	$arr= new Programs($db);
	$stmt = $arr->getprog($_GET['q']);
	$row = $stmt->fetch();

	$text=strtoupper($row['program']." (".$row['short'].") CURRICULUM");
	$pdf->Text(110-$pdf->GetStringWidth($text)/2,62,$text);


	$text="Specialization: ".$row['specialization'];
	$pdf->Text(110-$pdf->GetStringWidth($text)/2,67,$text);

	$text="Effective SY 2016-2017";
	$pdf->Text(110-$pdf->GetStringWidth($text)/2,72,$text);

	$text="(CHED CMO No. 7 s. 2010)";
	$pdf->Text(110-$pdf->GetStringWidth($text)/2,77,$text);

	$pdf -> SetY(85);
	$pdf -> SetX(10);
		
		$pdf->Cell(35,8,"COURSE CODE",1,'LR','C');
		$pdf->Cell(85,8,"COURSE TITLE",1,'LR','C');
		$pdf->Cell(25,8,"UNITS",1,'LR','C');
		$pdf->Cell(54,8,"REMARKS",1,'LR','C');
		$pdf ->ln();
		$arr2= new Subjects($db);

		$stmt2 = $arr2->getsub(0,'Institutional Courses');
		$num=0;
		while($getunit = $stmt2->fetch()){
				$num+=$getunit['units'];
		}
		$pdf->Cell(120,8,"INSTITUTIONAL COURSE",1,'LR','L');
		$pdf->Cell(25,8,$num." units",1,'LR','C');
		$pdf->Cell(54,8,"",1,'LR','C');
		$pdf ->ln();

		$stmt2 = $arr2->getsub(0,'Institutional Courses');	
		while($row2 = $stmt2->fetch()){
		$pdf->Cell(35,8,$row2['code'],1,'LR','C');
		$pdf->Setfont('Times','B',11);
		$pdf->Cell(85,8,html_entity_decode($row2['title']),1,'LR','L');
		$pdf->Setfont('Times','B',12);
		$pdf->Cell(25,8,$row2['units'],1,'LR','C');

		$pdf->Setfont('Times','B',10);
		$pdf->Cell(54,8,$row2['remarks'],1,'LR','C');
		$pdf->Setfont('Times','B',12);
		$pdf ->ln();
		}
		
		$stmt2 = $arr2->getsubc($row['short'],'Core Courses');
		$num=0;
		while($getunit = $stmt2->fetch()){
				$num+=$getunit['units'];
		}
		$pdf->Cell(120,8,"CORE COURSE",1,'LR','L');
		$pdf->Cell(25,8,$num." units",1,'LR','C');
		$pdf->Cell(54,8,"",1,'LR','C');
		$pdf ->ln();

		$stmt2 = $arr2->getsubc($row['short'],'Core Courses');
		while($row2 = $stmt2->fetch()){
		$pdf->Cell(35,8,$row2['code'],1,'LR','C');
		$pdf->Setfont('Times','B',11);

		$tempFontSize = 12;
		while($pdf->getStringWidth(html_entity_decode($row2['title'])) >85){// loop until the string width is smaller than cell width
        		$pdf->SetFontSize($tempFontSize -= 0.1);
    		}
		$pdf->Cell(85,8,html_entity_decode($row2['title']),1,'LR','L');

		$pdf->Setfont('Times','B',12);
		$pdf->Cell(25,8,$row2['units'],1,'LR','C');

		$pdf->Setfont('Times','B',10);
		$pdf->Cell(54,8,$row2['remarks'],1,'LR','C');
		$pdf->Setfont('Times','B',12);
		$pdf ->ln();
		}

		$stmt2 = $arr2->getsub($_GET['q'],'Major Courses');
		$num=0;
		while($getunit = $stmt2->fetch()){
				$num+=$getunit['units'];
		}
		$pdf->Cell(120,8,"CORE COURSE",1,'LR','L');
		$pdf->Cell(25,8,$num." units",1,'LR','C');
		$pdf->Cell(54,8,"",1,'LR','C');
		$pdf ->ln();

		
		$stmt2 = $arr2->getsub($_GET['q'],'Major Courses');
		while($row2 = $stmt2->fetch()){
		$pdf->Cell(35,8,$row2['code'],1,'LR','C');
		$pdf->Setfont('Times','B',11);
		$tempFontSize = 12;
		while($pdf->getStringWidth(html_entity_decode($row2['title'])) >85){// loop until the string width is smaller than cell width
        		$pdf->SetFontSize($tempFontSize -= 0.1);
    		}
		$pdf->Cell(85,8,html_entity_decode($row2['title']),1,'LR','L');
		$pdf->Setfont('Times','B',12);
		$pdf->Cell(25,8,$row2['units'],1,'LR','C');

		$pdf->Setfont('Times','B',10);
		$pdf->Cell(54,8,$row2['remarks'],1,'LR','C');
		$pdf->Setfont('Times','B',12);
		$pdf ->ln();
		}

		$pdf->Cell(120,8,"COMPREHENSIVE EXAMINATION",1,'LR','L');
		$pdf->Cell(25,8,"",1,'LR','C');
		$pdf->Cell(54,8,"",1,'LR','C');
		$pdf ->ln();

		$stmt2 = $arr2->getsub($_GET['q'],'Independent Projects');
		$num=0;
		while($getunit = $stmt2->fetch()){
				$num+=$getunit['units'];
		}
		$pdf->Cell(120,8,"Independent Projects",1,'LR','L');
		$pdf->Cell(25,8,$num." units",1,'LR','C');
		$pdf->Cell(54,8,"",1,'LR','C');
		$pdf ->ln();

		
		$stmt2 = $arr2->getsub($_GET['q'],'Independent Projects');
		while($row2 = $stmt2->fetch()){
		$pdf->Cell(35,8,$row2['code'],1,'LR','C');
		$pdf->Setfont('Times','B',11);

		$pdf->Cell(85,8,html_entity_decode($row2['title']),1,'LR','L');
		$pdf->Setfont('Times','B',12);
		$tempFontSize = 12;
		while($pdf->getStringWidth(html_entity_decode($row2['title'])) >85){// loop until the string width is smaller than cell width
        		$pdf->SetFontSize($tempFontSize -= 0.1);
    		}
		$pdf->Cell(25,8,$row2['units'],1,'LR','C');

		$pdf->Setfont('Times','B',10);
		$pdf->Cell(54,8,$row2['remarks'],1,'LR','C');
		$pdf->Setfont('Times','B',12);
		$pdf ->ln();
		}

$pdf->Output();

 