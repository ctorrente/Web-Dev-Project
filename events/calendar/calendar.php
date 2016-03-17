<?php
	session_start();
	include("link.php");
	
	// if(!$_SESSION['user_id']) {
		// if ($_SESSION['user_type'] != 0) {
			// header("Location: login.php");
			// exit;
		// }
	// } else {
		// $id = $_SESSION['user_id'];
		// $info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE user_id=$id"));		
		
		// $_SESSION['first_name'] = $info['first_name'];
		// $_SESSION['user_type'] = $info['user_type'];
		// $_SESSION['user_id']= $info['user_id'];
	// }
	require('header.php');
	require('navbar.php');
?>

<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="functionalities/css/contactus.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/navbar-footer.css">
		<link rel="stylesheet" href="css/carousel.css">
		<link rel="stylesheet" href="css/calendar.css">
		
		<!-- <link rel="stylesheet" href="../jquery-timepicker/jquery.timepicker.css">
		<link rel="stylesheet" href="../jquery-timepicker/lib/bootstrap-datepicker.css">
		<link rel="stylesheet" href="../jquery-timepicker/lib/site.css"> -->
		
		<link href='../fullcalendar.css' rel='stylesheet' />
		<link href='../jquery-ui-themes-1.11.4/themes/start/jquery-ui.css' rel='stylesheet' />
		<link href='../fullcalendar.print.css' rel='stylesheet' media='print' />

		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/script.js"></script>
		<script src="js/home.js"></script>
		
		<script src='../lib/moment.min.js'></script>
		<script src='../jquery-1.12.0.min.js'></script>
		<script src='../fullcalendar.min.js'></script>
		<script src='../jquery-ui-1.11.4/jquery-ui.js'></script>
		<script src='../jquery-ui-1.11.4/jquery-ui.min.js'></script>
		<script src='../jquery-dateFormat.js'></script>
		<script src='../moment.js'></script>
		
		<!-- <script src='../jquery-timepicker/jquery.timepicker.js'></script>
		<script src='../jquery-timepicker/lib/bootstrap-datepicker.js'></script>
		<script src='../jquery-timepicker/lib/site.js'></script> -->
		
		<title>Adnu DCS</title>

		<style type="text/css">
		
		#calendar {
			max-width: 900px;
			margin: 0 auto;
		}
		
		button {
			background: none;
			border: 1px solid #A9A9A9;
			border-radius: 8px;
			padding: 5px;
			color: #A9A9A9;
			outline: none;
		}
		button:hover {
			color: white;
			background: #2062a2;
			border: 1px solid #2062a2;
		}
		<!-- #delete {
			float: right;
		}
		
		#confDelete {
			float: right;
		} -->
		
		.title {
			width: 265px;
		}
		.fc-event-time{
			display : none;
		}
		.fc-time{
			display : none;
		}
		
		</style>
	</head>
<body>
<!--
<div class="toplogo">
	<a href='#'><img src="css/temp/dcs-sign.png" /></a>
</div>
-->
<!--start navbar-->
<!--
<div class="nav">
	<div class="container">
		<div id='cssmenu'>
			<ul>
				<li><a href='#'>About</a></li>
				<li><a href='#'>Admission</a></li>
				<li><a href='#'>Faculty</a></li>
				<li><a href='#'>Policies</a></li>

				<li class='has-sub'><a href='#'>User</a>
					<ul>
						<li><a href='#'>Log Out</a></li>
						 <li class='has-sub'><a href='eventstable.html'>View Pending Events</a></li>
						 <li class='has-sub'><a href='#'>Option 1</a>
							<ul>
								 <li><a href='#'>Sub Option 1</a></li>
								 <li><a href='#'>Sub Option 2</a></li>
							</ul>
						 </li>
					</ul>
				</li>
				<li class="msg"><a data-toggle="open-modal" data-target="#contact">&#9993;</a></li>
				<li class="msg">
					<input type="search" placeholder="&#x1f50e; Search" /></li>

			</ul>
		</div>
	</div>
</div>
-->
<!--end navbar-->

	<!--start content-->
	<div class="container" style="margin-top: 94px;">
		<div class="content-wrapper">
			<div class="content">

			

			<!--start calendar-->
<div class="calendar-container">
    
	<div id="eventContent" title="Event Details" style="display:none;">
		<div id="eventDate"></div><br>
		Description: <span id="eventInfo"></span><br><br>
		<button id="edit">Edit >></button>
		<button id="delete">Delete</button> 
	</div>
	
	<div id="addEventContent" title="Add Event" style="display:none;">
		<form method="post" action="<?php 
					if ($_SESSION['user_type']==5)
						echo "eventstable_off.php";
					else
						echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
			When:<span id="addEventStart"></span><br><br>
			Title: <input type="text" id="title" name="title" class="text ui-widget-content ui-corner-all title" required><br><br>
			Description:<textarea id="desc" name="desc" rows="3" class="text ui-widget-content ui-corner-all"></textarea><br><br>
			<!-- Time: <input type="text" id="startTime"> -->
			<input type="submit" id="createEvent" value="Create Event"><br>
		</form>
	</div>
	
	<div id="deleteEventContent" title="Delete Event" style="display:none;">
		<form action="<?php echo $_SERVER['PHP_SELF']?>">
		Are you sure you want to delete this event?<br><br>
		<span><button id='confDelete'>Yes</button> <button id='cancelDelete'>Cancel</button></span>
		</form>
	</div>
	
	<div id="editEventContent" title="Edit Event" style="display:none;">
		<form method="post" name ="edit" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
			Title: <input type="text" id="editTitle" name="title" class="text ui-widget-content ui-corner-all title" required><br><br>
			Description:<textarea id="editDesc" name="desc" rows="3" class="text ui-widget-content ui-corner-all"></textarea><br><br>
			<input type="submit" id="editEvent" value="Save"><br>
		</form>
	</div>
	
	<div id="usertype" style="display:none;"><?php echo $_SESSION['user_type']; ?></div>
	
	<div id='calendar'></div>
	
</div>

			<!--end calendar-->

			</div>
		</div>
	</div>
	<!--end content-->

	<!--start footer-->
	<footer>
		<div class="lookWrap">
			<a><h2>Contact Us</h2></a>
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
	var user = (document.getElementById("usertype")).innerHTML;
	if (user != "6" && user != "7" && user != "8") {
		$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				selectable: true,
				selectHelper: true,
				editable: true,
				select: function(start, end) {
					var start2 = start;
					var end2 = end;
					var duration = moment.duration(end.diff(start));
					var hours = duration.asHours();
					var endDate = $.format.date(end.toString(), "d");
					var intEndDate = parseInt(endDate)-1;
					if (hours > 24)
						$("#addEventStart").html(" " + $.format.date(start.toString(), "MMM d") + " to " + $.format.date(end.toString(), "MMM ") + intEndDate);
					else
						$("#addEventStart").html(" " + $.format.date(start.toString(), "MMM d"));
					$("#addEventContent").dialog({ modal: true, width:350});
					$("#createEvent").click(function(){
						var title = $('#title').val();
						var desc = $('#desc').val();
						if (title) {
							var duration = moment.duration(end2.diff(start2));
							var hours = duration.asHours();
							if (hours <= 24)
								end2 = start2;
							var start = moment(start2).format('YYYY-MM-DD');
							var end = moment(end2).format('YYYY-MM-DD');
							$.ajax({
								url: 'addEvents.php',
								data: 'title='+title+'&desc='+desc+'&start='+start+'&end='+end+'&sub='+user,
								type: 'POST',
								dataType: 'text',
								success: function(json) {
									alert("Added successfully!");
								}
							});
						}
					});
				},
				eventLimit: true, // allow "more" link when too many events
				events: 'addedEvents.php',
				eventRender: function (event, element) {
					element.attr('href', 'javascript:void(0);');
					element.click(function() {
						if (event.end)
							$("#eventDate").html($.format.date(event.start.toString(), "MMM d") + " till " + $.format.date(event.end.toString(), "MMM d") );
						else
							$("#eventDate").html($.format.date(event.start.toString(), "MMM d ddd"));
						$("#eventInfo").html(event.desc);
						$("#eventContent").dialog({ modal: true, title: event.title, width:350});
						$('#edit').click(function(){
							$("#editEventContent").dialog({ modal: true, width:350});
							$("#editTitle").val(event.title);
							$("#editDesc").val(event.desc);
						});
						$("#editEvent").click(function(){
							var title = $('#editTitle').val();
							var desc = $('#editDesc').val();
							$.ajax({
								url: 'editEvents.php',
								data: 'id='+event.id+'&title='+title+'&desc='+desc,
								type: 'POST',
								dataType: 'text',
								success: function(json) {
									alert("Updated Successfully!");
								}
							});
						});
						$('#delete').click(function(){
							$("#deleteEventContent").dialog({ modal: true, width:350});
						});
						$('#confDelete').click(function(){
							$.ajax({
								url: 'deleteEvents.php',
								data: 'id='+event.id,
								type: 'POST',
								dataType: 'text',
								success: function (json) {
									$("#eventContent").dialog("close");
									$("#deleteEventContent").dialog("close");
								}
							});
						});
						$('#cancelDelete').click(function(){
							$("#eventContent").dialog("close");
							$("#deleteEventContent").dialog("close");
						});
					});
				}
			});
		});
	}
	else {
		$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				eventLimit: true, 
				events: 'addedEvents.php'
			});
		});
	}
	
</script>

<html>