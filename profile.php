<?php
    session_start();
    include("link.php");

    if(!$_SESSION['user_id']) {
		header("Location: index.php");
		exit;
	} else {
		$id = $_SESSION['user_id'];
		$info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE user_id=$id"));
		$info2 = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM students WHERE user_id=$id"));
		if (isset($_SESSION['is_admin'])) $is_admin = $_SESSION['is_admin'];
		else $is_admin = 0;
	}

	require('header.php');
	require('carousel.php');
	require('navbar.php');
?>

	<!--start content(news/events/announcements)-->
	<div class="container">
		<div class="content-wrapper">
			<div class="content">
                <?php
                    $name = $info['first_name'] . " " . $info['last_name'];
					if ($info['user_type'] == 2) {
						$query = mysqli_query($connect, "SELECT COUNT(adviser_id) AS advisees FROM students WHERE adviser_id='".$info['username']."'");
						$fetch = mysqli_fetch_assoc($query);
					}
                ?>
				<br><br>
				<h1 style="padding-left:50px; padding-top:20px;text-align:left;font-size:2.25em;">
					<?php echo $name; ?>
				</h1>
				<hr>
				<div style="margin-left: 5%;">
				<?php
					echo "<br>";
					echo "ID: <b>" . $info['username'] . "</b><br>";
					if ($info['major'] == 'CS') echo "Major in Computer Science<br>";
					else if ($info['major'] == 'IT') echo "Major in Information Technology<br>";
					else if ($info['major'] == 'IS') echo "Major in Information Systems<br>";
					if ($_SESSION['is_admin'] == 1) echo "Chairperson, Department of Computer Science<br>";
					if ($_SESSION['is_moderator'] == 1) echo "Moderator, The Ateneo Consortium of Technological Information and Computing Sciences<br>";
					if ($_SESSION['is_prog_coordinator'] == 1) echo "Program Coordinator, Department of Computer Science<br>";
					
					echo "<br>" . $info['address'] . "<br>";
					echo $info['gbox_acct'] . "<br>";
				?>
				</div>
				<br/>
                
                <?php
					if(empty($info2['adviser_id'])) {
                        $msg = "N/A";
                    } else {
                        $data = mysqli_fetch_assoc(mysqli_query($connect, "SELECT first_name, last_name FROM users WHERE username='".$info2['adviser_id']."';"));
                        $msg = $data['first_name'] . " " . $data['last_name'];
                    }
				echo "<hr>";
                echo "<h1>Advisement</h1>";
				?>
				<ul style="padding:10px 30px 10px 30px;">
				<?php 
					if ($info['user_type'] == 1)
						echo "<p><b>Adviser:  " . $msg . "</b></p>";
					else if ($info['user_type'] == 2) {
						if($fetch['advisees'] == 0){
                        echo "<p><b><a style='color:gray;cursor:default'>Go to page</a></b></p>";
						} else {
							echo "<p><b><a href='facultypage.php' style='color:black'>View Advisees</a></b></p><br>";
						}
						
						if ($is_admin == 1) {
							$nostudent_query = mysqli_query($connect, "SELECT * FROM students WHERE adviser_id IS NULL");
							$numofstud = mysqli_num_rows($nostudent_query);
							echo "<h2 style='text-align:left;'>Assign Advisees</h2>";
							if ($numofstud > 0) {
								echo "<b><a href='chairpage.php' style='color:black;cursor:pointer'>Set Advisers Manually</a></b><br><br>";
								echo "<form action='randomprocess.php' target='_blank' role='form' method='post'><b><button style='color:black;cursor:pointer' name='gorandom' id='gorandom' type='submit'>Set Advisers Psuedo-Random</button></b>";
							} else {
								echo "<b>No Students with no advisers currently assigned</b>";
							}
							echo "<br><br>";
						}
					}	
				?>	
				</ul>
				
			
			
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
		</div>
		<div class="legality">
			&copy; Copyright 2016 by Your Company
		</div>
	</footer>
	<!--end footer-->
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
	$(window).scroll(function() {
		var x = window.pageYOffset;
		if(x > 250){
			$('.nav').addClass("fixed"); //make position fixed instead of absolute
		} else {
			$('.nav').removeClass("fixed") ;//clear styles if back to original position
		}
	});

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
