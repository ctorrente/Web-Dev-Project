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
		$chair = mysqli_fetch_assoc(mysqli_query($conn, "SELECT is_admin FROM faculty WHERE user_id = $cid"));
	}
	
	if (isset($_POST['execute'])) {
		if ($_POST['action'] == 'editstatus' && isset($_POST['row_id'])) {
			$for_editing = 1;
		}
		else {
			$for_editing = 0;
			if ($_POST['action'] == 'makemod') {
				$makemodsql = "UPDATE moderator SET faculty_id = '" . $_POST['row_id'] . "' WHERE 1;";
				mysqli_query($conn, $makemodsql);
			}
			else if ($_POST['action'] == 'makechair') {
				$makechairsql = "UPDATE chair SET faculty_id = '" . $_POST['row_id'] . "' WHERE 1;";
				mysqli_query($conn, $makechairsql);
				$update1sql = "UPDATE faculty SET is_admin = 1 WHERE faculty_id = '" . $_POST['row_id'] . "';";
				mysqli_query($conn, $update1sql);
				$update2sql = "UPDATE faculty SET is_admin = 0 WHERE user_id = '" . $cid . "';";
				mysqli_query($conn, $update2sql);
				$_SESSION['is_admin'] = 0;
				header('Location: profile.php');
			}
			else if ($_POST['action'] == 'makeprogcoord') {
				$makeprogcoordsql = "UPDATE program_coordinator SET faculty_id = '" . $_POST['row_id'] . "' WHERE 1;";
				mysqli_query($conn, $makeprogcoordsql);
			}
		}
	}
	else $for_editing = 0;

	if (isset($_POST['savechanges'])) {
		$statussql = "UPDATE faculty SET status = '" . $_POST['status'] . "' WHERE faculty_id = '" . $_POST['row_id'] . "';";
		mysqli_query($conn, $statussql);
	}
	
	require('header.php');
	echo "<br><br>";
	require('navbar.php');
?>
	<br><br><br><br>
		<h1> Faculty List </h1>
		<table border=1 style="margin:0 auto;width: 90%;text-align:center;">
			<tr>
				<th> Faculty ID </th>
				<th> Faculty Name </th>
				<th> Gender </th>
				<th> Birth Date </th>
				<th> Address </th>
				<th> GBox Account </th>
				<th> Status </th>
				<th> Additional </th>
				<th> Actions </th>
			</tr>
	<?php
		$facultysql = "SELECT * FROM faculty;";
		$result = mysqli_query($conn, $facultysql);
		while ($row = mysqli_fetch_assoc($result)) {
			$user_id = $row['user_id'];
			$faculty_id = $row['faculty_id'];
			$status = $row['status'];
			$is_admin = $row['is_admin'];
			
			$details_sql = "SELECT * FROM users WHERE user_id = ".$user_id.";";
			$details_result = mysqli_query($conn, $details_sql);
			$details_row = mysqli_fetch_assoc($details_result);
			echo "<tr>";
			echo "<td>" . $faculty_id . "</td>";
			echo "<td>" . $details_row['last_name'] . ", " . $details_row['first_name'] . " " . $details_row['middle_name'] . "</td>";
			echo "<td>" . $details_row['gender'] . "</td>";
			echo "<td>" . $details_row['birth_date'] . "</td>";
			echo "<td>" . $details_row['address'] . "</td>";
			echo "<td>" . $details_row['gbox_acct'] . "</td>";
			echo "<td>";
				echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
				if ($for_editing == 1 && $faculty_id == $_POST['row_id']) {
					echo "<select name='status'>";
					echo "<option value='0'>Full Time</option>";
					echo "<option value='1'>Part Time</option>";
					echo "<option value='2'>On Leave</option>";
					echo "</select>";
				}
				else {
					if ($status == 0) echo "Full Time";
					else if ($status == 1) echo "Part Time";
					else if ($status == 2) echo "On Leave";
				}
			echo "</td>";
			echo "<td>";
				$chairsql = "SELECT faculty_id FROM chair;";
				$chair_result = mysqli_query($conn, $chairsql);
				$chair_row = mysqli_fetch_assoc($chair_result);
					if ($chair_row['faculty_id'] == $faculty_id) echo "Chairperson ";
					else echo " - ";
				
				echo " / ";
					
				$moderatorsql = "SELECT faculty_id FROM moderator;";
				$moderator_result = mysqli_query($conn, $moderatorsql);
				$moderator_row = mysqli_fetch_assoc($moderator_result);
					if ($moderator_row['faculty_id'] == $faculty_id) echo "Moderator ";
					else echo " - ";
					
				echo " / ";
				
				$progcoordsql = "SELECT faculty_id FROM program_coordinator;";
				$progcoord_result = mysqli_query($conn, $progcoordsql);
				$progcoord_row = mysqli_fetch_assoc($progcoord_result);
					if ($progcoord_row['faculty_id'] == $faculty_id) echo "Program Coordinator ";
					else echo " - ";
					
				echo " / ";
				
				$advisersql = "SELECT faculty_id FROM adviser WHERE faculty_id = '".$faculty_id."';";
				$adv_result = mysqli_query($conn, $advisersql);
				$adv_row = mysqli_fetch_assoc($adv_result);
					if ($adv_row['faculty_id'] == $faculty_id) echo "Adviser ";
					else echo " - ";	
			echo "</td>";
			echo "<td style='padding:10px;'>";
					if ($for_editing == 1) {
						echo "<input type='hidden' name='row_id' value='".$faculty_id."'>";
						echo "<input type='submit' name='savechanges' value='Save Changes' style='width:90%'>";
					}
					else {
						echo "<input type='hidden' name='row_uid' value='".$user_id."'>";
						echo "<input type='hidden' name='row_id' value='".$faculty_id."'>";
						echo "<div style='float:right;margin-right:2px;width: 30%;'><input type='submit' name='execute' value='Go' style='width:70%;'></div>";
						echo "<div style='float:right;width: 67%;'><select name='action' class='formselect'>".
							"<option value=''> -- Select Action -- </option>" .
							"<option value='editstatus'>Edit Status </option>" .
							"<option value='' disabled>-------------------------</option>" . 
							"<option value='' disabled>Assign as</option>" . 
							"<option value='' disabled>-------------------------</option>" . 
							"<option value='makemod'>Moderator </option>" .
							"<option value='makechair'>Chairperson </option>" .
							"<option value='makeprogcoord'>Program Coordinator </option>" .
							"</select></div>";
					}
				echo "</form>";
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