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
		echo '<script type="text/javascript">alert("Approved")</script>';
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
			var tmp = confirm("Are your sure you want to approve this?");

			if(tmp){
				var form = document.getElementById("approvalForm");
				form.for_approval_id.value = news_for_approval_id;
				form.submit();
			}
		}
	</script>
	<form action="login.php" method="POST" id="logoutForm" style="display:none;">
		<input type="hidden" name="logout" value="" style="display:none;">
	</form>
	<form action="approvalReadMore.php" method="POST" id="readMoreForm" style="display:none;">
		<input type="hidden" name="news_id" value="" style="display:none;">
	</form>	
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="deleteNewsForm" style="display:none;">
		<input type="hidden" name="deleteNewsId" value="" style="display:none;">
	</form>	
	<form action="editNews.php" method="POST" id="editNewsForm" style="display:none;">
		<input type="hidden" name="editNewsId" value="" style="display:none;">
	</form>	
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="approvalForm" style="display:none;">
		<input type="hidden" name="for_approval_id" value="" style="display:none;">
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
			a{
				color: black;
			}
			li{
				display: inline;
			}
			div#pagination_controls{
				font-size: 21px;
			}
			div#pagination_controls > a{ color: #06F;}
			div#pagination_controls > a:visited{ color: #06F;}
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
           			<p> News for Approval</p>
            	</div>

            	<div class = "pagetitle" id="downadd">
            		<?php 
						if($_SESSION['user_type'] == 5)
							echo '<a href="addNews.php" class="add">Add &#10133;</a>';
					?>    	
            	</div>
            </div><br><br><br>

			<div class="content">
			<?php
				$sql = "SELECT count(*) from news WHERE is_approved = 0";
				$query = mysqli_query($conn, $sql);
				$row = mysqli_fetch_row($query);
				$rows = $row[0];
				$page_rows = 2;
				$last = ceil($rows/$page_rows);

				if($last < 1)
					$last = 1;

				$pagenum = 1;
				if(isset($_GET['pn'])){
					$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
				}

				//this makes sure that page number is less 1 or more than last our last page
				if($pagenum < 1)
					$pagenum = 1;
				else if ($pagenum > $last) {
					$pagenum = $last;
				}

				$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ', ' . $page_rows;
				$sql = "select * from news n, picture p, users u where n.picture_id = p.picture_id and u.user_id = n.user_id and n.is_approved = 0 order by date_posted desc $limit";
				$query = mysqli_query($conn, $sql);
				$textline1 = "ldap_count_entries(link_identifier, result_identifier) (<b>$rows<b>)";
				$textline2 = "Page (<b>$pagenum<b> of <b>$last<b>)";
				$paginationCtrls = '';

				if($last != 1){
					if($pagenum > 1){
						$previous = $pagenum - 1;
						$paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';  
					
						for($i = $pagenum - 4; $i < $pagenum; $i++){
							if($i > 0){
								$paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn='.$i.'">'.$i. '</a> &nbsp; ';  
							}
						}
					}


					$paginationCtrls .=''.$pagenum.' &nbsp; ';
					for($i = $pagenum +1; $i <=  $last; $i++){
						$paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn='.$i.'">'.$i. '</a> &nbsp; '; 
						if($i >= $pagenum+4){
							break;
						}
					}

					if($pagenum != $last){
						$next = $pagenum+1;
						 $paginationCtrls .= '&nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn='.$next.'">Next</a> ';  
					}
				}
			?>
			
			<?php
				if($rows == 0){
					echo '<i><div>There are no News that are posted by students.<div></i>';
				}else{
					echo "<p> $textline2</p>";
					while($row =  mysqli_fetch_array($query)){
						if($row['is_approved'] && ($_SESSION['user_type'] == 6 || $_SESSION['user_type'] == 7 || $_SESSION['user_type'] == 8)){
							
							$date = date("F m, Y g:ia", strtotime($row['date_posted']));
							?>

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
						      			echo '<strong>Posted: ' . $date . ' </strong><br>';
						      			echo '<strong>By: ' . $row['first_name'] . ', ';
						      			if($row['is_approved'] == 0)
						      				echo 'Not yet approved</strong><br><br>';
						      			else
						      				echo 'Approved</strong><br><br>';
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
							</div>
							<?php
							}else{
								if($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 5){
									$date = date("F m, Y g:ia", strtotime($row['date_posted']));
								?>
								
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
								      			echo '<strong>Posted: ' . $date . ' </strong><br>';
								      			echo '<strong>By: ' . $row['first_name'] . ', ';
								      			if($row['is_approved'] == 0)
								      				echo 'Not yet approved</strong><br><br>';
								      			else
								      				echo 'Approved</strong><br><br>';
								      			if(count($words) > 4){
									      			for($i = 0; $i < 5; $i++){
									      				echo $words[$i] . ' ';
									      			}
									      			echo '....';
								      			}else
								      				echo $row['details'];
								      			if($row['user_type'] == 5 && $row['is_approved'] == 0 && ($_SESSION['user_type'] == 0 || $_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3)){?>
											    	<div class="admin-btn">
											    		<div class="edit" style="padding: 0 -20% 0px -0;" onclick="approve(<?php echo $row['news_id']?>)"> <span>Approve</span>
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
										</div>
									</div>
									<?php
									}

								}
							}
						}
					}
				?>

				<div id="pagnation_controls">
					<?php echo $paginationCtrls; ?>
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
