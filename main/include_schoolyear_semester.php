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
	$stmt = $arr->readschoolyear();
	$row = $stmt->fetch();

	$arr2= new Options($db);
	$stmt2 = $arr2->readsemester();
	$row2 = $stmt2->fetch();
	echo $row['value'] . " - " .$row2['value'] ;
	$_SESSION['year'] = $row['value'] ;
	$_SESSION['sem'] = $row2['value'] ;
?>