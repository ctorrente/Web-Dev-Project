<?php
	require('connection.php');
	require('header.php');
	require('navbar.php');


	if(isset($_POST['add_course'])) {
		$course_code = $_POST['course_code'];
		$course_name = $_POST['course_name'];
		$credit_units = $_POST['credit_units'];
		$course_desc = $_POST['course_desc'];

		$sql = "INSERT INTO course values(null, '$course_code', '$course_name', $credit_units, '$course_desc')";
		mysqli_query($conn, $sql);
		$id = mysqli_insert_id($conn);
		echo "id = " . $id;
		if (isset($_POST['prerequisite'])) {
			$prerequisites = $_POST['prerequisite'];
			foreach ($prerequisites as $prerequisite) {
				$sql = "SELECT * FROM course WHERE course_code='$prerequisite'";
				 
				$courses = mysqli_query($conn, $sql);
				if(mysqli_num_rows($courses) != 0) { 
					$course = mysqli_fetch_array($courses);
					$course_id = $course['course_id']; 
					$sql = "INSERT INTO prerequisite values($id , $course_id)";
					mysqli_query($conn, $sql);
				}
			}
		}	
	}
?>

<div class="container">
	<div class="content-wrapper" style="padding: 150px 0px 50px 0px">
		<form class="addeve" style="padding: 0px" method="post" action="add_course.php">
			<h1>Add Course</h1>
			<input type="text" name="course_code" placeholder="Course code">
			<input type="text" name="course_name" placeholder="Course title">
			<input type="text" name="credit_units" placeholder="Credit units">
			<input type="text" name="course_desc" placeholder="Course description"></td>
			<div id="prerequisite-list">
			Prerequisites:
			</div>
			<input id="pre" type="text" name="course_code_pre" placeholder="Prerequisite course code"></td>
			<input type="button" onclick="$('#prerequisite-list').append('<input name=\'prerequisite[]\' value=\'' + $('#pre').val() + '\' readonly><br>'); $('#pre').val('')"name="add_course" value="Add Prerequisite">
			<input type="submit" name="add_course" value="Add Course">
		</form>
	</div>
</div>


<?php
	require('footer.php');
?>