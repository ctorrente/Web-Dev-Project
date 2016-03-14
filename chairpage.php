<?php
	session_start();
	include("link.php");
	
	if(!$_SESSION['user_id']) {
		header("Location: index.php");
		exit;
	} else {
		$cid = $_SESSION['user_id'];
		$info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE user_id=$cid"));
	}
	
	if(isset($_POST['btnSetAdviser'])) {
        $temp = 0;
		while($temp < $_POST['counter']) {
			 $student_id = $_POST['student'.$temp];
            //$faculty_id = isset($_POST['faculty'])?$_POST['faculty']:0;
            echo "<script>alert('" . $_POST['faculty'.$temp] . "')</script>";
			if(isset($_POST['faculty' . $temp])) {
				$faculty_id = $_POST['faculty' . $temp];
			}
			else $faculty_id = NULL;
			
            if($faculty_id != NULL) {
                mysqli_query($connect, "UPDATE students SET adviser_id='$faculty_id' WHERE user_id='$student_id'");
            }
            $temp++;
        }
        
        echo "<script>window.open('chairpage.php', '_self')</script>";
    }
?>

<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="css/home.css">
		<link rel="	stylesheet" href="functionalities/css/contactus.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/navbar-footer.css">
		<link rel="stylesheet" href="css/carousel.css">

		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/script.js"></script>
		<script src="js/home.js"></script>
		
		<title>Set Advisers</title>
	</head>
<body>
<div class="toplogo">
	<a href='#'><img src="css/temp/dcs-sign.png" /></a>
</div>

<!--start carousel-->
	<section class="carousel">
		<ul>
			<li>
				<input type="radio" name="opcao" id="img1" hidden checked>
				<label for="img1">
					Bullet 1
					<div class="thumb"></div>
				</label>
				<figure>
					<figcaption>
						DCS website image 1
					</figcaption>
				</figure>
			</li>
			<li>
				<input type="radio" name="opcao" id="img2" hidden>
				<label for="img2">
					Bullet 2
					<div class="thumb"></div>
				</label>
				<figure>
					<figcaption>
						DCS website image 2
					</figcaption>
				</figure>
			</li>
			<li>
				<input type="radio" name="opcao" id="img3" hidden>
				<label for="img3">
					Bullet 3
					<div class="thumb"></div>
				</label>
				<figure>
					<figcaption>
						DCS website image 3
					</figcaption>
				</figure>
			</li>
		</ul>
	</section>

<!--end carousel-->

<!--start navbar-->

<?php require('navbar.php');?>
<!--end navbar-->

	<!--start content(news/events/announcements)-->
	<div class="container">
		<div class="content-wrapper">
			<div class="content">
				<br><br>
				<h1 style="padding-left:50px; padding-top:20px">Set Advisers </h1>
				<br/>
				<ul style="padding-top:70px">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" role="form">
                    <?php
                        $advising_query = mysqli_query($connect, "SELECT u.user_id, u.first_name, u.last_name, u.major FROM users u, students s WHERE u.user_type = 1 AND s.adviser_id IS NULL AND u.username = s.student_id");
                        
                        $numrows = mysqli_num_rows($advising_query);

                        $counter = 0;
                        while($data = mysqli_fetch_assoc($advising_query)) {
                            echo "<li style='padding-bottom:5px'><a style='color:black'><input type='hidden' name='student".$counter."' value='".$data['user_id']."'>";
                            echo $data['first_name'] . " " . $data['last_name'];
                            echo "</a>";
                            
                            $major = $data['major'];
                            $advisee_query = mysqli_query($connect, "SELECT * FROM users WHERE major='$major' AND user_type=2");
                            
                            echo "&nbsp;<select name='faculty".$counter."'>";
                            echo "<option value=''>Choose Advisee</option>";

                            while($row = mysqli_fetch_assoc($advisee_query)) {
                                echo "<option value='".$row['username']."'>";
                                echo $row['first_name'] . " " . $row['last_name'];
                                echo "</option>";
                            }
                            
                            echo "</select>";
                            echo "</li>";

                            $counter++;
                            
                        }
					echo $counter;

                    ?>
					<input type="hidden" name="counter" value="<?php echo $counter;?>">
					<input type="submit" name="btnSetAdviser" value="Set Adviser">
					<br><br>
				</form>
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
</html>

<?php

?>