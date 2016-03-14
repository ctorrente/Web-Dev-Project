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

		<script src="js/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/script.js"></script>
		<script src="js/home.js"></script>
		

		<title>Adnu DCS</title>

		<style type="text/css">

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

			

			<!--start calendar-->
<div class="calendar-container">
    <h1 class="year">August 2016</h1>
    <a href="#" class="btn">&#10133; Add</a>
    <a href="#" class="btn">Edit</a>	
    <a href="#" class="btn">Delete</a>	
    
      <table class="calendar">
        <thead>
          <tr>
            <td>Mon</td>
            <td>Tue</td>
            <td>Wed</td>
            <td>Thu</td>
            <td>Fri</td>
            <td>Sat</td>
            <td>Sun</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="prev-month">29</td>
            <td class="prev-month">30</td>
            <td class="prev-month">31</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
          </tr>
          <tr>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>11</td>
          </tr>
          <tr>
            <td>12</td>
            <td>13</td>
            <td>14</td>
            <td>15</td>
            <td>16</td>
            <td>17</td>
            <td class="current-day">18</td>
          </tr>
          <tr>
            <td>19</td>
            <td>20</td>
            <td>21</td>
            <td>22</td>
            <td>23</td>
            <td>24</td>
            <td>25</td>
          </tr>
          <tr>
            <td>26</td>
            <td>27</td>
            <td>28</td>
            <td>29</td>
            <td>30</td>
            <td>31</td>
            <td class="next-month">1</td>
          </tr>
        </tbody>
      </table>					
    </div>

			<!--end calendar-->

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
