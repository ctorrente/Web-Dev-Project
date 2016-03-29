<?php
	/**
 		* File Description: DCS site add news page-this will add a news in the database.
 		* @version 2.0
		* @authors Eric Rosales, Charles Torrente
	*/

	include('functions.php');
	include('connection.php');

	if(isset($_SESSION['is_officer'])) {
		if($_SESSION['is_officer'] == 1) 
			$approved = 0;
	} else {
		$approved = 1;
	}
	
	if(isset($_POST['post'])){
		$title = $_POST['title'];
		$details = $_POST['details'];
		$file_size = $_FILES['picture']['size'];
		$file_name = $_FILES['picture']['name'];
		$file_ext = strtolower(pathinfo($file_name ,PATHINFO_EXTENSION));
		$user_id = $_SESSION['user_id'];
		
		$allowedExt = array('gif', 'jpeg', 'jpg', 'png');
		if(in_array($file_ext, $allowedExt) && $file_size < 5000000){

			$totalPictures = getTotalPictures($conn);
			$totalPictures += 1;
			$file_name = $totalPictures . '.' . $file_ext;
			//echo $file_name;
			$file_path = 'newsPictures/' . $file_name;
			//echo $file_path;
			$query = 'insert into picture(picture_id, file_name, file_path) values('. "$totalPictures, '$file_name'," . "'$file_path'" . ')';
			$exec = mysqli_query($conn, $query);
			//echo $query;
			$query = "";
			$faculties = (!isset($_POST['faculties']))?0:1;
			$students = (!isset($_POST['students']))?0:1;
			$alumnus = (!isset($_POST['alumnus']))?0:1;
			$guests = (!isset($_POST['guests']))?0:1;

			$date = date('Y/m/d h:i:s a');
			if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3)
				$query = "insert into news(user_id, picture_id, title, details, date_posted, faculties, students, alumnus, guests, is_approved, user_type) 
			VALUES(" . $user_id . ", " . $totalPictures . ", '" . $title . "', '" . $details . "', '$date', $faculties, $students, $alumnus, $guests, 1, 9)";
			if($_SESSION['user_type'] == 5)
				$query = "insert into news(user_id, picture_id, title, details, date_posted, faculties, students, alumnus, guests, is_approved, user_type) 
			VALUES(" . $user_id . ", " . $totalPictures . ", '" . $title . "', '" . $details . "', '$date', $faculties, $students, $alumnus, $guests, 0, 9)";
			//echo $query;
			$exec = mysqli_query($conn, $query);
			
			move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
			echo "<script type='text/javascript'>alert('News Added!')</script>";
			echo "<script>setTimeout(\"location.href = 'viewallnews.php';\",100);</script>";
		
		}else{
			echo '<script type="text/javascript">alert("Invalid File")</script>';
		}
	}
?>

<html>
	<script type="text/javascript">
		function logout(){
			var logoutForm = document.getElementById("logoutForm");
			logoutForm.logout = 1;
			logoutForm.submit();
		}
	</script>
	<form action="login.php" method="POST" id="logoutForm">
		<input type="hidden" name="logout" value="">
	</form>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="functionalities/css/contactus.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/navbar-footer.css">
		<link rel="stylesheet" href="css/carousel.css">
		<link rel="stylesheet" href="css/events.css">
		<link rel="stylesheet" href="css/addevent.css">

		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/script.js"></script>
		<script src="js/home.js"></script>
		

		<title>Adnu DCS</title>

	</head>
<body>
<div class="toplogo">
	<a href='home.php'><img src="css/temp/dcs-sign.png" /></a>
</div>

<!--start navbar-->
<?php require('navbar.php'); ?>

<!--ADD NEWS FORM-->
<div class="container">
	<div class="content-wrapper" >
		<div class="content">
			<form class="addeve" enctype="multipart/form-data" method="POST" action="addNews.php">
				<h1>Add News</h1>
				<input type="text" name="title" placeholder="Title" required>
				<input type="file" name="picture" placeholder="Browse" required>
				<textarea name="details" placeholder="Details" required></textarea>
				<h3>Who can view this news?</h3>
				<center>
				<div class="bla" >
					<input type="checkbox" name="faculties" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Faculties
					<input type="checkbox" name="students" value="1" style="-webkit-appearance: checkbox; width: 20px; "> Students
					<input type="checkbox" name="alumnus" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Alumnus
					<input type="checkbox" name="guests" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Guests
				</div>
				</center>
				<input type="submit" name="post" value="Post">
			</form>
		</div>
	</div>
</div>

<footer>
	<div class="lookWrap" >
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
	<div class="legality">
		&copy; Copyright 2016 by Your Company
	</div>
</footer>
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
