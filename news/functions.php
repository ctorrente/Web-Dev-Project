<?php
	/* File Description: Functions that are used in news module 
 		*	type users or news that are posted/approved by the moderator.
 		* @version 2.0
		* @authors Charles Torrente
	*/
	session_start();
	date_default_timezone_set('Asia/Manila');
	function login($conn, $username, $password){
		$query = "SELECT * FROM users where username like '%" . $username . "%'";
		$exec_query = @mysqli_query($conn, $query);
		$row = @mysqli_fetch_assoc($exec_query);
		
		if(mysqli_num_rows($exec_query) == 0 || $row['password'] != $password)
			echo '<script type="text/javascript">window.alert("Invalid username or password");</script>';
		else{
			$_SESSION['loginStatus'] = true;
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['username'] = $row['username'];

			switch($row['user_type']){
				case 'C':
					$_SESSION['user_type'] = 'C';
					header('location: home.php');
					break;
				case 'O':
					$_SESSION['user_type'] = 'O';
					header('location: home.php');
					break;
				case 'T':
					$_SESSION['user_type'] = 'T';
					header('location: home.php');
					break;
				default:
					$_SESSION['user_type'] = 'S';
					header('location: home.php');
					break;
			}
		}
	}

	function getTotalPictures($conn){
		$query = 'SELECT max(picture_id) as picture_id FROM picture';
		$exec = mysqli_query($conn, $query);
		$rows = mysqli_fetch_assoc($exec);

		if($rows['picture_id'] > 0)
			return $rows['picture_id'];
		else{
			return 0;
		}
	}

	function doQuery($query, $conn){
		$exec = mysqli_query($conn, $query);
	}
?>