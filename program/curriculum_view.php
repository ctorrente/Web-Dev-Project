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

	$subjects = array();

	for($x = 1; $x <= 4; $x++) {
		for($y = 1; $y <= 3; $y++) {
			$sql = "SELECT * FROM curr_subjects WHERE curriculum_id=$curriculum_id AND curr_year=$x AND curr_sem=$y";
			$subject_list = mysqli_query($conn, $sql);
			$z = 0;
			while($subj = mysqli_fetch_array($subject_list)) {
				$course_id = $subj['course_id'];
				$sql = "SELECT * FROM course WHERE course_id=$course_id";
				$courses = mysqli_query($conn, $sql);
				$course = mysqli_fetch_array($courses);
				$subjects[$x][$y][$z]['course_code'] = $course['course_code'];
				$subjects[$x][$y][$z]['course_name'] = $course['course_name'];
				$subjects[$x][$y][$z]['credit_units'] = $course['credit_units'];

				$pre = "";
				$sql = "SELECT * FROM prerequisite where course_id=" . $course['course_id'];
				$prereqs = mysqli_query($conn, $sql);
				while($prereq = mysqli_fetch_array($prereqs)) {
					if($pre != "")
						$pre .= ", ";
					$sql = "SELECT * FROM course WHERE course_id=" . $prereq['course_id_pre'];
					$subjs = mysqli_query($conn, $sql);
					$subj = mysqli_fetch_array($subjs);
					$pre .= $subj['course_code'];
				}
				if($pre == "")
					$pre = "NONE";
				$subjects[$x][$y][$z]['prerequisites'] = $pre;
				$z++;
			} 
		}
	}
?>

<div class="container">
	<div class="content-wrapper" style="padding: 150px 0px 50px 0px">
	<?php if ($_SESSION['is_prog_coordinator'] == 1) {?>
		<form style="padding: 0px;"class="addeve" action="add_subject.php" method="GET">
			<input name="program_code" value="<?php echo $program_code; ?>" hidden>
			<input name="curriculum_year" value="<?php echo $curriculum_year; ?>" hidden>
			<input style="margin: 1px" type="submit" value="Add Subject">
		</form>
	<?php } ?>
		<form style="padding: 0px"class="addeve" action="pdf_view.php" method="GET">
			<input name="program_code" value="<?php echo $program_code; ?>" hidden>
			<input name="curriculum_year" value="<?php echo $curriculum_year; ?>" hidden>
			<input name="curriculum_id" value=<?php echo $curriculum_id;?> hidden>
			<input style="margin: 1px" type="submit" value="PDF view">
		</form>
		<form style="padding: 0px"class="addeve" action="tree_view.php" method="GET">
			<input name="program_code" value="<?php echo $program_code; ?>" hidden>
			<input name="curriculum_year" value="<?php echo $curriculum_year; ?>" hidden>
			<input style="margin: 1px" type="submit" value="Tree view">
		</form>
		<?php 
			for($x = 1; $x <= 4; $x++) {
		?>
		<br><br>
        <div class="semester-container">
            <b>
				<?php
					if($x == 1)
						echo "<h1>1st Year</h1>";
					else if($x == 2)
						echo "<h1>2nd Year</h1>";
					else if($x == 3)
						echo "<h1>3rd Year</h1>";
					else
						echo "<h1>4th Year</h1>";
				?>
			</b>
                
                        <div class="semester-one" >
                            <h2>1st Semester</h2>
                            <table>
                                <tr>
                                    <th class='course-code'>Course Code</th>
                                    <th class='course-name'>Course Description</th>
                                    <th class='credit-units'>Units</th>
                                    <th class='prerequisites'>Prerequisites</th>
                                </tr>
                                <?php 
                                    if(count($subjects) >= $x && count($subjects[$x]) > 0) {
    									for($z = 0; $z < count($subjects[$x][1]); $z++) {
    										echo "<tr>";
    										echo "<td class='course-code'>". $subjects[$x][1][$z]['course_code'] ."</td>";
    										echo "<td class='course-name'>". $subjects[$x][1][$z]['course_name'] ."</td>";
    										echo "<td class='credit-units'>". $subjects[$x][1][$z]['credit_units'] ."</td>";
    										echo "<td class='prerequisites'>". $subjects[$x][1][$z]['prerequisites'] ."</td>";
    										echo "</tr>";
    									}
                                    }
								?>
                            </table>
                        </div>

                        <div class="semester-two">
                            <h2>2nd Semester</h2>
                            <table>
                                <tr>
                                    <th class='course-code'>Course Code</th>
                                    <th class='course-name'>Course Description</th>
                                    <th class='credit-units'>Units</th>
                                    <th class='prerequisites'>Prerequisites</th>
                                </tr>
                                <?php 
                                    if(count($subjects) >= $x && count($subjects[$x]) > 1) {
    									for($z = 0; $z < count($subjects[$x][2]); $z++) {
    										echo "<tr>";
    										echo "<td class='course-code'>". $subjects[$x][2][$z]['course_code'] ."</td>";
    										echo "<td class='course-name'>". $subjects[$x][2][$z]['course_name'] ."</td>";
    										echo "<td class='credit-units'>". $subjects[$x][2][$z]['credit_units'] ."</td>";
    										echo "<td class='prerequisites'>". $subjects[$x][2][$z]['prerequisites'] ."</td>";
    										echo "</tr>";
									   }
                                    }
								?>
                            </table>
                        </div>


                <?php if(count($subjects) >= $x && count($subjects[$x]) > 2) { ?>

                            <div class="summer">
                                <h2>Summer</h2>
                                <table>
                                    <tr>
                                        <th class='course-code'>Course Code</th>
                                        <th class='course-name'>Course Description</th>
                                        <th class='credit-units'>Units</th>
                                        <th class='prerequisites'>Prerequisites</th>
                                    </tr>
                                    <?php 
										for($z = 0; $z < count($subjects[$x][3]); $z++) {
											echo "<tr>";
											echo "<td class='course-code'>". $subjects[$x][3][$z]['course_code'] ."</td>";
											echo "<td class='course-name'>". $subjects[$x][3][$z]['course_name'] ."</td>";
											echo "<td class='credit-units'>". $subjects[$x][3][$z]['credit_units'] ."</td>";
											echo "<td class='prerequisites'>". $subjects[$x][3][$z]['prerequisites'] ."</td>";
											echo "</tr>";
										}
									?>
                                </table>
                            </div>

                    <?php } ?>

        </div>
        <?php } ?>
	</div>
</div>

<?php
	require('footer.php');
?>