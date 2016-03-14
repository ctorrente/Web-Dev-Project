<?php
	$servername = "localhost";
	$username = "root";
	$password = "admin";
	$dbname = "dcs_project";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$password = md5($_POST['password']);
	$bday = str_replace("-", "", $_POST['bday']);
	$sid = 's' . $_POST['idnum'];
	$insertUser_sql = "INSERT INTO users (user_type, username, password, major, first_name, middle_name, last_name, gender, birth_date, address, gbox_acct) VALUES ('1', '" . $sid . "', '" . $password . "', '".$_POST['major']."',  '" . $_POST['fname'] . "', '" . $_POST['mname'] . "', '" . $_POST['lname'] . "', '" . $_POST['gender'] . "', '" . $bday . "', '" . $_POST['address'] . "', '" . $_POST['gbox'] . "')";
	$insertUser_result = mysqli_query($conn, $insertUser_sql);
	if($insertUser_result == true)
	{
		echo "SUCCESS";
		$queryUserId_sql = "SELECT user_id FROM users WHERE username='" . $sid . "'";
		$queryUserId_result = mysqli_query($conn, $queryUserId_sql);
		$row_userid = mysqli_fetch_assoc($queryUserId_result);

		$insertStudent_sql = "INSERT INTO students (user_id, student_id, year_level, year_started, is_alumni) VALUES ('" . $row_userid['user_id'] . "', '" . $sid . "', '" . $_POST['year'] . "', '" . $_POST['yearStarted'] . "', '0')";
		$insertStudent_result = mysqli_query($conn, $insertStudent_sql);
		if (mysqli_affected_rows($conn) > 0) {
			echo "<script>alert('Student successfully added!');</script>";
			echo "<script>setTimeout(\"location.href = 'addstudent.php';\",100);</script>";
		} else {
			echo "<script>alert('Error!');</script>";
			echo "<script>setTimeout(\"location.href = 'addstudent.php';\",100);</script>";
		}
	}
	else {
		echo "<script>alert('Error!');</script>";
		echo "<script>setTimeout(\"location.href = 'addstudent.php';\",100);</script>";	
	}
?>