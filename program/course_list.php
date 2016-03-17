<?php
	require('connection.php');
	require('header.php');
	require('navbar.php');

	$sql = "SELECT * FROM course";
	$courses = mysqli_query($conn, $sql);
?>

<div class="container">
	<div class="content-wrapper" style="padding: 150px 0px 50px 0px">
		<?php if ($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 5) { 
			echo '<form style="padding: 0px"class="addeve" action="add_course.php" method="POST">';
			echo '	<input type="submit" name="add_course_btn" value="Add Course">';
			echo '</form>';
		} ?>
		<table class="course-table">
			<tr>
				<th>Course code</th>
				<th>Course Description</th>
				<th>Credit units</th>
				<th>Prerequisites<th>
			</tr>
			<?php 
				while($course = mysqli_fetch_array($courses)) {
					$pre = "";
					$sql = "SELECT * FROM prerequisite WHERE course_id=".$course['course_id'];
					$prereqs = mysqli_query($conn, $sql);
					while($prereq = mysqli_fetch_array($prereqs)) {
						$sql = "SELECT * FROM course WHERE course_id=" . $prereq['course_id_pre'];
						$pcourses = mysqli_query($conn, $sql);
						$pcourse = mysqli_fetch_array($pcourses);
						if($pre != "")
							$pre .= ", ";
						$pre .= $pcourse['course_code'];
					}
					if($pre == "")
						$pre = "NONE";
					echo 
					"<tr> " .
						"<td>" . $course['course_code'] ."</td>" .
						"<td>" . $course['course_name'] ."</td>" .
						"<td>" . $course['credit_units'] ."</td>" .
						"<td>" . $pre ."</td>" .
					"<tr>";
			} ?>
		</table>
	</div>
</div>


<?php
	require('footer.php');
?>