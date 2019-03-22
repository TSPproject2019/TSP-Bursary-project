<?php
        session_start();
        require 'connect.php'; 
        $count = 0;
        $q = $_REQUEST["q"];

        $yr = $_REQUEST["yr"];

        if(!empty($q))
        {
            $courseTitle = $q;
            $courseYear = $yr;
            //echo $courseTitle;
           #$courseTitle = $_SESSION['courseTitle'];
            //Because that staff member is on a particular course, all requests belonging to that course should show
            //Select all requests from all students that are on that course title and are linked to the staff member
             $SQL_stmt = "SELECT users.userID AS 'id', users.userAccessGranted AS 'activated', users.userPIN AS 'pin', users.userRegistered AS 'reg',
            CONCAT(users.userFirstName, ' ', users.userLastName) AS 'user',
            course.courseTitle AS 'course' FROM users
            INNER JOIN departmentsStaffCourseStudents ON users.userID = departmentsStaffCourseStudents.bscsStudentID
            AND departmentsStaffCourseStudents.bscsStaffID = '".$uID."'
            INNER JOIN course ON course.courseID = departmentsStaffCourseStudents.bscsCourseID
            AND course.courseTitle = '".$courseTitle."' AND course.courseYear = '".$courseYear."'
            GROUP BY users.userID";
            
            $result = 0;
        
            $result = $DBconnection->query($SQL_stmt); 
    
        if ($result->fetch()==FALSE){
            echo '<tr style align ="middle">
                <th scope="row" colspan ="8">No Students</th>
                </tr>';
          }
          else
          {
              $result = $DBconnection->query($SQL_stmt);
              
              while ($row = $result->fetch())
              {
                  $registed = $row['reg'];//Getting value if user is registered or not.
                  $accessGranted = $row['activated']; //Getting value if the access has been granted or not
                  
                  if($registed == 0)//Do not display activate buton if user is not registered
                  {
                      $registed = "No";
                      
                       echo '<tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['user'].'</td>
                        <td>'.$row['course'].'</td>                    
                        <td>'.$registed.'</td>
                        <td>'.$row['pin'].'</td>
                        <!-- <td><button type="submit" name="submit" class="btn btn-primary" value="send_'.$row['id'].'" >Send PIN</button></td> -->
                        <!-- <td><button href="mailto:'.$row['id'].'@student.lincolncollege.ac.uk?Subject=Bursary Request PIN?Body=<b>'.$row['pin'].'</b>" class="btn btn-primary" value="send_'.$row['id'].'" >Send PIN</button></td> -->
                        <td><a href="mailto:'.$row['id'].'@student.lincolncollege.ac.uk?Subject=Bursary%20Request%20PIN&Body=Your%20Bursary%20Request%20PIN%20=%20'.$row['pin'].'" style="width: 35; height: 20;" class="btn btn-success" title="Email PIN">Email PIN</a></td>
                        <td></td>
                        </tr>';
                  }
                  if($registed == 1 && $accessGranted == 0) //Display activate button only if user is registered
                  {
                       $registed = "Yes";
                       echo '<tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['user'].'</td>
                        <td>'.$row['course'].'</td>                    
                        <td>'.$registed.'</td>
                        <td>'.$row['pin'].'</td>
                        <td></td>
                        <td><button type="button" name="submit" class="btn btn-primary" value="activate_'.$row['id'].'" >Activate</button></td>
                        </tr>';
                  }
                  if($registed == 1 && $accessGranted == 1) //Do not display buttons if user is registered and activated
                  {
                       $registed = "Yes";
                       echo '<tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['user'].'</td>
                        <td>'.$row['course'].'</td>                    
                        <td>'.$registed.'</td>
                        <td>'.$row['pin'].'</td>
                        <td>Registered</td>
                        <td>Activated</td>
                        </tr>';
                  }
              }
          }
        }
?>