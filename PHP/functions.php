<?php
    session_start();
    // functions

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
    function getStudentAvailableBalance($uID)
    {
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
/*
    getStaffAllCourses($uID)
    {
      require 'connect.php';
      $SQL_stmt = "SELECT DISTINCT courseTitle AS 'Course' FROM course
      INNER JOIN departmentsStaffCourseStudents
      ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
      WHERE bscsStaffID = '".$uID"'";
      
      $result = $DBconnection->query($SQL_stmt);
      
      while($row = mysqli_fetch_array($result)) 
      {
         echo '<button class="dropdown-item" type="button">'.$row['courseTitle'].'</button>';
      }
    }*/
?>