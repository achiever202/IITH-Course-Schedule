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
   		$off_dept = mysqli_real_escape_string($connection, $_POST['Department']);
   		$start_sem = mysqli_real_escape_string($connection, $_POST['Start_Semester']);
   		$end_sem = mysqli_real_escape_string($connection, $_POST['End_Semester']);
   		$start_year = mysqli_real_escape_string($connection, $_POST['Start_Year']);
   		$end_year = mysqli_real_escape_string($connection, $_POST['End_Year']);

   		if($off_dept != "Department" && $instructor_id == "Instructor" && $start_sem == "Start Semester" && $start_year == "Start Year" && $end_sem == "End Semester" && $end_year == "End Year")
   		{
   			$sql_query = "SELECT `Course_ID`,`Course_Title` FROM `Courses` WHERE `Courses`.`Department_Short_Name` = '$off_dept'";
   			$result = mysqli_query($connection, $sql_query);
   		}
   		else
   		{
   			$str = "";
   			$flag = 0;
   			if($instructor_id != "Instructor")  //Default Values
   			{
   				$str .= " `Instructor_Instructor_ID` = '$instructor_id'";
   				$flag = 1;
   			}
   			if($off_dept != "Department")
   			{
   				if($flag == 1)
   					$str .= " AND";
   				$str .= " `Department_Short_Name` = '$off_dept'";
   				$flag = 1;
   			}
   			if($start_year != "Start Year" && $start_sem != "Start Semester")
   			{
   				if($flag == 1)
   					$str .= " AND";
   				$str .= " (`Year` > '$start_year') OR (`Year` = '$start_year' AND `Semester` >= '$start_sem')";
   				$flag = 1;
   			}
   			if($end_year != "End Year" && $end_sem != "End Semester")
   			{
   				if($flag == 1)
   					$str .= " AND";
   				$str .= " `Year` < '$end_year' OR (`Year` = '$end_year' AND `Semester` <= '$end_sem')";
   				$flag = 0;
   			}

            $sql_query = "SELECT `Courses_Course_ID`,`Course_Title`,`Semester`,`Year`,`Instructor_Name`,`Department_Short_Name` FROM ";
            $sql_query .= "(SELECT * FROM (SELECT Offered_Courses.*,Instructor_Name FROM Instructor,Offered_Courses WHERE Instructor_ID=Instructor_Instructor_ID) ins_course, `Courses` WHERE Courses_Course_ID=Course_ID) final ";
   			$sql_query .= "WHERE".$str;
   			$result = mysqli_query($connection, $sql_query);
   		}
      	/* error in connection. */
      	if(!$result)
      		die("Error adding course: " . mysqli_error($connection));
         echo "Number of rows".mysqli_num_rows($result);
   	}
   	mysqli_close($connection);
?>
