<?php
        session_start();
        require 'connect.php'; 
        $count = 0;
        $q = $_REQUEST["q"];

        $yr = $_REQUEST["yr"];
        
        $lvl = $_REQUEST["lvl"];

        $tp = $_REQUEST["tp"];

        //echo "yr = " . $yr;
        if(!empty($q))
        {
            $courseTitle = $q;
            $courseYear = $yr;
            $courseLevel = $lvl;
            $courseType = $tp;
            
            $SQL_stmt = "";
            
            if($courseType == 'All')
            {
                $SQL_stmt = "SELECT DISTINCT users.userID AS 'Student_ID', users.userFirstName AS 'first', 
                users.userLastName AS 'last',
                student.availableBalance AS 'Available_Balance' FROM users INNER JOIN student ON users.userID = student.studentID
                INNER JOIN departmentsStaffCourseStudents ON users.userID = departmentsStaffCourseStudents.bscsStudentID
                AND departmentsStaffCourseStudents.bscsStaffID = '".$_SESSION['userid']."' 
                AND student.studentID = departmentsStaffCourseStudents.bscsStudentID
                INNER JOIN course ON departmentsStaffCourseStudents.bscsCourseID = course.courseID 
                AND course.courseTitle = '".$courseTitle."'
                AND course.courseYear = '".$courseYear."'
                AND course.courseLevel = '".$courseLevel."'";
            }
            else
            {
                $SQL_stmt = "SELECT DISTINCT users.userID AS 'Student_ID', users.userFirstName AS 'first', 
                users.userLastName AS 'last',
                student.availableBalance AS 'Available_Balance' FROM users INNER JOIN student ON users.userID = student.studentID
                INNER JOIN departmentsStaffCourseStudents ON users.userID = departmentsStaffCourseStudents.bscsStudentID
                AND departmentsStaffCourseStudents.bscsStaffID = '".$_SESSION['userid']."' 
                AND student.studentID = departmentsStaffCourseStudents.bscsStudentID
                INNER JOIN course ON departmentsStaffCourseStudents.bscsCourseID = course.courseID 
                AND course.courseTitle = '".$courseTitle."'
                AND course.courseYear = '".$courseYear."'
                AND course.courseLevel = '".$courseLevel."'
                AND course.courseType = '".$courseType."'"; 
            }
          
        $result = 0;
          
        //$studentName = 0;
          
        $result = $DBconnection->query($SQL_stmt); 
        
        if ($result->fetch()==FALSE){
            echo '<tr style align = "middle">
                <th scope="row" colspan ="3">No Info</th>
                <td><input type="checkbox"></td>
                </tr>';
          }
          else
          {
              $result = $DBconnection->query($SQL_stmt);
              $count = 1;
              while ($row = $result->fetch())
              {
                    echo '<tr>
                    <th scope="row">'.$row['Student_ID'].'</th>
                    <td>'.$row['first'].' '.$row['last'].'</td>
                    <td>'.$row['Available_Balance'].'</td>
                    <td><input type="checkbox" class="checkbox" name="checkbox'.$count.'" value="'.$row['Student_ID'].'" ></td>
                    </tr>';
                  $count++;
              }
          }
        }
?>