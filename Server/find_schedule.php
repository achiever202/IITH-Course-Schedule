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

         echo '<link href="../UI/css/simple-table.css" rel="stylesheet" type="text/css" />';

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

         /*Putting the Schedule in a 3D array where schedule[day][slot][roomno]*/
         $schedule=array(
               array(array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",)),
               array(array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",)),
               array(array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",)),
               array(array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",)),
               array(array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",)),
               array(array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",),
                     array("","","","","","","","","","","","","","","","","","","","","","",)),
          );
         while($row = $result->fetch_assoc())
         {
               $day = (int)$row["Day_Of_Week"];
               $slot = (int)$row['Slot'];
               $roomno = $row['Room_Number'];
               $course = $row['Courses_Course_ID'];
               $instructor = $row['Instructor_Name'];
               switch ($roomno) {
                  case 'LH3':
                     $room = 0;
                     break;
                  case 'LH2':
                     $room = 1;
                     break;
                  case 'LH1':
                     $room = 2;
                     break;
                  case '116':
                     $room = 3;
                     break;
                  case '118':
                     $room = 4;
                     break;
                  case '120':
                     $room = 5;
                     break;
                  case '121':
                     $room = 6;
                     break;
                  case '123':
                     $room = 7;
                     break;
                  case '126':
                     $room = 8;
                     break;
                  case '127':
                     $room = 9;
                     break;
                  case '128':
                     $room = 10;
                     break;
                  case '129':
                     $room = 11;
                     break;
                  case '130':
                     $room = 12;
                     break;
                  case '131':
                     $room = 13;
                     break;
                  case '132':
                     $room = 14;
                     break;
                  case '133':
                     $room = 15;
                     break;
                  case '134':
                     $room = 16;
                     break;
                  case '201':
                     $room = 17;
                     break;
                  case '202':
                     $room = 18;
                     break;
                  case '203':
                     $room = 19;
                     break;
                  case '204':
                     $room = 20;
                     break;
                  case '205':
                     $room = 21;
                     break;
               }
               $schedule[$day][$slot][$room]= $course.'<br>'.$instructor;
         }

         /*Actually printing the schedule*/
         echo '<html><body><center><h>Semester Schedule</h><br><br>';
         for($day=0;$day<=5;$day++)
         {  
            switch ($day) {
               case 0:
                  echo 'Monday<br>';
                  break;
               case 1:
                  echo 'Tuesday<br>';
                  break;
               case 2:
                  echo 'Wednesday<br>';
                  break;
               case 3:
                  echo 'Thursday<br>';
                  break;
               case 4:
                  echo 'Friday<br>';
                  break;
               case 5:
                  echo 'Saturday<br>';
                  break;
            }
            echo '<table cellpadding="0" cellspacing="0" class="db-table"><tr>';
            echo '<td>Slot/Room No</td>';   
            echo '<td>LH3</td>';
            echo '<td>LH2</td>';
            echo '<td>LH1</td>';

            echo '<td>116</td>';
            echo '<td>118</td>';
            echo '<td>120</td>';

            echo '<td>121</td>';
            echo '<td>123</td>';
            echo '<td>126</td>';

            echo '<td>127</td>';
            echo '<td>128</td>';
            echo '<td>129</td>';

            echo '<td>130</td>';
            echo '<td>131</td>';
            echo '<td>132</td>';

            echo '<td>133</td>';
            echo '<td>134</td>';
            echo '<td>201</td>';

            echo '<td>202</td>';
            echo '<td>203</td>';
            echo '<td>204</td>';
            echo '<td>205</td></tr>';

            $slot=0;
            for ($slot=0; $slot< 5; $slot++) { 
               echo '<tr>';
               switch ($slot) {
                  case 0:
                     echo '<td>8:30am-10am</td>';
                     break;
                  case 1:
                     echo '<td>10:00am-11:30am</td>';
                     break;
                  case 2:
                     echo '<td>11:30am-01:00pm</td>';
                     break;
                  case 3:
                     echo '<td>02:30pm-04:00pm</td>';
                     break;
                  case 4:
                     echo '<td>04:00pm-05:30pm</td>';
                     break;
                  case 5:
                     echo '<td>05:30pm-07:00pm</td>';
                     break;
               }
               for ($room=0; $room < 22; $room++) {
                  echo "<td>".$schedule[$day][$slot][$room]."</td>";
               }
               echo "</tr>";
            }
            echo '</table><br><br>';
         }
         echo '</center><br></body></html>';  
         mysqli_close($connection);
      }
?>
