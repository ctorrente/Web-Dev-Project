<?php
	/**
 		* File Description: View all news that are posted by the admin 
 		*	type users or news that are posted/approved by the moderator.
 		* @version 2.0
		* @authors Charles Torrente
	*/
	include('functions.php');
	include('connection.php');
	if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
	}

	//DELETE
	//Status - Finished
	if(isset($_POST['deleteNewsId'])){
		$query = 'SELECT * FROM news n WHERE n.news_id = ' . $_POST['deleteNewsId'] . ';' ;
		$exec = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($exec);
		$query = 'DELETE FROM news WHERE news_id = ' . $row['news_id'] . ';';
		$exec = mysqli_query($conn, $query);
		$query = ' DELETE FROM picture WHERE picture_id = ' . $row['picture_id'] . ';';
		$exec = mysqli_query($conn, $query);
		echo '<script type="text/javascript">alert("Delete Success!")</script>';
	}

	if (isset($_POST['for_approval_id'])) {
		$query = "UPDATE news SET is_approved = 1 WHERE news_id = " . $_POST['for_approval_id'] . ";";
		$exec = mysqli_query($conn, $query);
		echo '<script type="text/javascript">alert("Aprub!")</script>';
	}
	date_default_timezone_set('Asia/Manila');
?>
<html>
	<script type="text/javascript">
		function logout(){
			var logoutForm = document.getElementById("logoutForm");
			logoutForm.logout = 1;
			logoutForm.submit();
		}

		function readMore(news_id){
			var form = document.getElementById("readMoreForm");
			form.news_id.value = news_id;
			form.submit();
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
		
		function approve(news_for_approval_id) {
			var form = document.getElementById("approvalForm");
			form.for_approval_id.value = news_for_approval_id;
			form.submit();
		}
	</script>
	<form action="login.php" method="POST" id="logoutForm">
		<input type="hidden" name="logout" value="">
	</form>
	<form action="readMore.php" method="POST" id="readMoreForm">
		<input type="hidden" name="news_id" value="">
	</form>	
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="deleteNewsForm">
		<input type="hidden" name="deleteNewsId" value="">
	</form>	
	<form action="editNews.php" method="POST" id="editNewsForm">
		<input type="hidden" name="editNewsId" value="">
	</form>	
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="approvalForm">
		<input type="hidden" name="for_approval_id" value="">
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
	<a href='../home.php'><img src="css/temp/dcs-sign.png" /></a>
</div>

<?php 
	require('navbar.php');
?>
	<!--start content-->

	<div class="container">
		<div class="content-wrapper" >
			<div class="ptcontainer">
				<div class = "pagetitle" style="margin-left: -12%">
           			<p> Organization Officers</p>
            	</div>
            
            	<div class = "pagetitle" id="downadd">
            		<?php 
						if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 5)
							echo '<a href="addNewsForOrgOfficers.php" class="add">Add &#10133;</a>';
					?>    	
            	</div>
            </div>
    	
			<div class="content">
			<?php
				$query = 'select * from news n, picture p, users u where n.picture_id = p.picture_id and u.user_id = n.user_id and n.user_type = 5 order by date_posted desc';
				$exec =  mysqli_query($conn, $query);
				$num_rows = mysqli_num_rows($exec);

				if($num_rows == 0){
					echo '<i><div>Their are no News that are posted.<div></i>';
				}else{
					foreach($exec as $row){	
						$dateTime = new DateTime($row['date_posted'], new DateTimeZone('Asia/Kolkata')); ?>
						<div class="card">
						    <!-- Header -->
						    <div class="card-img">
						    	<img src="<?php echo $row['file_path']?>">
						      	<?php echo '<a class="rdmr" onclick="readMore(' .  $row['news_id'] . ')">Read More</a>';?>
						    </div>
						    <!-- Content-->
						    <div class="card-content">
						      	<div class="title"><?php echo $row['title'] ?></div>
						      	<div class="desc">
						      	<!-- Footer-->
						      	<?php 
					      			$words = explode(' ', $row['details']);
					      			echo '<strong>Posted: ' . $dateTime->format("d/m/y  H:i A") . ' </strong><br>';
					      			echo '<strong>By: ' . $row['first_name'] . ' </strong><br><br>';
					      			if(count($words) > 4){
						      			for($i = 0; $i < 5; $i++){
						      				echo $words[$i] . ' ';
						      			}
						      			echo '....';
					      			}else
					      				echo $row['details'];

									if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 5){
								    
								    	if($row['user_type'] == 5 && ($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3)){?>
									    	<div class="admin-btn">
									    		<div class="edit" style="padding: 0 -20% 0px -0;" onclick="editNewsFunction(<?php echo $row['news_id']?>)"> <span>Approved</span>
										        	<div class="label"></div>
										      	</div>
										    	<div class="edit" style="padding: 0px -5px 0px -5px" onclick="editNewsFunction(<?php echo $row['news_id']?>)"> <span>Edit</span>
										        	<div class="label"></div>
										      	</div>
										      	<div class="delete" style="padding: 0px -5px 0px -5px" onclick="deleteNews(<?php echo $row['news_id']?>)"> <span>Delete</span>
										        	<div class="label"></div>
										      	</div>
										    </div>
										   </div>
									    <?php
									    }else{?>
										    <div class="admin-btn">
										    	<div class="edit" onclick="editNewsFunction(<?php echo $row['news_id']?>)"> <span>Edit</span>
										        	<div class="label"></div>
										      	</div>
										      	<div class="delete" onclick="deleteNews(<?php echo $row['news_id']?>)"> <span>Delete</span>
										        	<div class="label"></div>
										      	</div>
										    </div>
										   </div>
									<?php
										}
									}else{?>
										</div>
									    </div>
									    </div>
									<?php
									}
						}
					}
				?>
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
