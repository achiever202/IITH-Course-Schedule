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
   		$department_short =mysqli_real_escape_string($connection, $_POST['Department']);
   		$course = mysqli_real_escape_string($connection, $_POST['Course_ID']);
   		$start_sem = mysqli_real_escape_string($connection, $_POST['Start_Semester']);
   		$end_sem = mysqli_real_escape_string($connection, $_POST['End_Semester']);
   		$start_year = mysqli_real_escape_string($connection, $_POST['Start_Year']);
   		$end_year = mysqli_real_escape_string($connection, $_POST['End_Year']);

         echo '<link href="../UI/css/simple-table.css" rel="stylesheet" type="text/css" />';
         echo '<html><body><center><h>faculty Info</h><br><br><table cellpadding="0" cellspacing="0" class="db-table">';

   		if($department_short != "Department" && $course == "Course_ID" && $start_sem == "Semester" && $start_year == "Start Year" && $end_sem == "Semester" && $end_year == "End Year")
   		{
   			$sql_query = "SELECT `Instructor_Name` FROM `Instructor` WHERE `Department_Short_Name` = '$department_short'";
   			$result = mysqli_query($connection, $sql_query);
            if(!$result)
               die("Error adding course: " . mysqli_error($connection));
            echo '<tr>';
            echo '<td>Instructor</td>';
            echo '</tr>';
   		}
   		else
   		{
   			$str = "";
   			$flag = 0;
   			if($department_short != "Department")  //Default Values
   			{
   				$str .= " `Department_Short_Name` = '$department_short'";
   				$flag = 1;
   			}
   			if($course != "Course")
   			{
   				if($flag == 1)
   					$str .= " AND";
   				$str .= " `Courses_Course_ID` = '$course'";
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
            $sql_query .= "(SELECT matched_course.*,Instructor_Name, Department_Short_Name FROM (SELECT Offered_Courses.*,Course_Title FROM Offered_Courses,Courses WHERE Course_ID=Courses_Course_ID) matched_course, ";
            $sql_query .= "`Instructor` WHERE Instructor_Instructor_ID=Instructor_ID) final ";
   			$sql_query .= "WHERE".$str;
   			$result = mysqli_query($connection, $sql_query);

            if(!$result)
               die("Error adding course: " . mysqli_error($connection));
            echo '<tr>';
            echo '<td>Course ID</td>';
            echo '<td>Course Title</td>';
            echo '<td>Semester</td>';
            echo '<td>Year</td>';
            echo '<td>Instructor</td>';
            echo '<td>Offering Department</td>';
            echo '</tr>';
   		}
         while($row = mysqli_fetch_row($result))
         {
            echo '<tr>';
            foreach ($row as $key => $value) {
               echo '<td>',$value,'</td>';
            }
            echo '</tr>';
         }
         echo '</table></center><br></body></html>';  
      }
   	mysqli_close($connection);
?>
