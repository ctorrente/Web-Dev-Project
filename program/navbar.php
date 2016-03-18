<!--start navbar-->
<?php
	session_start();
?>
<div class="nav">
	<div class="container">
		<div id='cssmenu'>
			<ul>
				<li><a href='../home.php'>Home</a></li>
				<?php 
					if($_SESSION['user_type'] != 1 || $_SESSION['is_officer'] == 1){
						echo '<li class="has-sub" style="float: left;"><a href="viewAllNews.php">News</a>' . 
							'<ul>' . 
								'<li><a href="viewAllNews.php">All News</a></li>' . 
								'<li><a href="forFaculties.php">For faculties</a></li>' . 
								'<li><a href="forOrgOfficers.php">For org. officers</a></li>' . 
								'<li><a href="forStudents.php">For students</a></li>' . 
								'<li><a href="forAlumnus.php">For alumnus</a></li>' . 
								'<li><a href="forGuests.php">For guests</a></li>' . 
							'</ul>'.
						'</li>';
					}else
						echo '<li><a href="../news/viewAllNews.php">News</a></li>';
				?>
			<?php 
					if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 5){
						echo '<li class="has-sub" style="float: left;"><a href="../events/calendar/calendar.php">Events</a>' . 
							'<ul>' . 
								'<li><a href="../events/calendar/eventstable_off.php">Manage Events</a></li>' . 
							'</ul>'.
						'</li>';
					}else if($_SESSION['user_type'] == 6 || $_SESSION['user_type'] == 7 || $_SESSION['user_type'] == 8){
						'<li class="has-sub" style="float: left;"><a href="../events/calendar/calendar.php">Events</a>' . 
							'<ul>' . 
								'<li><a href="../events/calendar/eventstable_mod.php">Events for Approval</a></li>' . 
							'</ul>'.
						'</li>';
					}
				?>
				<li><a href='course_list.php'>Courses</a></li>
				<li><a href='program_list.php'>Programs</a></li>
				<?php if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 5) {
					echo "<li><a href='../sitestatistics.php'>Statistics</a></li>";
				} ?>

				<li class='has-sub'><a href='../profile.php'><?php echo $_SESSION['first_name'];?></a>
					<ul>
						<li><a href='../logout.php'>Log Out</a></li>
						<?php if ($_SESSION['is_admin'] == 1) {
							echo "<li class='has-sub'><a>Faculty</a>";
								echo "<ul>";
									 echo "<li><a href='../faculty.php'>View Faculty</a></li>";
									 echo "<li><a href='../addfaculty.php'>Add Faculty</a></li>";
								echo "</ul>";
							 echo "</li>";
							 echo "<li class='has-sub'><a>Students</a>";
								echo "<ul>";
									echo "<li><a href='../students.php'>View Students</a></li>";
									echo "<li><a href='../addstudent.php'>Add Students</a></li>";
								echo "</ul>";
							echo "</li>";
						} ?>
					</ul>
				</li>
				<li class="msg">
					<input type="search" placeholder="&#x1f50e; Search" /></li>

			</ul>
		</div>
	</div>
</div>

<!--end navbar-->