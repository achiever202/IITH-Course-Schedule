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
   		$instructor_id = mysqli_real_escape_string($connection, $_POST['Instructor_ID']);
   		$off_dept = mysqli_real_escape_string($connection, $_POST['Department_Short_Name']);
   		$start_sem = int(mysqli_real_escape_string($connection, $_POST['Start_Semester']));
   		$end_sem = int(mysqli_real_escape_string($connection, $_POST['End_Semester']));
   		$start_year = int(mysqli_real_escape_string($connection, $_POST['Start_Year']));
   		$end_year = int(mysqli_real_escape_string($connection, $_POST['End_Year']));

   		if($off_dept != "" && $instructor_id == "" && $start_sem == "" && $start_year == "" && $end_sem == "" && $end_year == "")
   		{
   			$sql_query = "SELECT `Course_ID`,`Course_Title` FROM `Courses` WHERE `Department_Short_Name` = '$course_id'";
   			$result = mysqli_query($connection, $sql_query);
   		}
   		else
   		{
   			$str = "";
   			$flag = 0;
   			if($instructor_id != "")
   			{
   				$str .= " `Instructor_Instructor_ID` = 'Instructor_ID'";
   				$flag = 1;
   			}
   			if($off_dept != "")
   			{
   				if($flag == 1)
   					$str .= " AND";
   				$str .= " `Department_Short_Name` = '$off_dept'";
   				$flag = 1;
   			}
   			if($start_year != "" && $start_sem != "")
   			{
   				if($flag == 1)
   					$str .= " AND";
   				$str .= " `Year` > '$start_year' OR (`Year` = '$start_year' AND `Semester` >= '$start_sem')";
   				$flag = 1;
   			}
   			if($end_year != "" && $end_sem != "")
   			{
   				if($flag == 1)
   					$str .= " AND";
   				$str .= " `Year` < '$end_year' OR (`Year` = '$end_year' AND `Semester` <= '$end_sem')";
   				$flag = 0;
   			}
   			$sql_query = "SELECT `Courses_Course_ID`,`Course_Title`,`Semester`,`Year`,`Instructor_Name`,`Department_Short_Name` FROM Instructor,Courses,Offered_Courses ";
   			$sql_query .= "WHERE `Instructor_ID` = `Instructor_Instructor_ID` AND `Courses_Course_ID` = `Course_ID` AND".$str;
   			$result = mysqli_query($connection, $sql_query);
   		}
      	/* error in connection. */
      	if(!$result)
      		die("Error adding course: " . mysqli_error($connection));
	    if(mysqli_query($connection, $sql_query))
	        echo "Course added successfully!";
	    else
	        die("Error adding course: " . mysqli_error($connection));
   	}
   	mysqli_close($connection);
?>
