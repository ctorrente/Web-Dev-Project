<?php
	require('connection.php');
	require('header.php');
	require('navbar.php');

	$sql = "SELECT * FROM program";
	$programs = mysqli_query($conn, $sql);

	if(isset($_POST['add_curriculum'])) {
		$program_id = $_POST['program_id'];
		$curriculum_year = $_POST['curriculum_year'];
		$sql = "INSERT INTO curriculum values(null, $program_id, $curriculum_year, null, null)";
		$exec = mysqli_query($conn, $sql);
		$cid = mysqli_insert_id($conn);
		if (mysqli_affected_rows($conn) > 0) {
			$create_pdf_stats = "INSERT INTO curriculum_downloads(curriculum_id) VALUES(".$cid.")";
			mysqli_query($conn, $create_pdf_stats);
		}
	}
?>

<div class="container">
	<div class="content-wrapper" style="padding: 150px 0px 50px 0px">
		<form class="addeve" style="padding: 0px" method="post" action="add_curriculum.php">
			<h1>Add Curriculum</h1>
			<select name="program_id">
			<?php 
				while($program = mysqli_fetch_array($programs)) {
					echo "<option value='" . $program['program_id'] . "'>" . $program['program_name'] . "</option>";
				}
			?>
			</select>
			<input type="text" name="curriculum_year" placeholder="Curriculum year"></td>
			<input type="submit" name="add_curriculum" value="Add Curriculum">
		</form>
	</div>
</div>


<?php
	require('footer.php');
?>