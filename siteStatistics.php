<!DOCTYPE html>
<html>
<head><title>Site Statistics</title></head>
<body>


<?php
			session_start();
			require('header.php');
			echo "<br><br>";
			require('navbar.php');
			echo "<br><br><br><br><br>";
			echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>';
			echo '<script src="https://code.highcharts.com/highcharts.js"></script>';
			echo '<script src="https://code.highcharts.com/modules/data.js"></script>';
			echo '<script src="https://code.highcharts.com/modules/exporting.js"></script>';
			/*
				Site Statistics Module

				@Authors:
					Maiko Franisco Rugeria
					Jan Brian Despi
					Michael Romero
					Christian Lizardo
			*/

			//--------------------------------------------------Functions---------------------------------------------------
			/*
				This function counts all the users registered
				in the system. Users include faculty members
				and students.

				@parameters: None
				@return: None
			*/
?>
	<div class="container" style="margin-top: -50px;">
		<div class="content-wrapper">
			<div class="content" >
	<?php
			function countUsers()
			{
				$usercount_sql = "SELECT COUNT(*) as userCount FROM users";
				$usercount_result = mysqli_query($GLOBALS["conn"], $usercount_sql);
				if (mysqli_num_rows($usercount_result) > 0)
				{
				    $row = mysqli_fetch_assoc($usercount_result);
				    $usercount_value = $row["userCount"];
		    	}

				echo "Number of Users: " . $usercount_value . "<br>";

				$dateStamp_users = date("Ymd");
		    	$insertUsercount_sql = "INSERT INTO users_statistics (`value`, `date`) values (" . $usercount_value .  ", " . $dateStamp_users . ")";
				$insertUsercount_result = mysqli_query($GLOBALS["conn"], $insertUsercount_sql);
			}

			/*
				This function counts all the users that are
				registered as students.

				@parameters: None
				@return: None
			*/
			function countStudents()
			{
				$studentcount_sql = "SELECT COUNT(*) as studentCount FROM students";
				$studentcount_result = mysqli_query($GLOBALS["conn"], $studentcount_sql);
				if (mysqli_num_rows($studentcount_result) > 0)
				{
				    $row = mysqli_fetch_assoc($studentcount_result);
				    $studentcount_value = $row["studentCount"];
		    	}

				echo "Number of Students: " . $studentcount_value . "<br>";

				$dateStamp_students = date("Ymd");
				$insertStudentcount_sql = "INSERT INTO students_statistics (`value`, `date`) values (" . $studentcount_value .  ", " . $dateStamp_students . ")";
				$insertStudentcount_result = mysqli_query($GLOBALS["conn"], $insertStudentcount_sql);
			}

			/*
				This function counts all the users that are
				registered as faculty.

				@parameters: None
				@return: None
			*/
			function countFaculty()
			{
				$facultycount_sql = "SELECT COUNT(*) as facultyCount FROM faculty";
				$facultycount_result = mysqli_query($GLOBALS["conn"], $facultycount_sql);
				if (mysqli_num_rows($facultycount_result) > 0)
				{
				    $row = mysqli_fetch_assoc($facultycount_result);
				    $facultycount_value = $row["facultyCount"];
		    	}

				echo "Number of Faculty Members: " . $facultycount_value . "<br>";

				$dateStamp_faculty = date("Ymd");
				$insertFacultycount_sql = "INSERT INTO faculty_statistics (`value`, `date`) values (" . $facultycount_value .  ", " . $dateStamp_faculty . ")";
				$insertFacultycount_result = mysqli_query($GLOBALS["conn"], $insertFacultycount_sql);
			}

			/*
				This function counts all the news that are
				posted on the site.

				@parameters: None
				@return: None
			*/
			function countNews()
			{
				$newscount_sql = "SELECT COUNT(*) as newsCount FROM news";
				$newscount_result = mysqli_query($GLOBALS["conn"], $newscount_sql);
				if (mysqli_num_rows($newscount_result) > 0)
				{
				    $row = mysqli_fetch_assoc($newscount_result);
				    $newscount_value = $row["newsCount"];
		    	}

				echo "Number of News Posted: " . $newscount_value . "<br>";

				$dateStamp_news = date("Ymd");
				$insertNewscount_sql = "INSERT INTO news_statistics (`value`, `date`) values (" . $newscount_value .  ", " . $dateStamp_news . ")";
				$insertNewscount_result = mysqli_query($GLOBALS["conn"], $insertNewscount_sql);
			
			}

			/*
				This function counts all the events that are
				posted on the site.

				@parameters: None
				@return: None
			*/
			function countEvents()
			{
				$eventcount_sql = "SELECT COUNT(*) as eventCount FROM event";
				$eventcount_result = mysqli_query($GLOBALS["conn"], $eventcount_sql);
				if (mysqli_num_rows($eventcount_result) > 0)
				{
				    $row = mysqli_fetch_assoc($eventcount_result);
				    $eventcount_value = $row["eventCount"];
		    	}

				echo "Number of Events Posted: " . $eventcount_value . "<br>";

				$dateStamp_events = date("Ymd");
				$insertEventcount_sql = "INSERT INTO event_statistics (`value`, `date`) values (" . $eventcount_value .  ", " . $dateStamp_events . ")";
				$insertEventcount_result = mysqli_query($GLOBALS["conn"], $insertEventcount_sql);
			}

			/*
				This function counts all advisers and
				all advisees assigned to them

				@parameters: None
				@return: None
			*/
			function countAdvisees()
			{
				echo "<h3>Advisers Statistics</h3>";

				$advisers_sql = "SELECT * from faculty WHERE status=0";
				$advisers_result = mysqli_query($GLOBALS["conn"], $advisers_sql);
				if (mysqli_num_rows($advisers_result) > 0)
				{
					echo "<table id='advisees'>";
					echo "<tr>";
					echo "<th>Adviser</th>";
					echo "<th>Number of Advisees</th>";
					echo "</tr>";

					while($row_adviser = mysqli_fetch_assoc($advisers_result))
					{
						$getNames_sql = "SELECT first_name, last_name from users WHERE username='" . $row_adviser["faculty_id"] . "'";
						$getNames_result = mysqli_query($GLOBALS["conn"], $getNames_sql);
						if(mysqli_num_rows($getNames_result) > 0)
						{
							while($row_user = mysqli_fetch_assoc($getNames_result))
							{
								echo "<tr>";
								echo "<tr>";
								echo "<td>" . $row_user["last_name"] . ", " . $row_user["first_name"] . "</td>";

								$advisees_sql = "SELECT COUNT(*) as adviseeCount from students WHERE adviser_id='" . $row_adviser["faculty_id"] . "'";
								$advisees_result = mysqli_query($GLOBALS["conn"], $advisees_sql);
								if(mysqli_num_rows($advisees_result) > 0)
								{
									$row_advisee = mysqli_fetch_assoc($advisees_result);
									echo "<td>" . $row_advisee["adviseeCount"] . "</td>";
								}
								else
								{
									echo "<td>Not an adviser</td>";
								}

								echo "</tr>";
							}
						}
					}

					echo "</table>";
				}
				else
				{
					echo "0 Results<br>";
				}
			}

			/*
				This function fetches the 5 most recent
				statistics from the user_statistics table

				@parameters: None
				@return: None
			*/
			function fetchUSerStatistics()
			{
				echo "<h3>User Statistics</h3>";
				echo "<table id='users'>";
				echo "<tr>";
				echo "<th>DATE</th>";
				echo "<th>VALUE</th>";
				echo "</tr>";

				$fetch_userStatistics_sql = "SELECT * FROM users_statistics ORDER BY date DESC LIMIT 10";
				$fetch_userStatistics_result = mysqli_query($GLOBALS["conn"], $fetch_userStatistics_sql);
				if (mysqli_num_rows($fetch_userStatistics_result) > 0)
				{
					while ($row = mysqli_fetch_assoc($fetch_userStatistics_result))
					{
						echo "<tr>";
						echo "<td>" . $row["date"] .  "</td>";
						echo "<td>" . $row["value"] . "</td>";
						echo "</tr>";
					}
				}

				echo "</table><br>";
			}

			/*
				This function fetches the 5 most recent
				statistics from the student_statistics table

				@parameters: None
				@return: None
			*/
			function fetchStudentStatistics()
			{
				echo "<h3>Student Statistics</h3>";
				echo "<table id='students'>";
				echo "<tr>";
				echo "<th>DATE</th>";
				echo "<th>VALUE</th>";
				echo "</tr>";

				$fetch_studentStatistics_sql = "SELECT * FROM students_statistics ORDER BY date DESC LIMIT 10";
				$fetch_studentStatistics_result = mysqli_query($GLOBALS["conn"], $fetch_studentStatistics_sql);
				if (mysqli_num_rows($fetch_studentStatistics_result) > 0)
				{
					while ($row = mysqli_fetch_assoc($fetch_studentStatistics_result))
					{
						echo "<tr>";
						echo "<td>" . $row["date"] .  "</td>";
						echo "<td>" . $row["value"] . "</td>";
						echo "</tr>";
					}
				}

				echo "</table><br>";
			}

			/*
				This function fetches the 5 most recent
				statistics from the faculty_statistics table

				@parameters: None
				@return: None
			*/
			function fetchFacultyStatistics()
			{
				echo "<h3>Faculty Statistics</h3>";
				echo "<table id='faculty'>";
				echo "<tr>";
				echo "<th>DATE</th>";
				echo "<th>VALUE</th>";
				echo "</tr>";

				$fetch_facultyStatistics_sql = "SELECT * FROM faculty_statistics ORDER BY date DESC LIMIT 10";
				$fetch_facultyStatistics_result = mysqli_query($GLOBALS["conn"], $fetch_facultyStatistics_sql);
				if (mysqli_num_rows($fetch_facultyStatistics_result) > 0)
				{
					while ($row = mysqli_fetch_assoc($fetch_facultyStatistics_result))
					{
						echo "<tr>";
						echo "<td>" . $row["date"] .  "</td>";
						echo "<td>" . $row["value"] . "</td>";
						echo "</tr>";
					}
				}

				echo "</table><br>";
			}

			/*
				This function fetches the 5 most recent
				statistics from the event_statistics table

				@parameters: None
				@return: None
			*/
			function fetchEventStatistics()
			{
				echo "<h3>Event Statistics</h3>";
				echo "<table id='events'>";
				echo "<tr>";
				echo "<th>DATE</th>";
				echo "<th>VALUE</th>";
				echo "</tr>";

				$fetch_eventStatistics_sql = "SELECT * FROM event_statistics ORDER BY date DESC LIMIT 10";
				$fetch_eventStatistics_result = mysqli_query($GLOBALS["conn"], $fetch_eventStatistics_sql);
				if (mysqli_num_rows($fetch_eventStatistics_result) > 0)
				{
					while ($row = mysqli_fetch_assoc($fetch_eventStatistics_result))
					{
						echo "<tr>";
						echo "<td>" . $row["date"] .  "</td>";
						echo "<td>" . $row["value"] . "</td>";
						echo "</tr>";
					}
				}

				echo "</table><br>";
			}

			function fetchNewsStatistics()
			{
				echo "<h3>News Statistics</h3>";
				echo "<table id='news'>";
				echo "<tr>";
				echo "<th>DATE</th>";
				echo "<th>VALUE</th>";
				echo "</tr>";

				$fetch_newsStatistics_sql = "SELECT * FROM news_statistics ORDER BY date DESC LIMIT 10";
				$fetch_newsStatistics_result = mysqli_query($GLOBALS["conn"], $fetch_newsStatistics_sql);
				if(mysqli_num_rows($fetch_newsStatistics_result) > 0)
				{
					while($row = mysqli_fetch_assoc($fetch_newsStatistics_result))
					{
						echo "<tr>";
						echo "<td>" . $row["date"] .  "</td>";
						echo "<td>" . $row["value"] . "</td>";
						echo "</tr>";
					}
				}

				echo "</table><br>";
			}

			function fetchVisitStatistics()
			{
				echo "<hr>";
				echo "<h3>Site Visits</h3>";
				echo "<hr>";
				echo "<table id='visits'>";
				echo "<tr>";
				echo "<th>DATE</th>";
				echo "<th>VALUE</th>";
				echo "</tr>";

				$fetch_visitStatistics_sql = "SELECT * FROM visit_statistics ORDER BY date DESC LIMIT 10";
				$fetch_visitStatistics_result = mysqli_query($GLOBALS["conn"], $fetch_visitStatistics_sql);
				if(mysqli_num_rows($fetch_visitStatistics_result) > 0)
				{
					while($row = mysqli_fetch_assoc($fetch_visitStatistics_result))
					{
						echo "<tr>";
						echo "<td>" . $row["date"] .  "</td>";
						echo "<td>" . $row["value"] . "</td>";
						echo "</tr>";
					}
				}

				echo "</table><br>";
			}
			
			function fetchCurriculumDownloadStatistics()
			{
				echo "<hr>";
				echo "<h3>Curriculum Downloads</h3>";
				echo "<hr>";
				echo "<table id='curr_downloads'>";
				echo "<tr>";
				echo "<th>CURRICULUM YEAR</th>";
				echo "<th>DOWNLOADS</th>";
				echo "</tr>";

				$curr_downloads_sql = "SELECT p.program_code AS code, c.curriculum_year AS curriculum, d.download_count_value AS downloads FROM curriculum_downloads d, curriculum c, program p WHERE c.curriculum_id = d.curriculum_id AND c.program_id = p.program_id;";
				$curr_downloads_result = mysqli_query($GLOBALS["conn"], $curr_downloads_sql);
				if(mysqli_num_rows($curr_downloads_result) > 0)
				{
					while($row = mysqli_fetch_assoc($curr_downloads_result))
					{
						echo "<tr>";
						echo "<td>" . $row['code'] . " " . $row['curriculum'] .  " Curriculum</td>";
						echo "<td>" . $row['downloads'] . "</td>";
						echo "</tr>";
					}
				}

				echo "</table><br>";
			}
			//--------------------------------------------------Connect DB---------------------------------------------------
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "dcs_project";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			//--------------------------------------------------Main Program---------------------------------------------------
			//Count/Update Statistics
			echo "<div style='margin:0 auto; text align: center;'>";
			countUsers(); 
			countStudents(); 
			countFaculty(); 
			countNews(); 
			countEvents(); 
			countAdvisees();

			//Fetch Statistics
			fetchUSerStatistics();
			fetchStudentStatistics();
			fetchFacultyStatistics();
			fetchEventStatistics();
			fetchNewsStatistics();
			fetchVisitStatistics();
			fetchCurriculumDownloadStatistics();
			echo "<div>";

		?>

		<div id="container1"></div>
		<div id="container2"></div>
		<div id="container3"></div>
		<div id="container4"></div>
		<div id="container5"></div>
		<div id="container6"></div>
		<div id="container7"></div>

		<script>
            $(function () {
                $('#container1').highcharts({
                    data: {
                        table: 'users'
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of Users'
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Value'
                        }
                    },
                    xAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Date Updated'
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                this.point.y + ' ' + this.point.name.toLowerCase();
                        }
                    }
                });
            });

			$(function () {
                $('#container2').highcharts({
                    data: {
                        table: 'students'
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of Students'
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Value'
                        }
                    },
                    xAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Date Updated'
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                this.point.y + ' ' + this.point.name.toLowerCase();
                        }
                    }
                });
            });

			$(function () {
                $('#container3').highcharts({
                    data: {
                        table: 'faculty'
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of Faculty'
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Value'
                        }
                    },
                    xAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Date Updated'
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                this.point.y + ' ' + this.point.name.toLowerCase();
                        }
                    }
                });
            });

			$(function () {
                $('#container4').highcharts({
                    data: {
                        table: 'events'
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of Events'
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Value'
                        }
                    },
                    xAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Date Updated'
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                this.point.y + ' ' + this.point.name.toLowerCase();
                        }
                    }
                });
            });

			$(function () {
                $('#container5').highcharts({
                    data: {
                        table: 'news'
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of News'
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Value'
                        }
                    },
                    xAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Date Updated'
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                this.point.y + ' ' + this.point.name.toLowerCase();
                        }
                    }
                });
            });
			
			$(function () {
                $('#container6').highcharts({
                    data: {
                        table: 'visits'
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of Visits'
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Value'
                        }
                    },
                    xAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Date Updated'
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                this.point.y + ' ' + this.point.name.toLowerCase();
                        }
                    }
                });
            });

			$(function () {
                $('#container7').highcharts({
                    data: {
                        table: 'curr_downloads'
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Number of Downloads'
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Value'
                        }
                    },
                    xAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Curriculum'
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.series.name + '</b><br/>' +
                                this.point.y + ' ' + this.point.name.toLowerCase();
                        }
                    }
                });
            });
        </script>
</div>
</div>
</div>
	</body>
</html>