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
   		$semester = mysqli_real_escape_string($connection, $_POST['Semester']);
   		$year = mysqli_real_escape_string($connection, $_POST['Year']);

         $sql_query = "SELECT `timetable`.* , `Instructor`.`Instructor_Name`
                  FROM (
                  SELECT `Courses_Course_ID`, `Instructor_Instructor_ID`, `Room_Number`, `Slot`, `Day_Of_Week`
                  FROM `Offered_Courses`, `Schedule`
                  WHERE Offered_Courses.ID = Schedule.Offered_Courses_ID
                  AND Offered_Courses.Semester =$semester
                  AND Offered_Courses.Year =$year
                  )timetable, Instructor
                  WHERE Instructor_Instructor_ID = Instructor_ID";
			$result = mysqli_query($connection, $sql_query);
         /* error in connection. */
         if(!$result)
            die("Error adding course: " . mysqli_error($connection));
         echo mysqli_num_rows($result);
         mysqli_close($connection);
		}
?>
