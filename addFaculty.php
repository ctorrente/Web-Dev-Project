<!DOCTYPE html>
<html>
	<head>
		<title>Add Faculty Module</title>
	</head>
	<?php 
	session_start();
	require('header.php');
	echo "<br><br>";
	require('navbar.php'); 
	?>	
	<br><br><br><br>
	<body>
		<h1>ADD FACULTY MEMBER</h1>
		<hr><br>
		<div style="margin-left: 20%;">
		<form id="addUsers" method="post" action="processFaculty.php">
			<fieldset>
				<legend>Faculty Id</legend>
				<input type="text" name="fid" placeholder="ex. 201110000"></input><br>
			</fieldset>

			<fieldset>
				<legend>Password</legend>
				<input type="password" name="password" placeholder="password"></input><br>
			</fieldset>
			
			<fieldset>
				<legend>Major</legend>
				<select name="major">
					<option value="">--- Select Major ---</option>
					<option value="IT">Information Technology</option>
					<option value="CS">Computer Science</option>
					<option value="IS">Information Systems</option>
				</select>
				<br>
			</fieldset>
			
			<fieldset>
				<legend>First Name</legend>
				<input type="text" name="fname" placeholder="First Name"></input><br>
			</fieldset>

			<fieldset>
				<legend>Middle Name</legend>
				<input type="text" name="mname" placeholder="Middle Name"></input><br>
			</fieldset>

			<fieldset>
				<legend>Last Name</legend>
				<input type="text" name="lname" placeholder="Last Name"></input><br>
			</fieldset>

			<fieldset>
				<legend>Gender</legend>
				<select name="gender">
					<option value="M">Male</option>
					<option value="F">Female</option>
				</select><br>
			</fieldset>

			<fieldset>
				<legend>Birthdate</legend>
				<input type="date" name="bday"></input><br>
			</fieldset>

			<fieldset>
				<legend>Address</legend>
				<textarea rows="5" cols="30" name="address" placeholder="ex. Lot 11 Blk 6 Sinupot Village Barangay Hiwacloy, Naga City"></textarea><br>
			</fieldset>

			<fieldset>
				<legend>Gbox Account</legend>
				<input type="email" name="gbox" placeholder="ex. name@gbox.adnu.edu.ph"></input><br>
			</fieldset>

			<fieldset>
				<legend>Complete Request</legend>
				<input type="submit" value="Add Faculty"></input>
			</fieldset>
		</form>
		</div>
	</body>
</html>