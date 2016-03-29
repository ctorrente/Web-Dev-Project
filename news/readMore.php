<?php
	/*
 		* File Description: Read more page of a news 
 		* @version 2.0
		* @authors Charles Torrente
	*/
	include('functions.php');
	include('connection.php');

	if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
	}

	$num_rows = null;

	if(isset($_POST['news_id'])){
		$query = 'SELECT * FROM news n, picture p, users u WHERE n.news_id = ' .  $_POST['news_id'] . ' AND ' .
			'n.picture_id = p.picture_id AND n.user_id = u.user_id AND n.user_id = \'' . $_SESSION['user_id'] . '\'';
		$exec = mysqli_query($conn, $query) or die(Mysqli_error());
		$num_rows = mysqli_num_rows($exec);
	}
?>
<html>
	<script type="text/javascript">
		function logout(){
			var logoutForm = document.getElementById("logoutForm");
			logoutForm.logout = 1;
			logoutForm.submit();
		}

		function deleteNews(deleteNewsId){
			var tmp = confirm('Are your sure?');
			if(tmp){
				var form = document.getElementById("deleteNewsForm");
				form.deleteNewsId.value = deleteNewsId;
				form.submit();
			}
		}

		function editNewsFunction(edit_news_id){
			var form = document.getElementById("editNewsForm");
			form.editNewsId.value=edit_news_id;
			form.submit();
		}
	</script>
	<form action="login.php" method="POST" id="logoutForm" style="display:none;">
		<input type="hidden" name="logout" value="" style="display:none;">
	</form>
	<form action="viewAllNews.php" method="POST" id="deleteNewsForm" style="display:none;">
		<input type="hidden" name="deleteNewsId" value="" style="display:none;">
	</form>	
	<form action="editNews.php" method="POST" id="editNewsForm" style="display:none;">
		<input type="hidden" name="editNewsId" value="" style="display:none;">
	</form>	
	<head>
		<!--<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
		<link rel="stylesheet" href="functionalities/css/contactus.css">
		<link rel="stylesheet" href="functionalities/css/calendar.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/navbar-footer.css">
		<link rel="stylesheet" href="css/calendar.css">
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

<?php require('navbar.php'); ?>

	<!--start content-->
	<!--Core Modules -->
	<div class="container">
		<div class="content-wrapper" style=" width: 100%;">
			<div class="content" style=" width: 100%;">

		<?php
			if(isset($_POST['news_id'])){
				$query = 'SELECT  n.news_id as news_id, n.user_id as user_id, n.title as title, n.details as details, n.date_posted as date_posted, 
				n.is_approved as is_approved, p.file_path as file_path, p.file_name as file_name, u.first_name as 
				first_name, n.faculties as faculties, n.students as students, n.alumnus as alumnus, n.guests as guests,  
				u.user_type as user_type FROM news n, picture p, users u WHERE n.news_id = ' . 
				 $_POST['news_id'] . ' AND ' .'n.picture_id = p.picture_id AND n.user_id = u.user_id';
				$exec = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($exec);
		?>
		<div style="margin: 0px -300px; width: 100%; height: 20px;">
    	<?php 
			if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 ||  $_SESSION['user_id'] == $row['user_id']){
				echo '<a href="addNews.php" class="btn" style="margin-top: 130px; font-size:12px; ">&#10133; Add</a>';
    	?>
				<a onclick="editNewsFunction(<?php echo $_POST['news_id']?>)" class="btn" style="margin-top: 130px;">Edit</a>
	    		<a onclick="deleteNews(<?php echo $_POST['news_id']?>)" class="btn" style="margin-top: 130px;">Delete</a>
	    <?php
		}else{
			if($_SESSION['user_type'] == 5){
				echo '<a href="addNews.php" class="btn" style="margin-top: 130px; font-size:12px; ">&#10133; Add</a>';
			}
		}
	    ?>
    	 </div>
			<div style="font-size: 30px; margin:0 auto; margin-top:100px; padding-left: 300px; margin-right: 300px;">
				<h2><?php echo $row['title']?></h2>
			</div>
			<div style="margin: 0 auto" >
				<div class="content" style="width: 100%; margin: 0 auto;">
					<?php
						$date = date("F m, Y g:ia", strtotime($row['date_posted']));
						echo '<br><br><div style="text-align: center;"><i><strong >By: </strong>' . $row['first_name'] . ' <strong>| Date posted: </strong>' . $date . '</i></div><br>';
						echo '<img style="margin: 0 auto; height: 50%; " src="' . 'newsPictures/' . $row['file_name'] . '" >'; 
					
						$faculties = ($row['faculties'] == 1)?'checked':'';
						$students = ($row['students'] == 1)?'checked':'';
						$alumnus = ($row['alumnus'] == 1)?'checked':'';
						$guests = ($row['guests'] == 1)?'checked':'';
					?>

					<?php if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 5){?>
					<center>
					<h3>Can view by: </h3>
					<div class="bla" >
						<input disabled <?php echo $faculties?> type="checkbox" name="faculties" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Faculties
						<input disabled <?php echo $students?> type="checkbox" name="students" value="1" style="-webkit-appearance: checkbox; width: 20px; "> Students
						<input disabled <?php echo $alumnus?> type="checkbox" name="alumnus" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Alumnus
						<input disabled <?php echo $guests?> type="checkbox" name="guests" value="1" style="-webkit-appearance: checkbox; width: 20px;"> Guests
					</div>
					</center>

					<?php
						}
						echo '<p><strong>Details: </strong>' . $row['details'] . '</p>';
					}
					?>
	 			</div>
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
		<div class="legality">
			&copy; Copyright 2016 by Your Company
		</div>
	</footer>

</body>
<html>
