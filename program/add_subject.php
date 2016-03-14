<?php
	require('connection.php');
	require('header.php');
	require('navbar.php');

	$program_code = $_GET['program_code'];
	$curriculum_year = $_GET['curriculum_year'];
	if(isset($_GET['add_subject'])) {
		$year_level = $_GET['year_level'];
		$semester = $_GET['semester'];
		$add_subject = $_GET['add_course_code'];

		$sql = "SELECT * FROM program WHERE program_code='$program_code'";
		$programs = mysqli_query($conn, $sql);
		$program = mysqli_fetch_array($programs);
		$program_id = $program['program_id'];

		$sql = "SELECT * FROM curriculum WHERE program_id=$program_id AND curriculum_year=$curriculum_year";
		$curriculums = mysqli_query($conn, $sql);
		$curriculum = mysqli_fetch_array($curriculums);
		$curriculum_id = $curriculum['curriculum_id'];

		$sql = "SELECT * FROM course WHERE course_code='$add_subject'";
		$courses = mysqli_query($conn, $sql);
		if(mysqli_num_rows($courses) != 0) {
			$course = mysqli_fetch_array($courses);
			$course_id_add = $course['course_id'];
			$sql = "INSERT INTO curr_subjects values($curriculum_id, $course_id_add, $year_level, $semester)";
			mysqli_query($conn, $sql);
		}
	}
?>

<div class="container">
	<div class="content-wrapper" style="padding: 150px 0px 50px 0px">
		<form class="addeve" style="padding: 0px" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<h1>Add Subject</h1>
			<input name="program_code" value="<?php echo $program_code; ?>" hidden>
			<input name="curriculum_year" value="<?php echo $curriculum_year; ?>" hidden>
			<select name="year_level">
				<option value="1"> 1st Year </option>
				<option value="2"> 2nd Year </option>
				<option value="3"> 3rd Year </option>
				<option value="4"> 4th Year </option>
			</select>
			<select name="semester">
				<option value="1"> 1st Semester </option>
				<option value="2"> 2nd Semester </option>
				<option value="3"> Summer </option>
			</select>
			<input type="text" name="add_course_code" placeholder="Course code"></td>
			<input type="submit" name="add_subject" value="Add Subject">
		</form>	
	</div>
</div>

<?php
	require('footer.php');
?>