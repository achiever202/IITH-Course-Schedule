<?php
	
   session_start();

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
         $message = "Connection failed: " . mysqli_connect_error();
         echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/login.php\";</script>";
      }
   	/* for post requests. */
   	if($_POST)
   	{
   		$instructor_id = mysqli_real_escape_string($connection, $_POST['Instructor_ID']);
   		$password = mysqli_real_escape_string($connection, $_POST['Password']);

   		$sql_query = "SELECT * FROM `Instructor` WHERE `Instructor_ID` = '$instructor_id' AND `Instructor_Credentials` = '$password'";
   		$result = mysqli_query($connection, $sql_query);
   		
      	/* error in connection. */
      	if(!$result)
      	{
            $message = mysqli_error($connection);
            echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/login.php\";</script>";
         }
         
         if(mysqli_num_rows($result)==0)
         {
            $message = "Error: Incorrect credentials. Enter the correct name and password";
            echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/login.php\";</script>";
         }
         else
         {
            $row = $result->fetch_assoc();
            $message = "Login successful!";
            
            $_SESSION['username'] = $row["Instructor_Name"];
            $_SESSION['user_id'] = $row["Instructor_ID"];
            $_SESSION['user_department'] = $row["Department_Short_Name"];

            echo "<script type='text/javascript'>confirm(\"" . $message . "\"); window.location=\"http://localhost/IITH-Course-Schedule/UI/home.php\";</script>";
         }
   	}
   	mysqli_close($connection);
?>
