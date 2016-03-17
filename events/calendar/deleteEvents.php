<?php 
	// Values received via ajax
	$id = $_POST['id'];

	// connection to the database
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=dcs_project', 'root', 'root');
	} catch(Exception $e) {
		exit('Unable to connect to database.');
	}

	// insert the records
	$sql = "DELETE FROM EVENT WHERE event_id=:id";
	$q = $bdd->prepare($sql);
	$q->execute(array(':id'=>$id));
?>