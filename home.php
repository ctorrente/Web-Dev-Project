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
	<div class="container" style="margin-top: 94px;">
		<div class="content-wrapper">
			<div class="content">
				<div class="news">
					<h1>NEWS</h1>
					<p class="desc-text">
						<div class="postdate">
							<div class="month m-06">Jun</div>
							<div class="day d-30">30</div> 
							<div class="year y-2009">2009</div> 
						</div>
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.asdasdkasdjkasndjkasdjbasdbasjkdbasjkdbjkasbdkasbdbkjasd

					</p>
					<ul class="controls">
						<li>
							<p>View All</p>
						</li>
					</ul>
				</div>
			</div>
			<div id="annevecon">

				<div class="events">
					<h1>EVENTS</h1>
					<p class="desc-text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.asdasdkasdjkasndjkasdjbasdbasjkdbasjkdbjkasbdkasbdbkjasd</p>
					<ul class="controls">
						<li>
							<p>View All</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--end content-->

	<!--start footer-->
	<footer>
		<div class="lookWrap">
			<a class="btn btn-lg btn-success js-modal" href="#" role="button" data-toggle="modal" data-target="#demoModal"><h2>Contact Us</h2></a>
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
	<div class="modal" id="contact">
		<div class="contactpop">
			<form class="contact-form">
				<div class="name">
					<input type="text" id="name" placeholder="Full Name"/>
				</div>  
				<div class="email">
					<input type="email" id="email" placeholder="Email"/>
				</div>
				<div class="message">
					<textarea name="message" id="message" placeholder="Message"></textarea>
				</div>
				<div class="submit">
					<input type="submit" value="Send" class="button" />
				</div>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(window).scroll(function() {
		var x = window.pageYOffset;
		if(x > 250){
			$('.nav').addClass("fixed"); //make position fixed instead of absolute
		} else {
			$('.nav').removeClass("fixed") ;//clear styles if back to original position
		}
	});

	$("*").click(function(){
		var button = $(this);
		if(button.data('toggle') == "open-modal") {
			var target = button.data('target');
			$('body').append('<div class="modal-backdrop"></div>');
			$('.modal').css("overflow-y", "auto");
			$('html').css("overflow", "hidden");
			$('.modal-backdrop').fadeIn("fast");
			$(target).fadeIn("fast");
		}
	});
</script>
<html>
