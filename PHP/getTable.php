<?php
        session_start();
        require 'connect.php'; 
        $count = 0;
        $q = $_REQUEST["q"];

        $yr = $_REQUEST["yr"];
        
        $lvl = $_REQUEST["lvl"];

        //echo "yr = " . $yr;
        if(!empty($q))
        {
            $courseTitle = $q;
            $courseYear = $yr;
            $courseLevel = $lvl;
            //echo $courseTitle;
           #$courseTitle = $_SESSION['courseTitle'];
            //Because that staff member is on a particular course, all requests belonging to that course should show
            //Select all requests from all students that are on that course title and are linked to the staff member
             $SQL_stmt = "SELECT users.userID AS 'Student_ID', 
             bursaryRequests.bRequestsID AS 'Request_ID',
             CONCAT(users.userFirstName,' ',users.userLastName) AS 'Student_Name',
             student.availableBalance AS 'balance',
             bursaryRequests.bRequestsRequestDate AS 'Date_submitted',
             SUM(IFNULL(bursaryRequestItems.brItemPrice,0) + IFNULL(bursaryRequestItems.brItemPostage,0) + IFNULL(bursaryRequestItems.brItemAdditionalCharges,0)) AS 'Total_price',
             bursaryRequests.bRequestsStatus AS 'Status' FROM users
             INNER JOIN itemsAndRequests ON users.userID = itemsAndRequests.StudentID
             INNER JOIN student ON student.studentID = users.userID
             INNER JOIN bursaryRequests ON bursaryRequests.bRequestsID = itemsAndRequests.RequestID
             AND bursaryRequests.bRequestsStaffID = '".$_SESSION['userid']."'    
             AND bursaryRequests.bRequestsStatus = 'Submitted'
             AND bursaryRequests.bRequestsStaffApproved IS NULL
             INNER JOIN bursaryRequestItems ON bursaryRequestItems.brItemID = itemsAndRequests.ItemID
             INNER JOIN course ON course.courseID = bursaryRequests.bRequestsCourseID
             AND course.courseTitle = '".$courseTitle."'
             AND course.courseYear = '".$courseYear."'
             AND course.courseLevel = '".$courseLevel."'
             GROUP BY bursaryRequests.bRequestsID
             ORDER BY bursaryRequests.bRequestsRequestDate DESC";
        
        $result = $DBconnection->query($SQL_stmt); 
        
        if ($result->fetch()==FALSE){
            echo '<tr align="middle">
                <th scope="row" colspan="7">No Submissions</th>
                </tr>';
          }
          else
          {
            $result = $DBconnection->query($SQL_stmt);
        
            while ($row = $result->fetch())
            {
                echo '<tr>
                <th>'.$row['Student_ID'].'</td>
                <td>'.$row['Student_Name'].'</td>
                <td>'.$row['Request_ID'].'</td>
                <td>'.$row['Date_submitted'].'</td>
                <td>'.$row['Total_price'].'</td>
                <td>'.$row['balance'].'</td>
                <td>'.$row['Status'].'</td>
                <td><span style="float:left"><button type="submit" name="submit" value="open_'.$row['Request_ID'].'" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">Open</button></span></td></tr>';
            }
          }
        }
?>