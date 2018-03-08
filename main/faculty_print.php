<?php

require('fpdf/fpdf.php');





$pdf = new FPDF('P','mm',array(330.2,215.9));

include_once '../config/database.php';
	  include_once '../objects/schedule.php';
	  include_once '../objects/options.php';
	  include_once '../objects/faculty.php';
	$database = new Database();
	$db = $database->getConnection();
	$arr= new Options($db);
	$stmt = $arr->readschoolyear();
	$row = $stmt->fetch();

	$arr2= new Options($db);
	$stmt2 = $arr2->readsemester();
	$row2 = $stmt2->fetch();
	$sy = $row['value'];
	$t = $row2['value'] ;
$pdf->AddFont('Times','','times.php');
$pdf->AddFont('Old','','old.php');
$pdf->AddFont('Helvetica','','helvetica.php');

$page=0;


$pdf->AddPage('P');
$pdf->Setfont('Times','',12);


$image1 = 'fpdf/spuplogo.png';
$pdf->Image($image1, 55, 19, 15,15);

$pdf->Setfont('Old','',15);
$pdf -> SetY(19);
$pdf -> SetX(75);
$pdf->Text(108-$pdf->GetStringWidth("St. Paul University Philippines")/2,27,"St. Paul University Philippines");

$pdf->Setfont('Times','',12);
$pdf->Text(108-$pdf->GetStringWidth("Tuguegarao City, Cagayan 3500")/2,32,"Tuguegarao City, Cagayan 3500");
 

$pdf->Setfont('Helvetica','',12);

$pdf -> SetY(35);
$pdf -> SetX(24);
$pdf->Cell(0,20, date("F d, Y", strtotime($_POST["date"])));


$pdf->Setfont('Helvetica','B',12);
$pdf -> SetY(52);
$pdf -> SetX(24);
$pdf->Cell(0,20, strtoupper($_POST["name"]));

$pdf->Setfont('Helvetica','',12);
$pdf -> SetY(57);
$pdf -> SetX(24);
$pdf->Cell(0,20, "Faculty, Graduate School");
$pdf->Setfont('Helvetica','',12);
$pdf -> SetY(62);
$pdf -> SetX(24);
$pdf->Cell(0,20, "St. Paul University Philippines");

$pdf -> SetY(72);
$pdf -> SetX(24);
$pdf->Cell(0,20, "Dear ". $_POST["ext"] . " " . $_POST["fname"]);

$pdf -> SetY(82);
$pdf -> SetX(24);
$pdf->Cell(0,20, "Greetings of Peace!");

$pdf -> SetY(92);
$pdf -> SetX(24);
$pdf->Cell(0,20, "Please be informed of your teaching load/s in the Graduate School for ". $t.",");

$pdf -> SetY(97);
$pdf -> SetX(24);
$pdf->Cell(0,20, "Acadamic Year ". $sy.".");
$x = 113;

				$pdf -> SetY($x);
				$pdf -> SetX(25);
				$pdf->Setfont('Helvetica','B',12);
						$pdf->Cell(25,6,"CODE",1,'LR','C');
						$pdf->Cell(48,6,"COURSE TITLE",1,'LR','C');
						$pdf->Cell(15,6,"UNITS",1,'LR','C');
						$pdf->Cell(38,6,"SCHEDULE",1,'LR','C');
						$pdf->Cell(20,6,"TIME",1,'LR','C');
						$pdf->Cell(20,6,"ROOM",1,'LR','C');

			  $schedude= new Scheduling($db);
				$stmt = $schedude->readfac($sy,$t, $_POST['name']);
    			$temp=0;	
               	$x=$x+6;
    			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               	extract($row);
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(25);
						$pdf->Setfont('Helvetica','',12);
						$append = $code;if($merge!=''){$append = $append. " / ".$merge;}

						$pdf->MultiCell( 25, 6, $append, 0,'L',false);

	    				$pdf -> SetY($x);
	    				$pdf -> SetX(25);
						$pdf->Cell(25,23,"",1,'LR','C');


	    				$pdf -> SetY($x);
	    				$pdf -> SetX(50);
						$pdf->MultiCell(48,6,html_entity_decode($title),0,'L',false);
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(50);
						$pdf->Cell(48,23,"",1,'LR','C');

	    				$pdf -> SetY($x);
	    				$pdf -> SetX(98);
						$pdf->MultiCell(15,6,$units,0,'C',false);
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(98);
						$pdf->Cell(15,23,"",1,'LR','C');

	    				$pdf -> SetY($x);
	    				$pdf -> SetX(113);
						$pdf->MultiCell(38,6,$sched,0,'L',false);
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(113);
						$pdf->Cell(38,23,"",1,'LR','C');

	    				$pdf -> SetY($x);
	    				$pdf -> SetX(151);
						$pdf->MultiCell(20,6,$time,0,'L',false);
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(151);
						$pdf->Cell(20,23,"",1,'LR','C');

	    				$pdf -> SetY($x);
	    				$pdf -> SetX(171);
						$pdf->MultiCell(20,6,$room,0,'L',false);
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(171);
						$pdf->Cell(20,23,"",1,'LR','C');

	               	$x=$x+23;

    			}

	    				$pdf -> SetY($x);
	    				$pdf -> SetX(24);
	    				$pdf->Cell(0,20, "Please meet your students in the given schedule. Thank you.");
	    				
	    				$x=$x+10;
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(24);
	    				$pdf->Cell(0,20, "Truly yours,");

					$arr3= new Options($db);
					$stmt3 = $arr3->readdean();
					$row3 = $stmt3->fetch();
					$dean = $row3['value'];

	    				$x=$x+23;
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(24);
						$pdf->Setfont('Helvetica','B',12);
	    				$pdf->Cell(0,20, strtoupper($dean));
	    				$x=$x+5;
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(24);
						$pdf->Setfont('Helvetica','',12);	
	    				$pdf->Cell(0,20, "Dean, Graduate School");

						$x=$x+10;
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(24);
						$pdf->Setfont('Helvetica','',12);
	    				$pdf->Cell(0,20, "Noted By:");

					$stmt4 = $arr3->readvp();
					$row4 = $stmt4->fetch();
					$vp = $row4['value'];
	    				$x=$x+23;
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(24);
						$pdf->Setfont('Helvetica','B',12);
	    				$pdf->Cell(0,20, strtoupper($vp));
	    				$x=$x+5;
	    				$pdf -> SetY($x);
	    				$pdf -> SetX(24);
						$pdf->Setfont('Helvetica','',12);
	    				$pdf->Cell(0,20, "Vice President for Academics");


$pdf->Output();

?>