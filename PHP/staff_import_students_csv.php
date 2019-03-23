<?php
    session_start();
    require_once 'connect.php';

    $staffid = $_SESSION['userid'];
     echo "Testing CSV import .1.0. </br>";
    //Code that imports an uploaded csv from staff to add his/her students

    if (isset($_POST['import'])) {

        $fileName = $_FILES['file']['tmp_name'];
        echo "Testing CSV import .2.0. </br>";
        if ($_FILES['file']['size'] > 0) {
            $file = fopen($fileName, 'r');
            echo "Testing CSV import .3.0. </br>";
            $count = 0;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                echo "Testing CSV import .4.1. </br>";
                $userid = $column[2];//Store user id for future inserts
                echo "Testing CSV import .4.2. userID: " . $userid . "</br>";
                // ensure that this is a data set and not the header        
            if ($count >= 1){// put it instead if this repleace this if content
                 
                    echo "Testing CSV import .5.1. Dob: " . $column[5] . "</br>";
                    //Generate student email based on ID
                    $studentEmail = $userid . "@student.lincolncollege.ac.uk";
                    $gender = $column[7];
                    echo "Gender is:".$gender."</br>";
                    if($gender == "Male")
                    {
                        $gender = 1;
                        echo "Gender is:".$gender."</br>";
                    }
                    if($gender == "Female")
                    {
                        $gender = 0;
                        echo "Gender is:".$gender."</br>";
                    }
                    echo "Testing CSV import .5.2. </br>";
                    echo $studentEmail;
                    //Insert into users
                    $SQL_stmt = "INSERT INTO users(userID,userFirstName,userLastName,userEmail,userType,userPIN)
                    VALUES('" . $userid . "','" . $column[3] . "','" . $column[4] . "','" . $studentEmail . "', 'Student' , FLOOR( RAND() * (9999-1000) + 1000))
                    ON DUPLICATE KEY UPDATE userID = '".$userid."'";
                    echo "Testing CSV import .5.3. </br>";
                    
                    $DBconnection->exec($SQL_stmt);
                            
                    echo "Testing CSV import .5.4. </br>";
                    //Check the course id to be sure if its full time or part time to generate correct student funds
                    $SQL_stmt = "SELECT course.courseType AS 'type' FROM course 
                    WHERE course.courseID = '" . $column[0] . "'
                    AND course.courseTitle = '" . $column[1] . "'";
                    echo "Testing CSV import .5.5. </br>";
                    $courseType = 0;
                    $result = $DBconnection->query($SQL_stmt);
                    echo "Testing CSV import .5.6. </br>";
                    
                    if ($row = $result->fetch()){
                        $courseType = $row['type'];
                    }
                    echo "Testing CSV import .5.7. </br>";
                    if($courseType == "Full_Time")//If the course is full time
                    {
                         echo "Testing CSV import .5.7.1 </br>";
                        //Insert into students with correct funds (on duplicate key update the balance)
                        //Need gender for student to insert into this table
                        $SQL_stmt = "INSERT INTO student(studentID, dOB, gender, availableBalance)
                        VALUES('" . $userid . "',STR_TO_DATE('".$column[5]."', '%d/%m/%Y'),'" . $gender . "', '500')
                        ON DUPLICATE KEY UPDATE availableBalance = 500";
                        echo "Testing CSV import .5.7.2 </br>";
                        $DBconnection->exec($SQL_stmt);
                         echo "Testing CSV import .5.7.3 </br>";
                        
                    }
                    echo "Testing CSV import .5.8. </br>";
                    if($courseType == "Part_Time")//If the course is part time
                    {
                         echo "Testing CSV import .5.8.1 </br>";
                        //Insert into students with correct funds (on duplicate key update the balance)
                        $SQL_stmt = "INSERT INTO student(studentID, dOB, gender, availableBalance)
                        VALUES('" . $userid . "',STR_TO_DATE('".$column[5]."', '%d/%m/%Y'),'" . $gender . "', 250') 
                        ON DUPLICATE KEY UPDATE availableBalance = 250";
                        
                        $DBconnection->exec($SQL_stmt);
                    }
                    echo "Testing CSV import .5.9. Dob: " . $column[5] . " </br>";
                    
                    //Insert into student to course (link student to the course)
                    $SQL_stmt = "INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
                    VALUES('" . $column[0] . "','" . $userid . "','" . $column[6] . "')
                    ON DUPLICATE KEY UPDATE stcStudentStatus = '"  .$column[6] . "'";
                    echo "Testing CSV import .5.10. </br>";
                    $DBconnection->exec($SQL_stmt);
                    echo "Testing CSV import .5.11. </br>";
                    //Find department that the staff member works in
                    $SQL_stmt = "SELECT stDepartmentID FROM staffToDepartment
                    WHERE stStaffID = '" . $staffid . "'";
                    $departmentID = 0;
                    echo "Testing CSV import .5.12. </br>";
                    $result = $DBconnection->query($SQL_stmt);
                    echo "Testing CSV import .5.13. </br>";
                 
                    if ($row = $result->fetch()){
                         echo "Testing CSV import .5.13..1 </br>";
                        $departmentID = $row['stDepartmentID'];
                         echo "Testing CSV import .5.13.2 </br>";
                    }
                    echo "Testing CSV import .5.14. </br>";
                    echo $departmentID;
                    //Insert into departmentsStaffAndStudents table (link student to staff member, department and course)
                    $SQL_stmt = "INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
                    VALUES('" . $departmentID . "','" . $staffid . "','" . $userid . "','". $column[0] ."')
                    ON DUPLICATE KEY UPDATE bscsStudentID = '".$userid."'";
                    echo "Testing CSV import .5.15. </br>";
                    $DBconnection->exec($SQL_stmt);
                    echo "Testing CSV import .5.16. </br>";
                 /*
                    if (!empty($result)) {
                        $type = "success";
                        $message = "CSV Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing CSV Data";
                    }*/
                    
                }
                $count++;
            }
        }
    }
    
?>