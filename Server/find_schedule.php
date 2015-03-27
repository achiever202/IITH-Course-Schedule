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

         echo '<html><link href="../UI/css/table.css" rel="stylesheet" type="text/css" />';
         echo '<link href="../UI/css/style-find-course.css" rel="stylesheet" type="text/css" />';
         echo '<body>';
         echo '<div align="center" class="contact-section text-center" id="CONTACT">';
            echo '<div class="container">';
               echo '<div class="contact-section-head">';
                  echo '<h3>SEMESTER SCHEDULE</h3>';
                  echo '<br><br>';
                  echo '<label></label>';
               echo '</div>';
            echo '</div>';

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
         for($day=0;$day<=5;$day++)
         {  
            echo '<div class="container">';
            echo '<div class="contact-section-head">';
            echo '<h3>';
            switch ($day) {
               case 0:
                  echo 'Monday';
                  break;
               case 1:
                  echo 'Tuesday';
                  break;
               case 2:
                  echo 'Wednesday';
                  break;
               case 3:
                  echo 'Thursday';
                  break;
               case 4:
                  echo 'Friday';
                  break;
               case 5:
                  echo 'Saturday';
                  break;
            }
            
            echo '</h3><br><br>';
            echo '<label></label>';
            echo '</div>';

            echo '<div class="contact-info">';
            echo '<table cellpadding="0" cellspacing="0" class="db-table"><tr>';
            echo '<th></th>';   
            echo '<th>LH3</th>';
            echo '<th>LH2</th>';
            echo '<th>LH1</th>';

            echo '<th>116</th>';
            echo '<th>118</th>';
            echo '<th>120</th>';

            echo '<th>121</th>';
            echo '<th>123</th>';
            echo '<th>126</th>';

            echo '<th>127</th>';
            echo '<th>128</th>';
            echo '<th>129</th>';

            echo '<th>130</th>';
            echo '<th>131</th>';
            echo '<th>132</th>';

            echo '<th>133</th>';
            echo '<th>134</th>';
            echo '<th>201</th>';

            echo '<th>202</th>';
            echo '<th>203</th>';
            echo '<th>204</th>';
            echo '<th>205</th></tr>';

            $slot=0;
            for ($slot=0; $slot< 5; $slot++) { 
               echo '<tr>';
               switch ($slot) {
                  case 0:
                     echo '<th>8:30am-10am</th>';
                     break;
                  case 1:
                     echo '<th>10:00am-11:30am</th>';
                     break;
                  case 2:
                     echo '<th>11:30am-01:00pm</th>';
                     break;
                  case 3:
                     echo '<th>02:30pm-04:00pm</th>';
                     break;
                  case 4:
                     echo '<th>04:00pm-05:30pm</th>';
                     break;
                  case 5:
                     echo '<th>05:30pm-07:00pm</th>';
                     break;
               }
               for ($room=0; $room < 22; $room++) {
                  echo "<td>".$schedule[$day][$slot][$room]."</td>";
               }
               echo "</tr>";
            }
            echo '</table></center><br><br><br><br>';
            echo '</div>';
            echo '</div>';
         }

         echo '</div>';
         echo '</body></html>';  
         mysqli_close($connection);
      }
?>
