<?php
require('fpdf/fpdf.php');

	include_once '../config/database.php';
	  include_once '../objects/schedule.php';
	  include_once '../objects/options.php';
	  include_once '../objects/programs.php';
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

$pdf = new FPDF('L','mm',array(330.2,215.9));

$pdf->AddFont('Times','','times.php');
$pdf->AddFont('Old','','old.php');
$pdf->AddFont('Helvetica','','helvetica.php');

$page=0;


$pdf->AddPage('L');
$pdf->Setfont('Times','',12);


$pdf->Setfont('Times','B',12);
$pdf -> SetY(5);
$pdf -> SetX(300);
$pdf->Cell(0,20,'Page | '.++$page);


$image1 = 'fpdf/spuplogo.png';
$pdf->Image($image1, 118, 19, 15,15);

$pdf->Setfont('Old','',15);
$pdf -> SetY(19);
$pdf -> SetX(75);
$pdf->Text(170-$pdf->GetStringWidth("St. Paul University Philippines")/2,27,"St. Paul University Philippines");

$pdf->Setfont('Times','',12);
$pdf->Text(170-$pdf->GetStringWidth("Tuguegarao City, Cagayan 3500")/2,32,"Tuguegarao City, Cagayan 3500");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$pdf->Setfont('Helvetica','B',12);
$pdf->Text(170-$pdf->GetStringWidth("GRADUATE SCHOOL")/2,40,"GRADUATE SCHOOL");


$pdf->Setfont('Times','',12);
	$text=strtoupper($t." AY, ".$sy);
	$pdf->Text(170-$pdf->GetStringWidth($text)/2,48,$text);

$pdf->Setfont('Helvetica','B',11);
	$text=strtoupper("COURSE OFFERINGS FOR MASTER DEGREE PROGRAMS");
	$pdf->Text(170-$pdf->GetStringWidth($text)/2,53,$text);
$x=53;

			  $prog= new Programs($db);
			  $schedude= new Scheduling($db);
			  $schedude->term = $t;
              $schedude->year = $sy;

              if ($_GET['q']!=0) {
               $progstmt = $prog->readone($_GET['q']);
              }else
              $progstmt = $prog->read(); 

while ($row2 = $progstmt->fetch()){   

	$schedude->programid = $row2[0];
    $stmt = $schedude->read();
    $temp=0;

           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               extract($row);
               if($temp == 0 ){
               	$temp++;
               		$pdf->Setfont('Helvetica','B',13);
               		if ($row2[3]=='') {
               			$append = "";
                                  }else{ $append = " (".$row2[3].")";}

					$text=strtoupper($row2[1]." - " . $row2[2] . " ".$append);
					$x=$x+11;
					$pdf->Text(170-$pdf->GetStringWidth($text)/2,$x,$text);
					$x=$x+1;
					$pdf->Setfont('Helvetica','B',11);
						
				$pdf -> SetY($x);
						$pdf->Cell(35,5,"COURSE CODE",1,'LR','C');
						$pdf->Cell(85,5,"COURSE TITLE",1,'LR','C');
						$pdf->Cell(20,5,"UNITS",1,'LR','C');
						$pdf->Cell(52,5,"SCHEDULE",1,'LR','C');
						$pdf->Cell(30,5,"TIME",1,'LR','C');
						$pdf->Cell(33,5,"ROOM",1,'LR','C');
						$pdf->Cell(55,5,"PROFESSOR",1,'LR','C');

               	$x=$x+5;
               }

				$pdf -> SetY($x);
					$pdf->Setfont('Helvetica','',11);
				$append = $code;if($merge!=''){$append = $append. "/".$merge;}
				$tempFontSize = 11;
				while($pdf->getStringWidth(html_entity_decode($append)) >35){// loop until the string width is smaller than cell width
		        		$pdf->SetFontSize($tempFontSize -= 0.1);
		    		}
						$pdf->Cell(35,6,$append,1,'LR','C');
					$pdf->Setfont('Helvetica','',11);

					$tempFontSize = 11;
				while($pdf->getStringWidth(html_entity_decode($title)) >83){// loop until the string width is smaller than cell width
		        		$pdf->SetFontSize($tempFontSize -= 0.1);
		    		}
						$pdf->Cell(85,6,html_entity_decode($title),1,'LR','L');

					$pdf->Setfont('Helvetica','',11);
						$pdf->Cell(20,6,$units,1,'LR','C');

						$tempFontSize = 11;
				while($pdf->getStringWidth($sched) >52){// loop until the string width is smaller than cell width
		        		$pdf->SetFontSize($tempFontSize -= 0.1);
		    		}
						$pdf->Cell(52,6,$sched,1,'LR','C');
					$pdf->Setfont('Helvetica','',11);

						$pdf->Cell(30,6,$time,1,'LR','C');
						$tempFontSize = 11;
				while($pdf->getStringWidth($room) >33){// loop until the string width is smaller than cell width
		        		$pdf->SetFontSize($tempFontSize -= 0.1);
		    		}
						$pdf->Cell(33,6,$room,1,'LR','C');
					$pdf->Setfont('Helvetica','',11);
						$tempFontSize = 11;
						$text=strtoupper($professor);
						while($pdf->getStringWidth($text) >55){// loop until the string width is smaller than cell width
		        		$pdf->SetFontSize($tempFontSize -= 0.1);
		    			}
						$pdf->Cell(55,6,$text,1,'LR','C');
					$pdf->Setfont('Helvetica','',11);

               	$x=$x+6;
								               	if ($x>192) {
														$pdf->AddPage('L');
														$pdf->Setfont('Times','',12);

														$pdf->Setfont('Times','B',12);
														$pdf -> SetY(5);
														$pdf -> SetX(300);
														$pdf->Cell(0,20,'Page | '.++$page);

														$image1 = 'fpdf/spuplogo.png';
														$pdf->Image($image1, 118, 19, 15,15);

														$pdf->Setfont('Old','',15);
														$pdf -> SetY(19);
														$pdf -> SetX(75);
														$pdf->Text(170-$pdf->GetStringWidth("St. Paul University Philippines")/2,27,"St. Paul University Philippines");

														$pdf->Setfont('Times','',12);
														$pdf->Text(170-$pdf->GetStringWidth("Tuguegarao City, Cagayan 3500")/2,32,"Tuguegarao City, Cagayan 3500");

														ini_set('display_errors', 1);
														ini_set('display_startup_errors', 1);
														error_reporting(E_ALL);


														$pdf->Setfont('Helvetica','B',12);
														$pdf->Text(170-$pdf->GetStringWidth("GRADUATE SCHOOL")/2,40,"GRADUATE SCHOOL");


														$pdf->Setfont('Times','',12);
															$text=strtoupper($t." AY, ".$sy);
															$pdf->Text(170-$pdf->GetStringWidth($text)/2,48,$text);

														$pdf->Setfont('Helvetica','B',11);
															$text=strtoupper("COURSE OFFERINGS FOR MASTER DEGREE PROGRAMS");
															$pdf->Text(170-$pdf->GetStringWidth($text)/2,53,$text);
														$x=60;
													}
		}	
													if ($x>162) {
														$pdf->AddPage('L');
														$pdf->Setfont('Times','',12);

														$pdf->Setfont('Times','B',12);
														$pdf -> SetY(5);
														$pdf -> SetX(300);
														$pdf->Cell(0,20,'Page | '.++$page);
														
														$image1 = 'fpdf/spuplogo.png';
														$pdf->Image($image1, 118, 19, 15,15);

														$pdf->Setfont('Old','',15);
														$pdf -> SetY(19);
														$pdf -> SetX(75);
														$pdf->Text(170-$pdf->GetStringWidth("St. Paul University Philippines")/2,27,"St. Paul University Philippines");

														$pdf->Setfont('Times','',12);
														$pdf->Text(170-$pdf->GetStringWidth("Tuguegarao City, Cagayan 3500")/2,32,"Tuguegarao City, Cagayan 3500");

														ini_set('display_errors', 1);
														ini_set('display_startup_errors', 1);
														error_reporting(E_ALL);


														$pdf->Setfont('Helvetica','B',12);
														$pdf->Text(170-$pdf->GetStringWidth("GRADUATE SCHOOL")/2,40,"GRADUATE SCHOOL");


														$pdf->Setfont('Times','',12);
															$text=strtoupper($t." AY, ".$sy);
															$pdf->Text(170-$pdf->GetStringWidth($text)/2,48,$text);

														$pdf->Setfont('Helvetica','B',11);
															$text=strtoupper("COURSE OFFERINGS FOR MASTER DEGREE PROGRAMS");
															$pdf->Text(170-$pdf->GetStringWidth($text)/2,53,$text);
														$x=53;
													}
	}

$pdf->Output();