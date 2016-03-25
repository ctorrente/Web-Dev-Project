<?php 
	/* File Description: Login Page of the site 
 		*	type users or news that are posted/approved by the moderator.
 		* @version 2.0
		* @authors Charles Torrente
	*/
	include('functions.php');
	include('connection.php');
	if(isset($_POST['login']) && $_POST['username'] != null && $_POST['password'] != null){
		login($conn, $_POST['username'], md5($_POST['password']));
	}

	if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
	}
?>
<html>
<head>
	<title>Login</title>

	<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="functionalities/css/contactus.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/navbar-footer.css">

	<style type="text/css">
		body{
			overflow: hidden;
		}
		img{
			display: block;
			margin: 20px auto;
		}
		form{
			border-top: 3px solid #2062a2;
			margin: 0 auto;
			padding: 35px;
		}
		input{
			padding: 10px;
			width: 20%;
			display: block;
			margin: 0 auto;
			background: none;
		}
		input[type="text"],input[type="password"]{
			border-bottom: 1px solid #DDDDDD;
			
		}
		input[type="submit"]{
			background: #DDDDDD;
		}
		input[type="submit"]:hover{
			background: #2062a2;
			color: white;
		}
		input::-webkit-input-placeholder {
			color: #A9A9A9;
			text-align: center;
		}
	</style>
</head>
<body>
	<img src="img/dcs-sign.png" height="60">
	    <form action="login.php" method="POST">
		<p><h2>Login to your DCS account</h2></p>
		    <input type="text" name="username" placeholder="Username" required><br>
		    <input type="password" name="password" placeholder="Password" required><br>
		    <input type = "submit" name="login" value="Login" /> <br>
		    <input type="submit" value="Login as Guest" /><br>
	    </form>
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
</body>
</html>