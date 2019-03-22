<?php
    require_once 'connect.php';

    $staffid = $_SESSION['userid'];
     echo "Testing CSV import .1.0."
    //Code that imports an uploaded csv from staff to add his/her students

    if (isset($_POST["import"])) {

        $fileName = $_FILES["file"]["tmp_name"];

        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");

            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                //Generate student email based on ID
                $studentEmail = $column[2]+"@student.lincolncollege.ac.uk";
                $gender = $column[7];
                
                if($gender == "Male")
                {
                    $gender = TRUE;
                }
                if($gender == "Female")
                {
                    $gender = FALSE;
                }
                $userid = $column[2];//Store user id for future inserts
                //Insert into users
                $SQL_stmt = "INSERT INTO users (userID,userFirstName,userLastName,userEmail,userType,userPIN)
                VALUES ('" . $userid . "','" . $column[3] . "','" . $column[4] . "','" . $studentEmail . "','" 'Student' "','" 'FLOOR( RAND() * (9999-1000) + 1000)'"')";
                $DBconnection->exec($SQL_stmt);
                
                //Check the course id to be sure if its full time or part time to generate correct student funds
                $SQL_stmt = "SELECT course.courseType AS 'type' FROM course 
                WHERE course.courseID = '".$column[0]."'
                AND course.courseTitle = '".$column[1]."'";
                
                $courseType = 0;
                $result = $DBconnection->query($SQL_stmt);
                
                if ($row = $result->fetch()){
                    $courseType = $row['type'];
                }
                
                if($courseType == "Full_Time")//If the course is full time
                {
                    //Insert into students with correct funds (on duplicate key update the balance)
                    //Need gender for student to insert into this table
                    $SQL_stmt = "INSERT INTO student(studentID, dOB, gender, availableBalance)
                    VALUES('".$userid."','".$column[5]."','".$gender."', 500')
                    ON DUPLICATE KEY UPDATE availableBalance = 500";
                    $DBconnection->exec($SQL_stmt);
                    
                }
                if($courseType == "Part_Time")//If the course is part time
                {
                    //Insert into students with correct funds (on duplicate key update the balance)
                    $SQL_stmt = "INSERT INTO student(studentID, dOB, gender, availableBalance)
                    VALUES('".$userid."','".$column[5]."','".$gender."', 250') 
                    ON DUPLICATE KEY UPDATE availableBalance = 250";
                    $DBconnection->exec($SQL_stmt);
                }
                //Insert into student to course (link student to the course)
                 $SQL_stmt = "INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
                 VALUES('".$column[0]."','".$userid."','".$column[6]."')
                 ON DUPLICATE KEY UPDATE stcStudentStatus = '".$column[6]."'";
                
                $DBconnection->exec($SQL_stmt);
                
                //Find department that the staff member works in
                $SQL_stmt = "SELECT stDepartmentID FROM staffToDepartment
                WHERE stStaffID = '".$staffid."'";
                $departmentID = 0;
                $result = $DBconnection->query($SQL_stmt);
                
                if ($row = $result->fetch()){
                    $departmentID = $row['stDepartmentID'];
                }
                
                //Insert into departmentsStaffAndStudents table (link student to staff member, department and course)
                $SQL_stmt = "INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
                VALUES('".$departmentID."','".$staffid."','".$userid."')";
                
                $DBconnection->exec($SQL_stmt);
                
                if (!empty($result)) {
                    $type = "success";
                    $message = "CSV Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing CSV Data";
                }
            }
        }
    }
    
?>