<html>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "dcs_project";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>
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
		<script type="text/javascript">
		function loginFormFunction(){
			var form = document.getElementById("loginForm");
			form.username.value = 'guest';
			form.password.value = '123456';
			form.submit();
		}
		</script>
	    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="loginForm">
		<p><h2>Login to your DCS account</h2></p>
		    <input type="text" name="username" placeholder="Username"/><br>
		    <input type="password" name="password" placeholder="Password"/><br>
		    <input type = "submit" name="btnLogin" value="Login" /> <br>
		    <input type="submit" name="btnLoginGuest" value="Login as Guest" onclick="loginFormFunction()"/><br>
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

<?php
	if(isset($_POST['btnLogin']) || isset($_POST['btnLoginGuest'])) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$check_user = mysqli_query($conn, "SELECT user_id, user_type FROM users WHERE username='$username' AND password='$password'");
        $checker = mysqli_num_rows($check_user);
        if($checker > 0) {
            $data = mysqli_fetch_assoc($check_user);
			session_start();
			$_SESSION['user_id'] = $data['user_id'];
			$addsitevisits = mysqli_query($conn, "UPDATE visit_statistics SET value = value + 1");
			header("Location: home.php");
        } else {
            echo "<script>alert('Invalid Username or Password')</script>";
        }
	}
	if (isset($_POST['btnLoginGuest'])) {
		$_SESSION['user_type'] = 0;
		header("Location: home.php");
	}
?>
</html>