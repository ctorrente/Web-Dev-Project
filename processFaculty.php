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

	$password = md5($_POST["password"]);
	$bday = str_replace("-","", $_POST["bday"]);
	$fac_id = 'f' . $_POST['fid'];
	$insertUser_sql = "INSERT INTO users (user_type, username, password, major, first_name, middle_name, last_name, gender, birth_date, address, gbox_acct) VALUES ('2', '" . $fac_id . "', '" . $password . "', '".$_POST['major']."', '" . $_POST["fname"] . "', '" . $_POST["mname"] . "', '" . $_POST["lname"] . "', '" . $_POST["gender"] . "', '" . $bday . "', '" . $_POST["address"] . "', '" . $_POST["gbox"] . "')";
	$insertUser_result = mysqli_query($conn, $insertUser_sql);
	if($insertUser_result == true)
	{
		$queryUserId_sql = "SELECT user_id FROM users WHERE username='" . $fac_id . "'";
		$queryUserId_result = mysqli_query($conn, $queryUserId_sql);
		$row_userid = mysqli_fetch_assoc($queryUserId_result);

		$insertFaculty_sql = "INSERT INTO faculty (user_id, faculty_id, status, is_admin) VALUES ('" . $row_userid["user_id"] . "', '" . $fac_id . "', '0', '0')";
		$insertFaculty_result = mysqli_query($conn, $insertFaculty_sql);
		if (mysqli_affected_rows($conn) > 0) {
			echo "<script>alert('Faculty member successfully added!');</script>";
			echo "<script>setTimeout(\"location.href = 'addfaculty.php';\",100);</script>";
		} else {
			echo "<script>alert('Error!');</script>";
			echo "<script>setTimeout(\"location.href = 'addfaculty.php';\",100);</script>";
		}
	}
	else {
		echo "<script>alert('Error!');</script>";
		echo "<script>setTimeout(\"location.href = 'addfaculty.php';\",100);</script>";	
	}
?>