<?php
	$conn = @mysqli_connect('localhost', 'root', 'admin') or die('Unable to connect to the database');
	@mysqli_select_db($conn, 'dcs_project') or die('Unable to load Database');
?>
