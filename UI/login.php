<?php
	session_start();
	if(isset($_SESSION['username']))
		header('Location: http://localhost/IITH-Course-Schedule/UI/home.php');

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

	$sql = "SELECT Instructor_ID, Instructor_Name FROM Instructor ORDER BY Instructor_Name ASC";
	$instructor_result = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>IITH | Find Courses</title>
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
	function validate_form()
	{

		var Start_Semester = document.forms["instructor_form"]["Start_Semester"].value;
		var Start_Year = document.forms["instructor_form"]["Start_Year"].value;
		var End_Semester = document.forms["instructor_form"]["End_Semester"].value;
		var End_Year = document.forms["instructor_form"]["End_Year"].value;
		var Department = document.forms["instructor_form"]["Department"].value;
		var Course_ID = document.forms["instructor_form"]["Course_ID"].value;

		var filled_fields = 0, start_semester=0, end_semester=0, start_year=0, end_year=0;
		if(Start_Semester!="Semester")
		{
			filled_fields  = filled_fields+1;
			start_semester = 1;
		}

		if(Start_Year!="Start Year")
		{
			filled_fields = filled_fields+1;
			start_year = 1;
		}

		if(Department!="Department")
			filled_fields = filled_fields+1;

		if(Course_ID!="Course_ID")
			filled_fields = filled_fields+1;

		if(End_Semester!="Semester")
		{
			filled_fields = filled_fields+1;
			end_semester = 1;
		}

		if(End_Year!="End Year")
		{
			filled_fields = filled_fields+1;
			end_year = 1;
		}
		

		if(filled_fields==0)
		{
			alert("Please fill at least one field.");
			return false;
		}

		if(start_semester+start_year==1)
		{
			alert("Please fill both start semester and year.");
			return false;
		}

		if(end_semester+end_year==1)
		{
			alert("Please fill both end semester and year.");
			return false;
		}

		return true;
		
	}
</script>

</head>

<body> 
	<div class="contact-section text-center" id="CONTACT">
		<div class="container">
			<div class="contact-section-head">
				<h3>Log In</h3>
				<br><br>
				<label></label>
			</div>
			<div class="contact-info">
				<form name="login_form" action="http://localhost/IITH-Course-Schedule/Server/verify_account.php" method="post" onsubmit="return validate_form()">
					<select name="Instructor_ID">
						<option value="Instructor">Instructor</option>
						<?php
							while($row = $instructor_result->fetch_assoc())
							{
								echo "<option value=\"" . $row["Instructor_ID"] . "\">" . $row["Instructor_Name"] . "</option>";
							}
						?>
					</select>
					<br/>
					<input type="password" class="text" name="Password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
					<br/>
					<input type="submit" value="LOG IN">
				</form>
			</div>
		</div>
	</div>
</body>

</html>