<?php
	include('functions.php');
	include('connection.php');
	if(isset($_POST['login']) && $_POST['username'] != null && $_POST['password'] != null){
		login($conn, $_POST['username'], $_POST['password']);
	}

	if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
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
		<link rel="stylesheet" href="functionalities/css/calendar.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/navbar-footer.css">
		<link rel="stylesheet" href="css/events.css">
		<link rel="stylesheet" href="css/eventlist.css">

		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/script.js"></script>
		<script src="js/home.js"></script>
		<title>Adnu DCS</title>
		<style type="text/css">
		</style>
	</head>
<body>
<div class="toplogo">
	<a href='home.php'><img src="css/temp/dcs-sign.png" /></a>
</div>

<!--start navbar-->

<div class="nav">
	<div class="container">
		<div id='cssmenu'>
			<ul>
				<li><a href='#'>About</a></li>
				<li><a href='#'>Admission</a></li>
				<li><a href='#'>Faculty</a></li>
				<li class='has-sub' style="float: left;"><a href='#'>News</a>
					<ul>
						<li><a href="viewAllNews.php">All News</a></li>
						<li><a href='<?php echo 'allNewsAdmin.php'?>'>My Posted News</a></li>
						<li><a href="<?php echo 'addNews.php'?>">Add News</a></li>
					</ul>
				</li>
				<li><a href='#'>Policies</a></li>

				<li class='has-sub'><a href='#'><?php echo $_SESSION['first_name']?></a>
					<ul>
						<li><a onclick="logout()">Log Out</a></li>
						 <li class='has-sub'><a href='#'>Option 1</a>
							<ul>
								 <li><a href='#'>Sub Option 1</a></li>
								 <li><a href='#'>Sub Option 2</a></li>
							</ul>
						 </li>
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

<!--end navbar-->

	<!--start content-->
	<div class="container">
		<div class="content-wrapper">
			<div class="content">
				<div class="card-container">
					<div class="card">
					    <!-- Header -->
					    <div class="card-img">
					    	<img src="css/temp/7.jpg">
					      	<a href="#" class="rdmr">Read More</a>
					    </div>
					    <!-- Content-->
					    <div class="card-content">
					      	<div class="title">Title</div>
					      	<div class="desc">Descriptionasdadsadadasdsadassdas dasadasdsadsadsadsads asdasdasdasdas
					      	
					      	</div>
					    </div>
					    <!-- Footer-->
					    <div class="admin-btn">
					      	<div class="edit"> <span>Edit</span>
					        	<div class="label"></div>
					     	</div>
					     	<div class="delete"> <span>Delete</span>
					        	<div class="label"></div>
					     	</div>
					    </div>
					 </div>
					 <br><br>

					 <div class="card">
					    <!-- Header -->
					    <div class="card-img">
					    	<img src="css/temp/8.jpg">
					      	<a href="#" class="rdmr">Read More</a>
					    </div>
					    <!-- Content-->
					    <div class="card-content">
					      	<div class="title">Title</div>
					      	<div class="desc">Description</div>
					    </div>
					    <!-- Footer-->
					    <div class="admin-btn">
					    	<div class="edit"> <span>Edit</span>
					        	<div class="label"></div>
					      	</div>
					      	<div class="delete"> <span>Delete</span>
					        	<div class="label"></div>
					      	</div>
					    </div>
					</div>

					<div class="card">
					    <!-- Header -->
					    <div class="card-img">
					    	<img src="css/temp/9.jpg">
					      <a href="#" class="rdmr">Read More</a>
					    </div>
					    <!-- Content-->
					    <div class="card-content">
					    	<div class="title">Title</div>
					    	<div class="desc">Description</div>
					    </div>
					    <!-- Footer-->
					    <div class="admin-btn">
					    	<div class="edit"> <span>Edit</span>
					        	<div class="label"></div>
					      	</div>
					      	<div class="delete"> <span>Delete</span>
					        	<div class="label"></div>
					      	</div>
					    </div>
					</div>

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
