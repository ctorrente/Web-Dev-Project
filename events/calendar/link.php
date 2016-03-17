<?php
	error_reporting(E_ALL);
	
	date_default_timezone_set("Asia/Manila");
	
	$host = "localhost";
	$user = "root";
	$pass = "root";
	$dbse = "dcs_project";
	
	$connect = mysqli_connect($host, $user, $pass, $dbse);
	
	if (!$connect) {
		die('Could not connect to database: ' . mysqli_error($connect));
	}
	
	mysqli_select_db($connect, $dbse);
?>