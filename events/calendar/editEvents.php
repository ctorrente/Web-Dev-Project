<?php 
	// Values received via ajax
	$id = $_POST['id'];
	$title = $_POST['title'];
	$desc = $_POST['desc'];	
	$sub_by = $_POST['sub_by'];	

	// connection to the database
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=dcs_project', 'root', 'root');
	} catch(Exception $e) {
		exit('Unable to connect to database.');
	}
	
	if ($sub_by == '5')
		$status = '2';
	else
		$status = '0';

	// update the records
	$sql = "UPDATE EVENT SET event_title=:title, event_desc=:desc, event_status=:status WHERE event_id=:id";
	$q = $bdd->prepare($sql);
	$q->execute(array(':id'=>$id, ':title'=>$title,':desc'=>$desc, ':status'=>$status));
?>