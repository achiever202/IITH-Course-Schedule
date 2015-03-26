<?php
	
	/* initializing database variables. */
	$server = 'localhost';
	$database = 'iithcourses';
	$username = 'root';
	$password = '';
	/* connecting to the databse. */
	$connection = mysqli_connect($server, $username, $password, $database);
	/* checking for successful connection. */
   	if(!$connection)
   		die("Connection failed: " . mysqli_connect_error());
   	/* for post requests. */
   	if($_POST)
   	{
   		$instructor_id = mysqli_real_escape_string($connection, $_POST['Instructor']);
   		$password = mysqli_real_escape_string($connection, $_POST['Password']);

   		$sql_query = "SELECT * FROM `Instructor` WHERE `Instructor_ID` = '$instructor_id' AND `Instructor_Credentials` = '$password'";
   		$result = mysqli_query($connection, $sql_query);
   		
      	/* error in connection. */
      	if(!$result)
      		die("Error adding course: " . mysqli_error($connection));
         if(mysqli_num_rows($result)==0)
            echo "Error: Incorrect credentials. Enter the correct name and password";
         else
            echo "Welcome. You are authenticated by us";
   	}
   	mysqli_close($connection);
?>
