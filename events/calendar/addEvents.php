<?php 

	// Values received via ajax
	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$sub = $_POST['sub'];
	
	// $conn = mysqli_connect("localhost", "root", "root");
	// mysqli_select_db($conn, "DCS");
	
	// $sql= "INSERT INTO EVENTS (event_title, event_desc, event_start, event_end) VALUES (:title, :desc, :start, :end)";
	// $result = mysqli_query($conn, $sql);
	
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=dcs_project', 'root', 'root');
	} catch(Exception $e) {
		exit('Unable to connect to database.');
	}
	
	session_start();
	if ($_SESSION['user_type'] == 0)
		$color = "#00cc66";
	if ($_SESSION['user_type'] == 1)
		$color = "#ff751a";
	if ($_SESSION['user_type'] == 4)
		$color = "#9966ff";
	if ($_SESSION['user_type'] == 5)
		$status = 2;

	$sql = "INSERT INTO EVENT (event_title, event_desc, event_start, event_end, event_color, event_status, event_sub_by) VALUES (:title, :desc, :start, :end, :color, :status, :sub)";
	$q = $bdd->prepare($sql);
	$q->execute(array(':title'=>$title,':desc'=>$desc, ':start'=>$start, ':end'=>$end, ':color'=>$color, ':status'=>$status, ':sub'=>$sub));
?>