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

   	/* for post requests. */
   	if($_POST)
   	{
   		$course_id = mysqli_real_escape_string($connection, $_POST['Course_ID']);
   		$instructor_id = (int) mysqli_real_escape_string($connection, $_POST['Instructor_ID']);
   		$semester = (int) mysqli_real_escape_string($connection, $_POST['Semester']);
   		$year = (int) mysqli_real_escape_string($connection, $_POST['Year']);

   		/* getting the record from the databse. */
      	$sql_query = "SELECT * FROM `Offered_Courses` WHERE `Courses_Course_ID`='$course_id' AND `Semester` = '$semester' AND `Year` = '$year' LIMIT 1";
      	$result = mysqli_query($connection, $sql_query);

      	/* error in connection. */
      	if(!$result)
      		die("Error adding course: " . mysqli_error($connection));

      	/* if record found. */
      	if(mysqli_num_rows($result)>0)
      		die("Error offereing course: Course already offered in the entered semester.");

      	/* adding the new course. */
	    $sql_query = "INSERT INTO Offered_Courses (Courses_Course_ID, Semester, Year, Instructor_Instructor_ID)
	                     VALUES ('$course_id', '$semester', '$year', '$instructor_id')";

	    if(mysqli_query($connection, $sql_query))
	        echo "Course offered successfully!";
	    else
	        die("Error offering given course: " . mysqli_error($connection));
   	}

   	mysqli_close($connection);

?>