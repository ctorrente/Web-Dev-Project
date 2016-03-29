<?php
	/* File Description: Edit a news page
 		*	type users or news that are posted/approved by the moderator.
 		* @version 2.0
		* @authors Charles Torrente
	*/
	include('functions.php');
	include('connection.php');

		//UPDATE
	if(isset($_POST['news_idSave'])){
		$title = $_POST['title'];
		$details =$_POST['details'];
		$file_size = $_FILES['picture']['size'];
		$file_name = $_FILES['picture']['name'];
		$file_ext = strtolower(pathinfo($file_name ,PATHINFO_EXTENSION));
		$user_id = $_SESSION['user_id'];
		$allowedExt = array('gif', 'jpeg', 'jpg', 'png');
		$date = date('Y/m/d h:i:s');
		$faculties = (!isset($_POST['faculties']))?0:1;
		$students = (!isset($_POST['students']))?0:1;
		$alumnus = (!isset($_POST['alumnus']))?0:1;
		$guests = (!isset($_POST['guests']))?0:1;

		if (isset($_FILES['picture']) && strlen($_FILES['picture']['name']) != 0) {
			if (in_array($file_ext, $allowedExt) && $file_size < 5000000){
				$totalPictures = getTotalPictures($conn);
				$totalPictures =  $totalPictures + 1;
				$file_name = $totalPictures . '.' . $file_ext;
				$file_path = 'newsPictures/' . $file_name;
				$query = 'insert into picture(picture_id, file_name, file_path) values('. "$totalPictures, '$file_name'," . "'$file_path'" . ')';
				$exec = mysqli_query($conn, $query);
				move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
				$query = 'UPDATE news set picture_id = ' . $totalPictures  . ', title = \'' . $title . '\', details = \'' . $details  . '\', faculties = ' . $faculties .  ', students = ' . $students . ', alumnus = ' . $alumnus . ', guests = ' . $guests . ', date_posted = NOW() WHERE news_id = ' . $_POST['news_idSave'] . ' ;';
				$exec = mysqli_query($conn, $query);
				echo '<script type="text/javascript">alert("Success")</script>';
			} else{
				echo '<script type="text/javascript">alert("Invalid File")</script>';
			}
		} else {
			$query = "SELECT picture_id FROM news WHERE news_id = ".$_POST['news_idSave'].";";
			$row = mysqli_fetch_assoc(mysqli_query($conn, $query));
			$pic_id = $row['picture_id'];
			$query = 'UPDATE news set picture_id = ' . $pic_id . ', title = \'' . $title . '\', details = \'' . $details  . '\', faculties = ' . $faculties .  ', students = ' . $students . ', alumnus = ' . $alumnus . ', guests = ' . $guests . ', date_posted = NOW() WHERE news_id = ' . $_POST['news_idSave'] . ' ;';
			$exec = mysqli_query($conn, $query);
			echo '<script type="text/javascript">alert("Success")</script>';
		}
		header('location: viewAllNews.php');
	} 
?>

<html>
	<script type="text/javascript">
		function logout(){
			var logoutForm = document.getElementById("logoutForm");
			logoutForm.logout = 1;
			logoutForm.submit();
		}

		function Validate(news_id){
			var tmp = confirm("Save changes?");

			if(tmp)
				var validFileExtension = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
				var inputs = document.getElementsByTagName("input");
				var form = document.getElementById("editForm");

				for(var i = 0; i < inputs.length  - 4; i++){
					if(inputs[i].type == "file"){
						var file_name = inputs[i].value;
						var match = false;
						for(var j = 0; j < validFileExtension.length; j++){
							if(file_name.substr(file_name.length - validFileExtension[j].length, validFileExtension[i].length) == validFileExtension[j]){
								match = true;
								break;
							}
						}

						if(match || form.picture.files.length == 0){
							form.news_idSave.value = news_id;
							return true;
						}
						else{
							alert("Sorry, " + file_name + " is invalid, allowed extensions are: " + validFileExtension.join(", "));
	                    	return false;
						}
					}
				}
				return false;
			}else
				return false;
		}
	</script>
	<form action="login.php" method="POST" id="logoutForm">
		<input type="hidden" name="logout" value="">
	</form>
	<head>
		<!--<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
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

<?php require('navbar.php'); ?>

<!--ADD NEWS FORM-->
<div class="container">
	<div class="content-wrapper">
		<div class="content">
			<?php 
				if($_POST['editNewsId']){
					$query = 'SELECT * FROM news n, picture p, users u WHERE n.news_id = ' .  $_POST['editNewsId'] . ' AND ' .
					'n.picture_id = p.picture_id AND n.user_id = u.user_id';
					$exec = mysqli_query($conn, $query);
					$row = mysqli_fetch_assoc($exec);

					$faculties = ($row['faculties'] == 1)?'checked':'';
					$students = ($row['students'] == 1)?'checked':'';
					$alumnus = ($row['alumnus'] == 1)?'checked':'';
					$guests = ($row['guests'] == 1)?'checked':'';
			?>
					<form class="addeve" id="editForm" onsubmit="return Validate(<?php echo $_POST['editNewsId']; ?>);" enctype="multipart/form-data" method="POST" action="editNews.php">
						<h1>Edit News</h1>
						<input type="text" value="<?php echo $row['title']?>" name="title" placeholder="Title" required>
						<?php
							echo '<img style="margin-top: 2%;width:100%;" src="' . 'newsPictures/' . $row['file_name'] . '" height="300">'; 
						?>
						<p>Change picture</p>
						<input type="file" name="picture" id="picture" placeholder="Browse">
						<textarea name="details" placeholder="Details" required><?php echo $row['details']?></textarea>
						<center>
						<h3>Can view by: </h3>
						<div class="bla" >
							<input  <?php echo $faculties?> type="checkbox" name="faculties" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Faculties
							<input  <?php echo $students?> type="checkbox" name="students" value="1" style="-webkit-appearance: checkbox; width: 20px; "> Students
							<input  <?php echo $alumnus?> type="checkbox" name="alumnus" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Alumnus
							<input  <?php echo $guests?> type="checkbox" name="guests" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Guests
						</div>
						</center>
						<input type="hidden" name="news_idSave" value="<?php echo $_POST['editNewsId']; ?>">
						<input type="submit" name="save" value="Save">
					</form>
			<?php
				}
			?>
		</div>
	</div>
</div>

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
