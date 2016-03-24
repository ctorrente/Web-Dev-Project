<?php
	require('connection.php');
	require('header.php');
	require('navbar.php');

	$sql = "SELECT * FROM program";
	$programs = mysqli_query($conn, $sql);
?>

<div class="container">
	<div class="content-wrapper" style="padding: 150px 0px 50px 0px">
		<?php 
			if ($_SESSION['is_prog_coordinator'] == 1) {
			echo '<form style="padding: 0px"class="addeve" action="add_curriculum.php" method="POST">'.
				'<input type="submit" name="add_curriculum_btn" value="Add Curriculum">'.
			'</form>';
			}
		while($program = mysqli_fetch_array($programs)) { ?>
		<div class="program-info-container">
		<?php
			echo "<h2>" . $program['program_name'] . " (" . $program['program_code'] . ") <br></h2>"; 
			echo $program['program_desc'] . "<br>";

			echo "<h3>Available Curriculums:</h3>";
			$sql = "SELECT * FROM curriculum WHERE program_id = ". $program['program_id'];
			$curriculums = mysqli_query($conn, $sql);
			while($curriculum = mysqli_fetch_array($curriculums)) {
		?>
				<form style="margin: 0px 0px 2px 0px"id="<?php echo $program['program_code'] . $curriculum['curriculum_year']; ?>" action="curriculum_view.php" method="get">
					<input name="program_code" value="<?php echo $program['program_code']; ?>" hidden>
					<input id="curr-year-input" name="curriculum_year" value="<?php echo $curriculum['curriculum_year']; ?>" hidden>
					<input class="ibtn" type="submit" value="<?php echo $curriculum['curriculum_year']; ?>">
				</form>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>


<?php
	require('footer.php');
?>