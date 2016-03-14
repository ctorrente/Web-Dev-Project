<?php
    include("link.php");

	$IS_profs = array();
	$CS_profs = array();
	$IT_profs = array();
	
	$IS_query = "SELECT username FROM users WHERE major='IS' AND user_type = 2";
	$IT_query = "SELECT username FROM users WHERE major='IT' AND user_type = 2";
	$CS_query = "SELECT username FROM users WHERE major='CS' AND user_type = 2";
	
	$IS_result = mysqli_query($connect, $IS_query);
	$IS_ct = 0;
	while ($row = mysqli_fetch_assoc($IS_result)) {
		$IS_profs[$IS_ct] = $row['username'];
		$IS_ct++;
	}
	
	$IT_result = mysqli_query($connect, $IT_query);
	$IT_ct = 0;
	while ($row = mysqli_fetch_assoc($IT_result)) {
		$IT_profs[$IT_ct] = $row['username'];
		$IT_ct++;
	}
	
	$CS_result = mysqli_query($connect, $CS_query);
	$CS_ct = 0;
	while ($row = mysqli_fetch_assoc($CS_result)) {
		$CS_profs[$CS_ct] = $row['username'];
		$CS_ct++;
	}
	
    $getall_query = mysqli_query($connect, "SELECT u.user_id, u.major FROM users u, students s WHERE s.adviser_id IS NULL AND u.user_type=1 AND u.username = s.student_id");
    $IT_assigned = 0;
	$IS_assigned = 0;
	$CS_assigned = 0;
	
    while($data = mysqli_fetch_assoc($getall_query)) {
        if($data['major'] == "IT") {
            $uid = $data['user_id'];
            mysqli_query($connect, "UPDATE students SET adviser_id='".$IT_profs[$IT_assigned]."' WHERE user_id=$uid");
			$IT_assigned = ($IT_assigned + 1) % sizeof($IT_profs);
        } elseif ($data['major'] == "IS") {
            $uid = $data['user_id'];
            mysqli_query($connect, "UPDATE students SET adviser_id='".$IS_profs[$IS_assigned]."' WHERE user_id=$uid");
			$IS_assigned = ($IS_assigned + 1) % sizeof($IS_profs);
        } elseif ($data['major'] == "CS"){
            $uid = $data['user_id'];
            mysqli_query($connect, "UPDATE students SET adviser_id='".$CS_profs[$CS_assigned]."' WHERE user_id=$uid");
			$CS_assigned = ($CS_assigned + 1) % sizeof($CS_profs);
        }
		
    }
    
    echo "<script>alert('Advisers has been set!')</script>";
?>