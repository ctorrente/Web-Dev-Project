<!DOCTYPE html>
<?php 
	session_start();
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
	
	if(!$_SESSION['user_id'] || $_SESSION['is_admin'] != 1) {
		header("Location: login.php");
		exit;
	} else {
		$cid = $_SESSION['user_id'];
		$info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_id=$cid"));
	}
	
	require('header.php');
	echo "<br><br>";
	require('navbar.php');
?>
	<br><br><br><br>
		<h1> Student List </h1>
		<table border=1 style="margin:0 auto;width: 90%;text-align:center;">
			<tr>
				<th> Student ID </th>
				<th> Student Name </th>
				<th> Course </th>
				<th> Gender </th>
				<th> Birth Date </th>
				<th> Address </th>
				<th> GBox Account </th>
				<th> Additional </th>
				<!-- <th> Actions </th> -->
			</tr>
	<?php
		$studentssql = "SELECT user_id, student_id FROM students ORDER BY user_id;";
		$result = mysqli_query($conn, $studentssql);
		while ($row = mysqli_fetch_assoc($result)) {
			$user_id = $row['user_id'];
			$student_id = $row['student_id'];
			
			$details_sql = "SELECT * FROM users WHERE user_id = ".$user_id.";";
			$details_result = mysqli_query($conn, $details_sql);
			$details_row = mysqli_fetch_assoc($details_result);
			echo "<tr>";
			echo "<td>" . $student_id . "</td>";
			echo "<td>" . $details_row['last_name'] . ", " . $details_row['first_name'] . " " . $details_row['middle_name'] . "</td>";
			echo "<td>BS " . $details_row['major'] . "</td>";
			echo "<td>" . $details_row['gender'] . "</td>";
			echo "<td>" . $details_row['birth_date'] . "</td>";
			echo "<td>" . $details_row['address'] . "</td>";
			echo "<td>" . $details_row['gbox_acct'] . "</td>";
			echo "<td>";
				$officer_sql = "SELECT * FROM organization_officer WHERE student_id = '". $student_id ."';";
				$o_result = mysqli_query($conn, $officer_sql);
				if (mysqli_num_rows($o_result) > 0) {
					$officer = mysqli_fetch_assoc($o_result);
					echo $officer['position'];
				}
				else {
					echo "-";
				}
			echo "</td>";
			echo "</tr>";
		}
	?>
	</body>
</html>
<?php
	//}
	//else {}
?>