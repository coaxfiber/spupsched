<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
	include_once '../config/database.php';
	include_once '../objects/options.php';
	$database = new Database();
	$db = $database->getConnection();
                $arr= new Options($db);
                $stmt = $arr->readstart();
                $row = $stmt->fetch();
                $test = 1;

                $x=0;
                $y=0;

                $string = date("M j", strtotime($row[2]));
                $month = date("M", strtotime($row[2]));
                $x++;
                while ($y<6) {
                	if (date("w", strtotime($row[2].' +'.$x.' day'))==0 || date("w", strtotime($row[2].' +'.$x.' day'))==6) {
                		if ($month == date("M", strtotime($row[2].' +'.$x.' day'))) {
                			$string = $string .", ". date("j", strtotime($row[2].' +'.$x.' day'));
                		}else{
                			$string = $string .", ". date("M j", strtotime($row[2].' +'.$x.' day'));
                			$month = date("M", strtotime($row[2].' +'.$x.' day'));
                		}
                		$y++;
                		//echo $x . "<br>";
                	}
                	$x++;
                }
                $first = $string;

                $x=$x+6;
                $y=0;
                if (date("M j", strtotime($row[2].' +'.$x.' day'))) {
                	# code...
                }
                $string = date("M j", strtotime($row[2].' +'.$x.' day'));
                $month = date("M", strtotime($row[2].' +'.$x.' day'));
                $x++;
                while ($y<6) {
                	if (date("w", strtotime($row[2].' +'.$x.' day'))==0 || date("w", strtotime($row[2].' +'.$x.' day'))==6) {
                		if ($month == date("M", strtotime($row[2].' +'.$x.' day'))) {
                			$string = $string .", ". date("j", strtotime($row[2].' +'.$x.' day'));
                		}else{
                			$string = $string .", ". date("M j", strtotime($row[2].' +'.$x.' day'));
                			$month = date("M", strtotime($row[2].' +'.$x.' day'));
                		}
                		$y++;
                		//echo $x . "<br>";
                	}
                	$x++;
                }
                
                $second = $string;
                $y=0;
                if (date("M j", strtotime($row[2].' +'.$x.' day'))) {
                	# code...
                }
                $string = date("M j", strtotime($row[2].' +'.$x.' day'));
                $month = date("M", strtotime($row[2].' +'.$x.' day'));
                $x++;
                while ($y<6) {
                	if (date("w", strtotime($row[2].' +'.$x.' day'))==0 || date("w", strtotime($row[2].' +'.$x.' day'))==6) {
                		if ($month == date("M", strtotime($row[2].' +'.$x.' day'))) {
                			$string = $string .", ". date("j", strtotime($row[2].' +'.$x.' day'));
                		}else{
                			$string = $string .", ". date("M j", strtotime($row[2].' +'.$x.' day'));
                			$month = date("M", strtotime($row[2].' +'.$x.' day'));
                		}
                		$y++;
                		//echo $x . "<br>";
                	}
                	$x++;
                }
                
                $third = $string;
?>