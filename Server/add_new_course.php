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
   	{
         $message = mysqli_connect_error();
         echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/add_course.php\";</script>";
      }

   	/* for post requests. */
   	if($_POST)
   	{
   		$course_id = mysqli_real_escape_string($connection, $_POST['Course_ID']);
   		$course_title = mysqli_real_escape_string($connection, $_POST['Course_Title']);
   		$credits = mysqli_real_escape_string($connection, $_POST['Credits']);
   		$department = mysqli_real_escape_string($connection, $_POST['Department']);

   		/* getting the record from the databse. */
      	$sql_query = "SELECT * FROM `Courses` WHERE `Course_ID`='$course_id' LIMIT 1";
      	$result = mysqli_query($connection, $sql_query);

      	/* error in connection. */
      	if(!$result)
      	{
            $message = mysqli_error($connection);
            echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/add_course.php\";</script>";
            //die("Error adding course: " . mysqli_error($connection));
         }

      	/* if no record found. */
      	if(mysqli_num_rows($result)>0)
      	{
            $message = "Error adding course: Course already exists.";
            echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/add_course.php\";</script>";
            //die("Error adding course: Course already exists.");
         }

      	/* adding the new course. */
	      $sql_query = "INSERT INTO Courses (Course_ID, Course_Title, Credits, Department_Short_Name)
	                     VALUES ('$course_id', '$course_title', '$credits', '$department')";

	      if(mysqli_query($connection, $sql_query))
         {
            $message = "Course added successfully!";
            echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/add_course.php\";</script>";
         }
	      else
         {
            $message = mysqli_error($connection);
            echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/add_course.php\";</script>";
         }
   	}

   	mysqli_close($connection);

?>