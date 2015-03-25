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
   		$day = (int) mysqli_real_escape_string($connection, $_POST['Day']);
   		$room = mysqli_real_escape_string($connection, $_POST['Room']);
   		$slot = (int) mysqli_real_escape_string($connection, $_POST['Slot']);

         $sql_query = "SELECT ID FROM `Offered_Courses` WHERE `Courses_Course_ID` = '$course_id' AND `Offered_Courses`.`Semester` = (SELECT max(Semester) FROM Active_Semesters) AND `Offered_Courses`.`Year` = (SELECT max(Year) FROM Active_Semesters)";
         $result = mysqli_query($connection, $sql_query);

         /* error in connection. */
         if(!$result)
            die("Error adding slot: " . mysqli_error($connection));

         if(mysqli_num_rows($result)==0)
            die("Error adding slot: Course not offered in current semester.");

         $row = $result->fetch_assoc();
         $offered_course_id = $row["ID"];

   		/* checking if the slot is available. */
      	$sql_query = "SELECT * FROM `Schedule` WHERE `Room_Number` = '$room' AND `Day_Of_Week` = '$day' AND `Slot` = '$slot' LIMIT 1";
      	$result = mysqli_query($connection, $sql_query);

      	/* error in connection. */
      	if(!$result)
      		die("Error adding course: " . mysqli_error($connection));

      	/* if record found. */
      	if(mysqli_num_rows($result)>0)
      		die("Error addding slot: Slot not available.");

      	/* adding the new course. */
	      $sql_query = "INSERT INTO Schedule (Room_Number, Slot, Day_Of_Week, Offered_Courses_ID)
	                     VALUES ('$room', '$slot', '$day', '$offered_course_id')";

	    if(mysqli_query($connection, $sql_query))
	        echo "Slot added successfully!";
	    else
	        die("Error adding slot: " . mysqli_error($connection));
   	}

   	mysqli_close($connection);

?>