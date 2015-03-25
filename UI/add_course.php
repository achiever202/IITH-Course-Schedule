<?php
	/* initializing database variables. */
	$server = 'localhost';
	$database = 'iithcourses';
	$username = 'root';
	$password = '123';

	/* connecting to the databse. */
	$connection = mysqli_connect($server, $username, $password, $database);

	/* checking for successful connection. */
   	if(!$connection)
   		die("Connection failed: " . mysqli_connect_error());

	$sql = "SELECT * FROM `Department`";
	$department_result = mysqli_query($connection, $sql);

	$sql = "SELECT Instructor_ID, Instructor_Name FROM Instructor";
	$instructor_result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>IITH | Add Course</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style-find-course.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="js/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
		});
	});
</script>

<script>
	var number_of_departments = 1;
	function validate_add_course_form()
	{
		var flag = 1;
		var element = document.forms["add_course_form"]["Department"].value;
		if(element==null || element=="" || element=="Department")
			flag = 0;

		var element = document.forms["add_course_form"]["Course_ID"].value;
		if(element==null || element=="" || element=="Course ID")
			flag = 0;

		var element = document.forms["add_course_form"]["Course_Title"].value;
		if(element==null || element=="" || element=="Course Title")
			flag = 0;
		
		var element = document.forms["add_course_form"]["Credits"].value;
		if(element==null || element=="" || element=="Credits")
			flag = 0;

		if(flag==1)
			return true;

		alert("Enter empty fields to add course!");
		return false;
	}

	function validate_offer_course_form()
	{
		var flag = 1;
		var element = document.forms["offer_course_form"]["Course_ID"].value;
		if(element==null || element=="" || element=="Course ID")
			flag = 0;

		var element = document.forms["offer_course_form"]["Instructor_ID"].value;
		if(element==null || element=="" || element=="Instructor ID")
			flag = 0;

		var element = document.forms["offer_course_form"]["Semester"].value;
		if(element==null || element=="" || element=="Semester")
			flag = 0;
		
		var element = document.forms["offer_course_form"]["Year"].value;
		if(element==null || element=="" || element=="Year")
			flag = 0;

		if(flag==1)
			return true;

		alert("Enter empty fields to offer course!");
		return false;
	}

</script>

</head>

<body> 
	<div class="contact-section text-center" id="CONTACT">
		<div class="container">
			<div class="contact-section-head">
				<h3>Add Course</h3>
				<br><br>
				<label></label>
			</div>
			<div class="contact-info">
				<form name="add_course_form" action="http://localhost/IITH/add_new_course.php" method="post" onsubmit="return validate_add_course_form()">
					<input type="text" name="Course_ID" class="text" value="Course ID" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Course ID';}">
					<input type="text" name="Course_Title" class="text" value="Course Title" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Course Title';}">
					
					<select name="Credits">
						<option value="">Credits</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<select name="Department">
						<?php
							while($row = $department_result->fetch_assoc())
							{
								echo "<option value=\"" . $row["Short_Name"] . "\">" . $row["Full_Name"] . "</option>";
							}
						?>
					</select>

					<!--<input type="text" class="text" name="Department" value="Department" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Department';}">-->
					<input type="submit" value="ADD COURSE">
				</form>
			</div>
		</div>
	</div>

	<div class="contact-section text-center" id="CONTACT">
		<div class="container">
			<div class="contact-section-head">
				<h3>Offer Course</h3>
				<br><br>
				<label></label>
			</div>
			<div class="contact-info">
				<form name="offer_course_form" action="http://localhost/IITH/offer_course.php" method="post" onsubmit="return validate_offer_course_form()">
					<input type="text" name="Course_ID" class="text" value="Course ID" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Instructor';}">
					<!--<input type="text" class="text" name="Instructor_ID" value="Instructor ID" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Instructor ID';}">
					<input type="text" name="Semester" class="text" value="Semester" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Semester';}">-->
					
					<select name="Instructor_ID">
						<?php
							while($row = $instructor_result->fetch_assoc())
							{
								echo "<option value=\"" . $row["Instructor_ID"] . "\">" . $row["Instructor_Name"] . "</option>";
							}
						?>
					</select>
					<select name="Semester">
						<option value="0">Fall</option>
						<option value="1">Spring</option>
					</select>
					<input type="text" name="Year" class="text" value="Year" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Year';}">
					<input type="submit" value="OFFER COURSE">
				</form>
			</div>
		</div>
	</div>

	<div class="contact-section text-center" id="CONTACT">
		<div class="container">
			<div class="contact-section-head">
				<h3>Add Slot</h3>
				<br><br>
				<label></label>
			</div>
			<div class="contact-info">
				<form name="slot_form" action="http://localhost/IITH/add_slot.php" method="post" onsubmit="return validate_form()">
					<input type="text" class="text" name="Course_ID" value="Course ID" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Course ID';}">
					<!--<input type="text" name="Room" class="text" value="Room" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Room';}">-->
					<select name="Room">
						<option value="LH3">LH3</option>
						<option value="LH2">LH2</option>
						<option value="LH1">LH1</option>
						<option value="116">116</option>
						<option value="118">118</option>
						<option value="120">120</option>
						<option value="121">121</option>
						<option value="123">123</option>
						<option value="126">126</option>
						<option value="127">127</option>
						<option value="128">128</option>
						<option value="129">129</option>
						<option value="130">130</option>
						<option value="131">131</option>
						<option value="132">132</option>
						<option value="133">133</option>
						<option value="134">134</option>
						<option value="201">201</option>
						<option value="202">202</option>
						<option value="203">203</option>
						<option value="204">204</option>
						<option value="205">205</option>
					</select>
					<select name="Day">
						<option value="0">Monday</option>
						<option value="1">Tuesday</option>
						<option value="2">Wednesday</option>
						<option value="3">Thrusday</option>
						<option value="4">Friday</option>
						<option value="5">Saturday</option>
					</select>
					<select name="Slot">
						<option value="0">08:30 AM - 10:00 AM</option>
						<option value="1">10:00 AM - 11:30 AM</option>
						<option value="2">11:30 AM - 01:00 PM</option>
						<option value="3">02:30 PM - 04:00 PM</option>
						<option value="4">04:00 PM - 05:30 PM</option>
						<option value="5">05:30 PM - 07:00 PM</option>
					</select>
					<input type="submit" value="ADD SLOT">

					<datalist id="day">
						<option class="list_option" value="Monday">
						<option class="list_option" value="Tuesday">
					</datalist>
				</form>
			</div>
		</div>
	</div>
</body>

</html>