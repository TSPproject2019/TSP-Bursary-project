<?php
    session_start();
    // functions
    // go back to previous page
    function goBack (){
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }
    // get the totals from the bursaryRequests table using user ID and the request status.  
    function getTotals ($uID, $stat){
        global $totalResult;
        require 'connect.php';//connects to the SQL database.
       # echo " start Step 4.0..<br>"; // for testing purposes
        $SQL_stmt = "SELECT COUNT(*) AS 'Total' FROM bursaryRequests
          INNER JOIN itemsAndRequests WHERE itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
          AND itemsAndRequests.StudentID = " . $uID . " AND bursaryRequests.bRequestsStaffApproved is NULL 
          AND bursaryRequests.bRequestsAdminApproved is NULL 
          AND bRequestsStatus = '" . $stat . "'";
        $totalResult = 0; // just incase this variable is holding any data, but should not be the case
        // now to run the query
        # echo " start Step 4.1..<br>"; // for testing purposes
        // first prepare and excecurte
        $result = $DBconnection->query($SQL_stmt);
        # echo " start Step 4.2..<br>"; // for testing purposes
        // now get the data
        if ($row = $result->fetch()){
            // varify that it is a valid userID
            # echo " start Step 4.2.1..<br>"; // for testing purposes
            // Bind results by column name
            $totalResult = $row['Total'];
            #return $submitTotal;
        }
        return $totalResult;
    }
    //Return staff total submitted requests by staff member
    function getStaffTotals ($uID, $usrType, $stat){
        global $staffTotalResult;
        require 'connect.php';//connects to the SQL database.
        // what is the required query data ?
        if ($usrType = 'Staff'){
            $SQL_stmt = "SELECT COUNT(*) AS 'Total' FROM bursaryRequests
              INNER JOIN itemsAndRequests ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
              AND bursaryRequests.bRequestsStaffID = " . $uID . " AND bursaryRequests.bRequestsStaffRequest = 'TRUE' 
              AND bursaryRequests.bRequestsStaffApproved = 'Yes'
              AND itemsAndRequests.StaffItemApproved = 'Yes'
              AND bRequestsStatus = '" . $stat . "'";
            $staffTotalResult = 0; // just incase this variable is holding any data, but should not be the case
            // now to run the query
            # echo " start Step 4.1..<br>"; // for testing purposes
            // first prepare and excecurte
            $result = $DBconnection->query($SQL_stmt);
            # echo " start Step 4.2..<br>"; // for testing purposes
            // now get the data
            if ($row = $result->fetch()){
                // varify that it is a valid userID
                # echo " start Step 4.2.1..<br>"; // for testing purposes
                // Bind results by column name
                $staffTotalResult = $row['Total'];
                #return $submitTotal;
            }
        }
        return $staffTotalResult;
    }

    // COUNT all staff requests that have been approved
    function getStaffApproved($uID,$usrType,$stat){
      global $staffTotalApprovedResult;
        require 'connect.php';//connects to the SQL database.
        // what is the required query data ?
        if ($usrType = 'Staff'){
            $SQL_stmt = "SELECT COUNT(*) as 'Total' from bursaryRequests 
            INNER JOIN itemsAndRequests ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
            AND bursaryRequests.bRequestsStaffID = ". $uID . " 
            AND bursaryRequests.bRequestsStaffRequest = 'TRUE' 
            AND bursaryRequests.bRequestsAdminApproved = 'Yes' 
            AND bRequestsStatus = '" . $stat . "'";
            $staffTotalApprovedResult = 0; // just incase this variable is holding any data, but should not be the case
            // now to run the query
            # echo " start Step 4.1..<br>"; // for testing purposes
            // first prepare and excecurte
            $result = $DBconnection->query($SQL_stmt);
            # echo " start Step 4.2..<br>"; // for testing purposes
            // now get the data
            if ($row = $result->fetch()){
                // varify that it is a valid userID
                # echo " start Step 4.2.1..<br>"; // for testing purposes
                // Bind results by column name
                $staffTotalApprovedResult = $row['Total'];
                #return $submitTotal;
            }
        }
        return $staffTotalApprovedResult;
    }

    // COUNT all staff requests items that are not delivered yet
    function getStaffAwaitingDelivery($uID,$usrType){
      global $staffTotalOrderedResult;
        require 'connect.php';//connects to the SQL database.
        // what is the required query data ?
        if ($usrType = 'Staff'){
            $SQL_stmt = "SELECT COUNT(*) as 'Total' from bursaryRequests INNER JOIN itemsAndRequests
            ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
            AND bursaryRequests.bRequestsStaffID = ".$uID." 
            AND bursaryRequests.bRequestsStaffRequest = 'TRUE' 
            AND bursaryRequests.bRequestsAdminApproved = 'Yes'
            AND bursaryRequests.bRequestsStaffApproved = 'Yes'
            AND itemsAndRequests.AdminItemApproved = 'Yes'
            AND itemsAndRequests.Ordered = 'TRUE'
            AND bRequestsStatus = 'Approved'";
            $staffTotalOrderedResult = 0; // just incase this variable is holding any data, but should not be the case
            // now to run the query
            # echo " start Step 4.1..<br>"; // for testing purposes
            // first prepare and excecurte
            $result = $DBconnection->query($SQL_stmt);
            # echo " start Step 4.2..<br>"; // for testing purposes
            // now get the data
            if ($row = $result->fetch()){
                // varify that it is a valid userID
                # echo " start Step 4.2.1..<br>"; // for testing purposes
                // Bind results by column name
                $staffTotalOrderedResult = $row['Total'];
                #return $submitTotal;
            }
        }
        return $staffTotalOrderedResult;
    }

    // Get student availableBalance
    function getStudentAvailableBalance($uID){
        global $studentAvailBalance;
        require 'connect.php';
        
        $SQL_stmt = "SELECT availableBalance FROM student
        INNER JOIN users ON student.studentID = users.userID
        WHERE userID = '" . $uID . "'";
        $studentAvailBalance = 0;
        // now to run the query
        # echo " start Step 4.1..<br>"; // for testing purposes
        // first prepare and excecurte
        $result = $DBconnection->query($SQL_stmt);
        # echo " start Step 4.2..<br>"; // for testing purposes
        // now get the data
        if ($row = $result->fetch()){
            // varify that it is a valid userID
            # echo " start Step 4.2.1..<br>"; // for testing purposes
            // Bind results by column name
            $studentAvailBalance = $row['availableBalance'];
        }
      return $studentAvailBalance;
    }

    // Gets all course titles of a particular staff member
    function getStaffAllCourses($uID){
      require 'connect.php';
      $SQL_stmt = "SELECT DISTINCT courseTitle AS 'Course' FROM course
      INNER JOIN departmentsStaffCourseStudents ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
      WHERE bscsStaffID = '". $uID ."'";
      
      $result = $DBconnection->query($SQL_stmt);
                        
      while ($row = $result->fetch())
      {
        echo '<button class="dropdown-item" type="button">  '.$row['Course']. '</button>';
      }                  
    }
    // Gets all course years of a particular staff member
    function getStaffAllCourseYears($uID){
      require 'connect.php';
      $SQL_stmt = "SELECT courseYear AS 'Year' FROM course
      INNER JOIN departmentsStaffCourseStudents
      ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
      WHERE bscsStaffID = '". $uID ."'";
      
      $result = $DBconnection->query($SQL_stmt);
                        
      while ($row = $result->fetch())
      {
        echo '<button class="dropdown-item" name="group" type="button" method="POST">  '.$row['Year']. '</button>';
      }          
    }
    //Get all student requests that are under status of submitted or approved
    function getStudentSubmittedForms($uID)
    {
          require 'connect.php';
          $SQL_stmt = "SELECT bRequestsRequestDate as 'Date_submitted', COUNT(itemsAndRequests.ItemID) AS 'Item_count',
          SUM(IFNULL(brItemPrice,0) + IFNULL(brItemPostage,0) + IFNULL(brItemAdditionalCharges,0))
          AS 'Cost', bRequestsStatus AS 'Status' from bursaryRequests INNER JOIN itemsAndRequests
          ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID
          AND itemsAndRequests.StudentID = ".$uID." INNER JOIN bursaryRequestItems ON
          itemsAndRequests.ItemID = bursaryRequestItems.brItemID 
          AND bursaryRequests.bRequestsStatus = 'Submitted' OR bursaryRequests.bRequestsStatus = 'Approved'
          GROUP BY bursaryRequests.bRequestsID ORDER BY bursaryRequests.bRequestsRequestDate ASC";
            
          $result = $DBconnection->query($SQL_stmt);
          
          while ($row = $result->fetch())
          {
            echo '<tr>
            <th scope="row">'.$row['Date_submitted'].'</td>
            <td>'.$row['Item_count'].'</td>
            <td>'.$row['Cost'].'</td>
            <td>'.$row['Status'].'</td></tr>';
          }           
    }
    //Outputs Student request items for student dependant on status
    function getStudentForms($uID, $stat){
          require 'connect.php';
          $SQL_stmt = "SELECT bursaryRequests.bRequestsRequestDate AS 'date_submitted', brItemDesc AS 'item', 
          SUM(IFNULL(brItemPrice,0) + IFNULL(brItemPostage,0) + IFNULL(brItemAdditionalCharges,0))
          AS 'total_price', COUNT(itemsAndRequests.ItemID) AS 'Item_count', bRequestsStatus AS 'Status' FROM bursaryRequestItems
          INNER JOIN itemsAndRequests ON bursaryRequestItems.brItemID = itemsAndRequests.ItemID 
          AND itemsAndRequests.StudentID = '". $uID ."'
          INNER JOIN bursaryRequests ON bursaryRequests.bRequestsID = itemsAndRequests.RequestID
          AND bursaryRequests.bRequestsStatus = '" . $stat . "'";
            
          $result = $DBconnection->query($SQL_stmt);
    
          while ($row = $result->fetch()){// loop through the existing forms based on the selected status.
                echo '<tr>
                <th scope="row">'.$row['date_submitted'].'</th>
                <td>'.$row['Item_count'].'</td>
                <td>'.$row['item'].'</td>
                <td>'.$row['total_price'].'</td>
                <td>'.$row['Status'].'</td></tr>';
            }
    }
    //Outputs draft request items for student
    function getStudentDraftItems($uID)
    { 
          require 'connect.php';
          $SQL_stmt = "SELECT bursaryRequests.bRequestsID AS 'id', bursaryRequests.bRequestsRequestDate AS 'date_submitted', brItemDesc AS 'item', 
          SUM(IFNULL(brItemPrice,0) + IFNULL(brItemPostage,0) + IFNULL(brItemAdditionalCharges,0))
          AS 'total_price' FROM bursaryRequestItems
          INNER JOIN itemsAndRequests ON bursaryRequestItems.brItemID = itemsAndRequests.ItemID 
          AND itemsAndRequests.StudentID = '". $uID ."'
          INNER JOIN bursaryRequests ON bursaryRequests.bRequestsID = itemsAndRequests.RequestID
          AND bursaryRequests.bRequestsStatus = 'Draft'
          GROUP BY bursaryRequests.bRequestsID ORDER BY bursaryRequests.bRequestsRequestDate ASC";
          
          $requestid = 0;
          $count = 1;
      
          $result = $DBconnection->query($SQL_stmt);
    
          if ($result->fetch()==FALSE){//if query returns nothing
            echo '<tr>
                <th scope="row">No Drafts</th>
                <td>No Drafts</td>
                <td>No Drafts</td>
                </tr>';
          }
          else //If there is a result
          {
            #$count = 1;
            $result = $DBconnection->query($SQL_stmt); //Need to execute query again!
            while ($row = $result->fetch())
            {
                  //UNDER TESTING AND DEVELOPMENT
                  //$requestid = $row['id']; //Capture request id each time in a loop for edit and delete buttons!
                  echo '<tr>
                  <th scope="row" name="requestDateSaved'.$count.'">'.$row['date_submitted'].'</th>
                  <td name="fieldRequestId'.$count.'" value="'.$row['id'].'">'.$row['id'].'</td>
                  <td name="fieldRequestItem'.$count.'">'.$row['item'].'</td>
                  <td name="fieldRequestTotalPrice'.$count.'">£'.$row['total_price'].'</td> 
                  <th><span style="float:left"><button type="submit" name="submit" value="edit_'.$row['id'].'" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">Edit </button></span></th>
                  <td><button type="submit" name="submit" value="delete_'.$row['id'].'" class="btn btn-primary">Delete</button></td></tr>';
                  $count++;
            }
           $_SESSION['draftCounter'] = $count;
          }
    }
/*
    function deleteStudentDraft($requestID) {
      
      require 'connect.php'; //still working on this 
      $SQL_stmt = "DELETE FROM bursaryRequests WHERE bRequestsID = $requestID"; 
      
      //do i need a requestID variable here? such as $requestID = 0 
      
      $result = $DBconnection->query($SQL_stmt);
      
    }*/

    //Gets staff draft items on staff review drafts page.
    function getStaffDraftItems($uID)
    { 
          require 'connect.php';
          $SQL_stmt = "SELECT bursaryRequests.bRequestsRequestDate AS 'request_Date', COUNT(itemsAndRequests.ItemID) AS 'item_count',
          SUM(IFNULL(bursaryRequestItems.brItemPrice,0) + IFNULL(bursaryRequestItems.brItemPostage,0) + 
          IFNULL(bursaryRequestItems.brItemAdditionalCharges,0)) AS 'total_price' FROM bursaryRequests
          INNER JOIN itemsAndRequests ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID
          INNER JOIN bursaryRequestItems ON itemsAndRequests.ItemID = bursaryRequestItems.brItemID
          AND bursaryRequests.bRequestsStaffRequest = 'TRUE'
          AND bursaryRequests.bRequestsStatus = 'Draft'
          AND bursaryRequests.bRequestsStaffID = '". $uID ."'
          GROUP BY bursaryRequests.bRequestsID ORDER BY bursaryRequests.bRequestsRequestDate ASC";
            
          $result = $DBconnection->query($SQL_stmt);
      
          if ($result->fetch()==FALSE){
            echo '<tr>
                <th scope="row">No Drafts</th>
                <td>No Drafts</td>
                <td>No Drafts</td>
                </tr>';
          }
          else
          {
            $result = $DBconnection->query($SQL_stmt);//Query needs to be executed again.
              while ($row = $result->fetch())
              {
                    echo '<tr>
                    <th scope="row">'.$row['request_Date'].'</th>
                    <td>'.$row['item_count'].'</td>
                    <td>£'.$row['total_price'].'</td>
                    <th><span style="float:left"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">Edit </button></span></th>
                    <td><button type="button" class="btn btn-primary" >Delete</button></td></tr>';
              }
          }
      }
?>