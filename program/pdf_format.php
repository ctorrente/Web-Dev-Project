<html>
	<head>
		<style type="text/css">
			body,
	        div,
	        table,
	        b {
	            font-size: 9px;
	        }
	        table {
	        	width: 100%;
			}
			.program-info-container {
				width: 80%;
				margin: 0% 10% 5% 10%;
			}

			.course-table {
				width: 80%;
				margin: auto;
			}

			.course-table th, .course-table td {
				text-align: left;
			}

			.semester-container {
				width: 100%;
			}

			.semester-one {
			    width: 100%;
			}

			.semester-two {
			    width: 100%;
			}

			.summer {
			    width: 80%;
			}

			.course-code {
			    width: 20%;
			    text-align: center;
			}

			.course-name {
			    width: 50%;
			}

			.credit-units {
			    text-align: center;
			    width: 5%;
			}

			.prerequisites {
			    text-align: center;
			    width: 25%;
			}
			.header {
			    text-align: center;
			}
			.division {
			    width: 50%;
			}
		</style>
	</head>
<body>
<?php
	require('connection.php');
	// require('header.php');
	// require('navbar.php');
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
<div class="header">
        Ateneo de Naga University
        <br> College of Computer Studies
        <br> <?php echo $program['program_name'] ?>
        <br> Curriculum year: <?php echo $curriculum_year; ?>
    </div>
    <br>
<?php 
	for($x = 1; $x <= 4; $x++) {
?>
<br><br>
<div class="semester-container">
    <b>
		<?php
			if($x == 1)
				echo "1st Year";
			else if($x == 2)
				echo "2nd Year";
			else if($x == 3)
				echo "3rd Year";
			else
				echo "4th Year";
		?>
	</b>
    <table>
        <tr>
            <td class="division">
                <div class="semester-one">
                    1st Semester
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
            </td>
            <td class="division">
                <div class="semester-two">
                    2nd Semester
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
            </td>
        </tr>
        <?php if(count($subjects) >= $x && count($subjects[$x]) > 2) { ?>
            <tr>
                <td colspan="2" style="width: 100%">
                    <div class="summer">
                        Summer
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
                </td>
            </tr>
            <?php } ?>
    </table>
</div>
<?php } ?>
</body>
</html>