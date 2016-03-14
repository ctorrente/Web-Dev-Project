<?php
	require('connection.php');
	require('header.php');
	require('navbar.php');
	$program_code = $_GET['program_code'];
	$curriculum_year = $_GET['curriculum_year'];

	$sql = "SELECT * FROM program WHERE program_code='$program_code'";
	$programs = mysqli_query($conn, $sql);
	$program = mysqli_fetch_array($programs);
	$program_id = $program['program_id'];

	$sql = "SELECT * FROM curriculum WHERE program_id=$program_id AND curriculum_year=$curriculum_year";
	$curriculums = mysqli_query($conn, $sql);
	$curriculum = mysqli_fetch_array($curriculums);
	$curriculum_id = $curriculum['curriculum_id'];
?>
<input type="text" name="curriculum_id" value="<?php echo $curriculum_id; ?>" hidden>
<div class="container">
	<div id="diagram" class="content-wrapper" style="padding: 150px 0px 50px 0px">

	</div>
</div>

<?php
	require('footer.php');
?>