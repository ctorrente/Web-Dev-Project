<?php
	/**
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
	

	//UPDATE
	if(isset($_POST['news_idSave'])){
		$title = $_POST['title'];
		$details =$_POST['details'];
		$file_size = $_FILES['picture']['size'];
		$file_name = $_FILES['picture']['name'];
		$file_ext = strtolower(pathinfo($file_name ,PATHINFO_EXTENSION));
		$user_id = $_SESSION['user_id'];
		$allowedExt = array('gif', 'jpeg', 'jpg', 'png');
		if (isset($_FILES['picture']) && strlen($_FILES['picture']['name']) != 0) {
			if (in_array($file_ext, $allowedExt) && $file_size < 5000000){
				$totalPictures = getTotalPictures($conn);
				$totalPictures =  $totalPictures + 1;
				$file_name = $totalPictures . '.' . $file_ext;
				$file_path = 'newsPictures/' . $file_name;
				$query = 'insert into picture(picture_id, file_name, file_path) values('. "$totalPictures, '$file_name'," . "'$file_path'" . ')';
				$exec = mysqli_query($conn, $query);
				move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
				$query = 'UPDATE news set picture_id = ' . $totalPictures  . ', title = "' . $title . '", details = "' . $details . '", date_posted = NOW() WHERE news_id = ' . $_POST['news_idSave'] . ' ;';
				$exec = mysqli_query($conn, $query);
				echo '<script type="text/javascript">alert("Success")</script>';
			} else{
				echo '<script type="text/javascript">alert("Invalid File")</script>';
			}
		} else {
			$query = "SELECT picture_id FROM news WHERE news_id = ".$_POST['news_idSave'].";";
			$row = mysqli_fetch_assoc(mysqli_query($conn, $query));
			$pic_id = $row['picture_id'];
			$query = 'UPDATE news set picture_id = ' . $pic_id . ', title = "' . $title . '", details = "' . $details . '", date_posted = NOW() WHERE news_id = ' . $_POST['news_idSave'] . ' ;';
			$exec = mysqli_query($conn, $query);
			echo '<script type="text/javascript">alert("Success")</script>';
		}

		
		
		$query = 'SELECT * FROM news n, picture p, users u WHERE n.news_id = ' .  $_POST['news_idSave'] . ' AND ' .
		'n.picture_id = p.picture_id AND n.user_id = u.user_id AND n.user_id = \'' . $_SESSION['user_id'] . '\'';
		$exec = mysqli_query($conn, $query) or die(Mysqli_error());
		$num_rows = mysqli_num_rows($exec);	
	} 

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
	<form action="viewAllNews.php" method="POST" id="deleteNewsForm"" style="display:none;">
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
			if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 ||  $_SESSION['user_type'] == 5)
				echo '<a href="addNews.php" class="btn" style="margin-top: 160px; font-size:12px;">&#10133; Add</a>';

    		if(isset($_POST['news_id']) && ($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3) && !isset($_POST['news_idSave'])){
    	?>
				<a onclick="editNewsFunction(<?php echo $_POST['news_id']?>)" class="btn" style="margin-top: 160px;">Edit</a>
	    		<a onclick="deleteNews(<?php echo $_POST['news_id']?>)" class="btn" style="margin-top: 160px;">Delete</a>
    	<?php 
    		}
    		if($_SESSION['user_type'] == $num_rows['user_type']){
    	?>
    			<a onclick="editNewsFunction(<?php echo $_POST['news_idSave']?>)" class="btn" style="margin-top: 160px;">Edit</a>
	    		<a onclick="deleteNews(<?php echo $_POST['news_idSave']?>)" class="btn" style="margin-top: 160px;">Delete</a>
    	<?php
    		}
    		if(isset($_POST['news_idSave']) && ($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3) || $_SESSION['user_id'] == $num_rows['user_id']){
    	?>
				<a onclick="editNewsFunction(<?php echo $_POST['news_idSave']?>)" class="btn" style="margin-top: 160px;">Edit</a>
	    		<a onclick="deleteNews(<?php echo $_POST['news_idSave']?>)" class="btn" style="margin-top: 160px;">Delete</a>
    	<?php
    		}
    	?>
				<?php
					if(isset($_POST['news_id'])){
						$query = 'SELECT * FROM news n, picture p, users u WHERE n.news_id = ' .  $_POST['news_id'] . ' AND ' .
						'n.picture_id = p.picture_id AND n.user_id = u.user_id';
						$exec = mysqli_query($conn, $query);
						$row = mysqli_fetch_assoc($exec);


				?>

					<div style="font-size: 30px; margin:0 auto; margin-top:150px; padding-left: 300px; margin-right: 300px;">
						<h2 ><?php echo $row['title']?></h2>
					</div>
									<div style="margin: 0 auto" >
			<div class="content" style="width: 100%; margin: 0 auto;">
				<?php
						echo '<br><br><div style="text-align: center;"><i><strong >By: </strong>' . $row['first_name'] . ' <strong>| Date posted: </strong>' . $row['date_posted'] . '</i></div><br>';
						echo '<img style="margin: 0 auto; height: 50%; " src="' . 'newsPictures/' . $row['file_name'] . '" >'; 

				?>
					<div style="font-size: 30px; margin-left: 5%; margin-top: 2%;">
						<h2 ><?php echo $row['title']?></h2>
					</div>
				<?php
						echo '<br><br><div><i><strong >By: </strong>' . $row['first_name'] . ' <strong>| Date posted: </strong>' . $row['date_posted'] . '</i></div>';
						echo '<img style="margin-top: 2%; height: 50%;" src="' . 'newsPictures/' . $row['file_name'] . '" width="900" height=300>'; 

						echo '<p><strong>Details: </strong>' . $row['details'] . '</p>';
						
					}else {
						if(isset($_POST['news_idSave'])){
							$query = 'SELECT * FROM news n, picture p, users u WHERE n.news_id = ' .  $_POST['news_idSave']. ' AND ' .
							'n.picture_id = p.picture_id AND n.user_id = u.user_id';
							$exec = mysqli_query($conn, $query);
							$row = mysqli_fetch_assoc($exec);

							echo '<h1 style="text-align: center;">' .  $row['title'] . '</h1>';
							echo '<br><br><div><i><strong >By: </strong>' . $row['first_name'] . ' <strong>| Date posted: </strong>' . $row['date_posted'] . '</i></div>';
							echo '<img style="margin-top: 2%; height: 50%;" src="' . $row['file_path'] . '">'; 
							echo '<p><strong>Details: </strong>' . $row['details'] . '</p>';
						}else
							header('location: viewAllNews.php');
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
