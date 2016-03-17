<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="functionalities/css/contactus.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/navbar-footer.css">
		<link rel="stylesheet" href="css/carousel.css">
		<link rel="stylesheet" href="css/calendar.css">
		
		<link href='../fullcalendar.css' rel='stylesheet' />
		<link href='../jquery-ui-themes-1.11.4/themes/start/jquery-ui.css' rel='stylesheet' />
		<link href='../fullcalendar.print.css' rel='stylesheet' media='print' />

		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/script.js"></script>
		<script src="js/home.js"></script>
		
		<script src='../lib/moment.min.js'></script>
		<script src='../jquery-1.12.0.min.js'></script>
		<script src='../fullcalendar.min.js'></script>
		<script src='../jquery-ui-1.11.4/jquery-ui.js'></script>
		<script src='../jquery-ui-1.11.4/jquery-ui.min.js'></script>
		<script src='../jquery-dateFormat.js'></script>
		<script src='../moment.js'></script>
		
		<title>Adnu DCS</title>

		<style type="text/css">
		
		#calendar {
			max-width: 900px;
			margin: 0 auto;
		}
		
		button {
			background: none;
			border: 1px solid #A9A9A9;
			border-radius: 8px;
			padding: 5px;
			color: #A9A9A9;
			outline: none;
		}
		button:hover {
			color: white;
			background: #2062b2;
			border: 1px solid #2062a2;
		}
		#delete {
			float: right;
		}
		
		#confDelete {
			float: right;
		}
		
		.title {
			width: 265px;
		}
		.fc-event-time{
			display : none;
		}
		.fc-time{
			display : none;
		}

		table {
		    border-collapse: collapse;
		    width: 90%;
		    margin: 20px auto;
		}
		tr {
		    border-bottom: 1px solid #ccc;
		    text-align: center;
		    vertical-align: center;
		}

		td {
		    text-align: center;
		    vertical-align: center;
		}

		ul{
				
			    list-style:none;
			    position:absolute;
			    margin: 10px 0px 0px -50px;
		}

		li{
			list-style:none;
			float:left;
			position:relative;
		}

		#select{
			height: 3em;
			padding: 10px;
			margin: 0px 0px 0px 0px;
			border: 1px solid #A9A9A9;
			border-radius: 8px;
			padding: 10px;
			color: #A9A9A9;
			outline: none;
		}

		textarea{
			max-width: 50%;
			height: 3em;
			padding: 10px;
			margin: 20px 0;
			border: 1px solid #A9A9A9;
			border-radius: 8px;
			padding: 10px;
			color: #A9A9A9;
			outline: none;
		}
		input{
			background: none;
			border: 1px solid #A9A9A9;
			border-radius: 8px;
			padding: 5px;
			color: #A9A9A9;
			outline: none;
		}
		input:hover{
			color: white;
			background: #2062a2;
			border: 1px solid #2062a2;
		}
		form{
			vertical-align: middle;
			height: 3em;
			padding: 10px;
			margin: 20px 0;
			max-width: 50%;
		}
		
		</style>

	</head>
<body>
<div class="toplogo">
	<a href='#'><img src="css/temp/dcs-sign.png" /></a>
</div>

<!--start navbar-->

<div class="nav">
	<div class="container">
		<div id='cssmenu'>
			<ul>
				<li><a href='#'>About</a></li>
				<li><a href='#'>Admission</a></li>
				<li><a href='#'>Faculty</a></li>
				<li><a href='#'>Policies</a></li>

				<li class='has-sub'><a href='#'>User</a>
					<ul>
						<li><a href='#'>Log Out</a></li>
						 <li class='has-sub'><a href='#'>Option 1</a>
							<ul>
								 <li><a href='#'>Sub Option 1</a></li>
								 <li><a href='#'>Sub Option 2</a></li>
							</ul>
						 </li>
						 <li class='has-sub'><a href='#'>Option 1</a>
							<ul>
								 <li><a href='#'>Sub Option 1</a></li>
								 <li><a href='#'>Sub Option 2</a></li>
							</ul>
						 </li>
					</ul>
				</li>
				<li class="msg"><a data-toggle="open-modal" data-target="#contact">&#9993;</a></li>
				<li class="msg">
					<input type="search" placeholder="&#x1f50e; Search" /></li>

			</ul>
		</div>
	</div>
</div>

<!--end navbar-->

	<!--start content-->
	
	<div class="container">
		<div class="content-wrapper">
		
			<div class="content">
			
			
			
			<button id="addEvent">Create Event</button>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
				<table id="offEvents">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
					<!--start header-->
					<tr>
						<th>Event Name</th>
						<th>Description</th>
						<th>Date</th>	
						<th>Status</th>	
						<th>Comment</th>
						<th>Action</th>							
					</tr>
					<!--end header-->

					<!--start content-->

					<?php
						$dblink = mysqli_connect("localhost", "root", "root", "dcs_project");

					    $sql = "SELECT * FROM event where event_sub_by = 5;";
					    $result = mysqli_query($dblink, $sql);

					    if (mysqli_num_rows($result) > 0) {
					    	 while($row = mysqli_fetch_assoc($result)) {

					?>
					
					<tr>
						<td><?php echo $row["event_title"]; ?></td>
						<td><?php echo $row["event_desc"]; ?></td>
						<td><?php echo $row["event_start"]; ?></td>
						<td><?php
						if ($row["event_status"]==0)
							echo "Approved";
						else if ($row["event_status"]==1)
							echo "Disapproved";
						else
							echo "For approval";
						
						$row["event_status"]; ?></td>
						<td><?php echo $row["event_comment"]; ?></td>
						<td></td>
					</tr>
					

					<?php
							}
					    }

					?>
					<!--end content-->
						
					
	</table>
	</form>

			</div>
			
		</div>
	</div>

	<!--end content-->

	<!--start footer-->
	<footer>
		<div class="lookWrap">
			<a><h2>Contact Us</h2></a>
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

<script>

$(document).ready(function(){
    $('#addEvent').click(function(event){
        $('#offEvents').append("<tr><td><input type='text' name='eventTitle' size='10'></td><td><input type='text' name='eventDesc' size='10'></td><td><input type='date' name='eventStartDate'> until <input type='date' name='eventEndDate'></td><td></td><td></td><td><button name='addEvent'>Submit</button></td></tr>");
    });
});

    

// function addEventRow() {
    // var table = document.getElementById("offEvents");
    // var row = table.insertRow(-1);
    // var cell0 = row.insertCell(0);
    // var cell1 = row.insertCell(1);
	// var cell2 = row.insertCell(2);
	// var cell3 = row.insertCell(3);
	// var cell4 = row.insertCell(4);
	// var cell5 = row.insertCell(5);
    // cell0.innerHTML = "<input type='text' name='eventTitle' size='10'>";
    // cell1.innerHTML = "<input type='text' name='eventDesc' size='10'>";
	// cell2.innerHTML = "<input type='date' name='eventStartDate'> until <input type='date' name='eventEndDate'>";
	// cell3.innerHTML = " ";
	// cell4.innerHTML = " ";
	// cell5.innerHTML = "<button name='addEvent'>Submit</button></form>";
// }

<?php

if(isset($_POST['addEvent'])) {
	if($_POST['eventTitle']) {
		$title = $_POST['eventTitle'];
		$desc = $_POST['eventDesc'];
		$startdate = $_POST['eventStartDate'];
		$enddate = $_POST['eventEndDate'];
		
		echo $title;
		
		$query="INSERT INTO EVENT (event_title, event_desc, event_start, event_end, event_sub_by, event_status) VALUES ($title, $desc, $startdate, $enddate, 5, 2)";
		$result = mysqli_query($dblink, $sql);
	}
}

?>

</script>


<html>