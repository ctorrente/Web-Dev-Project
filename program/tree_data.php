<?php
	require('connection.php');
	$curriculum_id = $_GET['curriculum_id'];

	$sql = "SELECT * FROM curr_subjects WHERE curriculum_id=$curriculum_id";
	$curr_subjects = mysqli_query($conn, $sql);

	$x = 0;
	while($subj = mysqli_fetch_array($curr_subjects)) {
		$sql = "SELECT * FROM course WHERE course_id=". $subj['course_id'];
		$courses = mysqli_query($conn, $sql);
		$course = mysqli_fetch_array($courses);
		
		$data[$x]['id'] = $course['course_id'];
		$data[$x]['title'] = $course['course_code'];
		$data[$x]['name'] = $course['course_name'];

		$sql = "SELECT * FROM prerequisite where course_id=" . $subj['course_id'];
		$prereqs = mysqli_query($conn, $sql);
		$y = 0;
		while($prereq = mysqli_fetch_array($prereqs)) {
			$data[$x]['parents'][$y] = $prereq['course_id_pre'];
			$y++;
		}
		$x++;
	}
	echo json_encode($data);
?>