<?php
	session_start();
	include("link.php");
	
	if(!$_SESSION['user_id']) {
		if ($_SESSION['user_type'] != 0) {
			header("Location: login.php");
			exit;
		}
	} else {
		$id = $_SESSION['user_id'];
		$info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE user_id=$id"));		
		
		$_SESSION['first_name'] = $info['first_name'];
		$_SESSION['user_type'] = $info['user_type'];
		
		// CHECK IF USER IS STUDENT
		if ($info['user_type'] == 1) {
			$_SESSION['is_admin'] = 0;
			$_SESSION['is_prog_coordinator'] = 0;
			$_SESSION['is_moderator'] = 0;
			// Check if Officer
			$is_officer = mysqli_query($connect, "SELECT * FROM organization_officer WHERE student_id='".$info['username']."'");
			if (mysqli_num_rows($is_officer) > 0) {
				$officer_info = mysqli_fetch_assoc($is_officer);
				$_SESSION['org_position'] = $officer_info['position'];
				$_SESSION['is_officer'] = 1;
			} else {
				$_SESSION['is_officer'] = 0;
			}
		}
		
		// CHECK IF USER IS FACULTY
		if ($info['user_type'] == 2) {
			// Check if Chair/Admin
			$is_admin = mysqli_fetch_assoc(mysqli_query($connect, "SELECT is_admin FROM faculty WHERE user_id=$id"));
			if ($is_admin['is_admin'] == 1) {
				$_SESSION['is_admin'] = 1;
				$is_admin = 1;
			} else {	
				$is_admin = 0;
				$_SESSION['is_admin'] = $is_admin;
			}
			// Check if Program Coordinator
			$is_prog_coordinator = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(faculty_id) as ct FROM program_coordinator WHERE faculty_id='".$info['username']."';"));
			if ($is_prog_coordinator['ct'] == 1) {
				$_SESSION['is_prog_coordinator'] = 1;
			} else {
				$_SESSION['is_prog_coordinator'] = 0;
			}
			// Check if Moderator
			$is_moderator = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(faculty_id) as ct FROM moderator WHERE faculty_id='".$info['username']."';"));
			if ($is_moderator['ct'] == 1) {
				$_SESSION['is_moderator'] = 1;
			} else {
				$_SESSION['is_moderator'] = 0;
			}
		}
	}
	require('header.php');
	require('carousel.php');
	require('navbar.php');
?>

	<!--start content(news/events/announcements)-->
	<div class="container">
		<div class="content-wrapper">
			<div class="content">

		<section id="accordion">
			<h1>Welcome to the Department of Computer Science Website</h1>
			<div>
				<input type="checkbox" id="check-1" checked/>
				<label for="check-1">DCS Mission</label>
				<article>
					<p>The Department of Computer Science, regional center of development for excellence in Information Technology education in the Philippines, shall endeavor to, in accordance with the Mission Statement of the College of Computer Studies and Ateneo de Naga University:
						<ul>
							<li>Maintain a world-class and industry-based instruction in ICT and Computer Science education</li>
							<li>Produce globally-competitive graduates with excellent ICT and computing skills</li>
							<li>Promote the growth and development of ICT and computing industry in the Bikol region and the country as a whole</li>
						</ul>
					</p>
				</article>
			</div>
			<div>
				<input type="checkbox" id="check-2" checked/>
				<label for="check-2">DCS Vision</label>
				<article>
					<p>The Department of Computer Science shall constantly be committed to the holistic education of men and women whose lives spent in service to others, shall be most exemplary; whose foremost pursuit of social justice and poverty alleviation in the country, primarily in Bikol region, shall be undaunted; whose excellence as computer scientists, managers of information systems, and information technology experts, shall be indisputable; and whose devotion to God, and to Ina – Our Lady of Peñafrancia – shall be unwavering.</p>
				</article>
			</div>
		</section>
			</div>
		</div>
	</div>
	<!--end content-->

	<!--start footer-->
	<footer>
		<div class="lookWrap">
			<h2>Contact Us</h2>
			<div id="look">
					<div class="contactus">
						<h3>Ateneo de Naga University</h3>
						<p>Ateneo de Naga University<br>
							Ateneo Avenue, 4400 <br>
							Naga City, Philippines<br><br>
							Tel. Nos: Trunkline (63 54) 472-2368<br>
							Fax No: (63 54) 473-9253</p>
					</div>
					<div class="contactus">
						<h3>Department of Computer Science</h3>
						<p>2F Rm P219 Phelan Building <br>
							Ateneo de Naga University <br>
							Ateneo Avenue, 4400 <br>
							Naga City, Philippines <br><br>
							Email: dcs@adnu.edu.ph <br>
							Phone: 054 472 2368 ext 2422 </p>
					</div>

				</div>
			</div>
		</div>
		<div class="legality">
			&copy; Copyright 2016 by Your Company
		</div>
	</footer>
	<!--end footer-->
</body>
<script type="text/javascript">
	$(window).scroll(function() {
		var x = window.pageYOffset;
		if(x > 450){
			$('.nav').addClass("fixed"); //make position fixed instead of absolute
		} else {
			$('.nav').removeClass("fixed") ;//clear styles if back to original position
		}
	});
</script>
<html>
