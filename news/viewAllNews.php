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
	<form action="viewAllNews.php" method="POST" id="deleteNewsForm">
		<input type="hidden" name="deleteNewsId" value="">
	</form>	
	<form action="editNews.php" method="POST" id="editNewsForm">
		<input type="hidden" name="editNewsId" value="">
	</form>	
	<form action="viewAllNews.php" method="POST" id="approvalForm">
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
				<div class = "pagetitle">
           			<p> All News </p>
            	</div>
            
            	<div class = "pagetitle" id="downadd">
            		<?php 
						if($_SESSION['user_type'] != 1 || $_SESSION['is_officer'] == 1)
							echo '<a href="addNews.php" class="add">Add &#10133;</a>';
					?>    	
            	</div>
            </div>
    	
			<div class="content">
				<?php
				if ($_SESSION['is_admin'] == 1 || $_SESSION['is_moderator'] == 1) {
					$query = 'SELECT * FROM news n, picture p WHERE n.picture_id = p.picture_id ORDER BY n.date_posted DESC';
					$show_all = 1;
				}
				else {
					$query = 'SELECT * FROM news n, picture p WHERE n.picture_id = p.picture_id AND n.is_approved = 1 ORDER BY n.date_posted DESC';
					$show_all = 0;
				}
				
					
					$exec =  mysqli_query($conn, $query);
					$num_rows = mysqli_num_rows($exec);

					if($num_rows == 0){
						echo '<i><div>Their are no News that are posted.<div></i>';
					}
					foreach($exec as $row){	
						//echo $row['file_path'];
						$date_posted = strtotime($row['date_posted']);
						if ($_SESSION['is_admin'] == 1 || ($_SESSION['is_moderator'] == 1 && $row['is_approved'] == 0) || $_SESSION['user_id'] == $row['user_id'])  {
							?>
							<div class="card">
							    <!-- Header -->
							    <div class="card-img">
							    	<img  src="<?php echo $row['file_path']?>">
							      	<a href="#" class="rdmr" onclick="readMore('<?php echo $row['news_id']?>')">Read More</a>
							    </div>
							    <!-- Content-->
							    <div class="card-content">
							      	<div class="title"><?php echo $row['title']?></div>
							      	<div class="desc">
							      		<?php 
							      			$words = explode(' ', $row['details']);
							      			if(count($words) > 4){
								      			for($i = 0; $i < 5; $i++){
								      				echo $words[$i] . ' ';
								      			}
								      			echo '....';
							      			}else
							      				echo $row['details'];
							      		?>
							      	</div>
							    </div>
							    <!-- Footer-->
							    <div class="admin-btn">
									<?php if($_SESSION['is_moderator'] == 1 && $row['is_approved'] == 0) {
										$padding = "15px 28px 15px 28px";
										}
										else {
											$padding = NULL;
										}
									if ($_SESSION['is_moderator'] == 1 && $row['is_approved'] == 0) {
									?>
									<div class="edit" onclick="approve(<?php echo $row['news_id']?>)" style='padding:<?php echo $padding;?>;'><span>Approve</span>
										<div class="label"></div>
									</div>
									<?php } ?>
							    	<div class="edit" onclick="editNewsFunction(<?php echo $row['news_id']?>)" style='padding:<?php echo $padding;?>;'> <span >Edit</span>
							        	<div class="label"></div>
							      	</div>
							      	<div class="delete" onclick="deleteNews(<?php echo $row['news_id']?>)" style='padding:<?php echo $padding;?>;'> <span >Delete</span>
							        	<div class="label"></div>
							      	</div>
							    </div>
							</div>
							<?php
						} else {
							?>
							<div class="card" style="margin-top: 15%;">
							    <!-- Header -->
							    <div class="card-img">
							    	<img src="<?php echo $row['file_path']?>">
							      	<a href="#" class="rdmr" onclick="readMore('<?php echo $row['news_id']?>')">Read More</a>
							    </div>
							    <!-- Content-->
							    <div class="card-content">
							      	<div class="title"><?php echo $row['title'] ?></div>
									
							      	<div class="desc">
							      		<?php 
							      			$words = explode(' ', $row['details']);
							      			$size = sizeof($words) / 5;
							      			for($i = 0; $i <= $size; $i++){
							      				echo $words[$i] . ' ';
							      			}
							      			echo '....';
							      		?>
							      	</div>
							    </div>

							    
							    <!-- Footer-->
							    <div class="div">
							    	<i class="i"><strong>Date posted: </strong><?php $tmp = strtotime($row['date_posted']); echo date("M/d/Y", $tmp);?></i>
							    	 <?php
								    	$query = 'SELECT * FROM users WHERE user_id = \'' . $row['user_id'] . '\'';
								    	
								    	$poster_row = mysqli_query($conn, $query);
								    	foreach($poster_row as $poster){
							   		 		echo '<i class="i"> <strong>By:</strong> ' . $poster['first_name'] . '</i>';
							    		}
							    	?>
							    </div>
							</div>
							<?php
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
