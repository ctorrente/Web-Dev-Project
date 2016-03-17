<?php 
	// Values received via ajax
	$id = $_POST['id'];
	$title = $_POST['title'];
	$desc = $_POST['desc'];	

	// connection to the database
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=dcs_project', 'root', 'root');
	} catch(Exception $e) {
		exit('Unable to connect to database.');
	}

	// update the records
	$sql = "UPDATE EVENT SET event_title=:title, event_desc=:desc WHERE event_id=:id";
	$q = $bdd->prepare($sql);
	$q->execute(array(':id'=>$id, ':title'=>$title,':desc'=>$desc));
?>