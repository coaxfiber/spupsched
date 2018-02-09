<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include_once '../config/database.php';
	include_once '../objects/options.php';
	$database = new Database();
	$db = $database->getConnection();
	$arr= new Options($db);
	$stmt = $arr->readschoolyear();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	extract($row);
	echo $value;
?>