<?php
    session_start();
    // functions
    // go back to previous page
    function goBack (){
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }
    //function to get all requests under status submitted
    function getAdminSubmitted()
    {
        require 'connect.php';
        
        $SQL_stmt = "SELECT COUNT(*) AS 'Total' FROM bursaryRequests 
        WHERE bRequestsStatus = 'Submitted'";
        
        $totalResult = 0; 
        
        $result = $DBconnection->query($SQL_stmt);
        
        if ($row = $result->fetch()){
            
            $totalResult = $row['Total'];
        }
        return $totalResult;
    }
    //function to get all requests under status approved
    function getAdminApproved()
    {
        require 'connect.php';
        
        $SQL_stmt = "SELECT COUNT(*) AS 'Total' FROM bursaryRequests
        WHERE bRequestsStatus = 'Approved'";
        
        $totalResult = 0; 
        
        $result = $DBconnection->query($SQL_stmt);
        
        if ($row = $result->fetch()){
            
            $totalResult = $row['Total'];
        }
        return $totalResult;
    }
    //function to get all request items that are ordered but not delivered and are approved
    function getAdminAwaitingDelivery()
    {
        require 'connect.php';
        
        $SQL_stmt = "SELECT COUNT(DISTINCT ItemID) AS 'Total' FROM itemsAndRequests
        WHERE itemsAndRequests.Ordered = 'TRUE' AND itemsAndRequests.Delivered = 'FALSE'
        AND itemsAndRequests.StaffItemApproved = 'Yes' 
        AND itemsAndRequests.AdminItemApproved = 'Yes'";
        
        $totalResult = 0; 
        
        $result = $DBconnection->query($SQL_stmt);
        
        if ($row = $result->fetch()){
            
            $totalResult = $row['Total'];
        }
        return $totalResult;
    }
    function getStudentAwaitingDelivery($uID)
    {
        require 'connect.php';//connects to the SQL database.
        $SQL_stmt = "SELECT COUNT(DISTINCT ItemID) AS 'Total' FROM itemsAndRequests
        WHERE itemsAndRequests.StudentID = " . $uID . "
        AND itemsAndRequests.Ordered = 'TRUE'
        AND itemsAndRequests.Delivered IS NULL
        AND itemsAndRequests.StaffItemApproved = 'Yes'
        AND itemsAndRequests.AdminItemApproved = 'Yes'";
        $totalResult = 0;
        
        $result = $DBconnection->query($SQL_stmt);
       
        if ($row = $result->fetch()){
            
            $totalResult = $row['Total'];
          
        }
        return $totalResult;
    }
    // get the totals from the bursaryRequests table using user ID and the request status.  
    function getTotals ($uID, $stat){
        global $totalResult;
        require 'connect.php';//connects to the SQL database.
       # echo " start Step 4.0..<br>"; // for testing purposes
        $SQL_stmt = "SELECT COUNT(bRequestsID) AS 'Total' FROM bursaryRequests
          INNER JOIN itemsAndRequests WHERE itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
          AND itemsAndRequests.StudentID = " . $uID . "
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
    //Outputting the total of items that have been delivered to the student user
    function getDelivered ($uID)
    {
        require 'connect.php';
        $SQL_stmt = "SELECT COUNT(bursaryRequestItems.brItemID) AS 'Total' FROM bursaryRequestItems
              INNER JOIN itemsAndRequests ON itemsAndRequests.ItemID = bursaryRequestItems.brItemID 
              AND itemsAndRequests.StudentID = '" . $uID . "' 
              AND itemsAndRequests.StaffItemApproved = 'Yes'
              AND itemsAndRequests.AdminItemApproved = 'Yes'
              AND itemsAndRequests.Ordered = 'TRUE'
              AND itemsAndRequests.Delivered = 'TRUE'";
            $deliveredTotal = 0; 
        
            $result = $DBconnection->query($SQL_stmt);
            
            if ($row = $result->fetch()){
                
                $deliveredTotal = $row['Total'];
  
            }
        return $deliveredTotal; 
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
        echo '<button class="dropdown-item" type="button" value="'.$row['Course'].'" onclick="showYear(this.value)">  '.$row['Course']. '</button>';
      }                  
    }
    // Gets all course years of a particular staff member
    function getStaffAllCourseYears($uID){
      require 'connect.php';
      $SQL_stmt = "SELECT DISTINCT courseYear AS 'Year' FROM course
      INNER JOIN departmentsStaffCourseStudents
      ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
      WHERE bscsStaffID = '". $uID ."' ORDER BY course.courseYear ASC";
      
      $result = $DBconnection->query($SQL_stmt);
                        
      while ($row = $result->fetch())
      {
        echo '<button class="dropdown-item" name="group" value="'.$row['Year'].'" type="button" onclick="showLevel(this.value)">  '.$row['Year']. '</button>';
      }          
    }

     function getStaffAllCourseLevels($uID){
           require 'connect.php'; 
      
           $SQL_stmt = "SELECT DISTINCT courseLevel AS 'Level' FROM course
           INNER JOIN departmentsStaffCourseStudents
           ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
           WHERE bscsStaffID = '". $uID ."' ORDER BY course.courseLevel ASC";
      
          $result = $DBconnection->query($SQL_stmt);
                        
          while ($row = $result->fetch())
          {
            echo '<button class="dropdown-item" name="group" type="button" value="'.$row['Level'].'" onclick="showCourses(this.value)">  '.$row['Level']. '</button>';
          }                
      }          

    //Get all student requests that are under status of submitted or approved
    function getStudentSubmittedForms($uID)
    {
          require 'connect.php';
          $SQL_stmt = "SELECT bRequestsID AS 'id', bRequestsRequestDate as 'Date_submitted', COUNT(itemsAndRequests.ItemID) AS 'Item_count',
          SUM(IFNULL(brItemPrice,0) + IFNULL(brItemPostage,0) + IFNULL(brItemAdditionalCharges,0))
          AS 'Cost', bRequestsStatus AS 'Status', bRequestsStaffApproved AS 'staff', 
          bRequestsAdminApproved AS 'admin' from bursaryRequests INNER JOIN itemsAndRequests
          ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID
          AND itemsAndRequests.StudentID = ".$uID." INNER JOIN bursaryRequestItems ON
          itemsAndRequests.ItemID = bursaryRequestItems.brItemID 
          AND bursaryRequests.bRequestsStatus = 'Submitted' OR bursaryRequests.bRequestsStatus = 'Approved' OR bursaryRequests.bRequestsStatus = 'Cancelled'
          GROUP BY bursaryRequests.bRequestsID ORDER BY bursaryRequests.bRequestsRequestDate DESC";
        
          $staff = 0;
          $admin = 0;
            
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
            $staff = $row['staff'];//Retrieve staff verdict
            $admin = $row['admin'];//Retrieve admin verdict
            //echo $admin;
            //echo $staff;
            //If staff or admin approves or hasnt approved yet
            if($staff == 'No' || $admin == 'No')
            {
                //Output status as rejected
                echo '<tr>
                <th scope="row">'.$row['Date_submitted'].'</td>
                <td>'.$row['Item_count'].'</td>
                <td>'.$row['Cost'].'</td>
                <td>Rejected</td>
                <td><span style="float:left"><button type="submit" name="submit" value="openRejected_'.$row['id'].'" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">Open</button></span></td>
                </tr>';
            }
            else
            {
                echo '<tr>
                <th scope="row">'.$row['Date_submitted'].'</td>
                <td>'.$row['Item_count'].'</td>
                <td>'.$row['Cost'].'</td>
                <td>'.$row['Status'].'</td>
                <td><span style="float:left"><button type="submit" name="submit" value="openSubmitted_'.$row['id'].'" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">Open</button></span></td>
                </tr>';
            }
             }
          }
    }

    
    function getStaffStudentSubmitted($uID) 
    {
        require 'connect.php'; 
        $count = 0;
        
        $courseTitle = $_SESSION['courseTitle'];
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
             AND bursaryRequests.bRequestsStaffID = '".$uID."'    
             AND bursaryRequests.bRequestsStatus = 'Submitted'
             AND bursaryRequests.bRequestsStaffApproved IS NULL
             INNER JOIN bursaryRequestItems ON bursaryRequestItems.brItemID = itemsAndRequests.ItemID
             INNER JOIN course ON course.courseID = bursaryRequests.bRequestsCourseID
             AND course.courseTitle = '".$courseTitle."'
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
            echo '<tr style align = "middle">
                <th scope="row" colspan="6">No Existing Drafts</th>
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
          bursaryRequests.bRequestsID AS 'request_id',
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
            echo '<tr style align ="middle">
                <th scope="row" colspan="6" >No Existing Drafts</th>
                </tr>';
          }
          else
          {
              $result = $DBconnection->query($SQL_stmt);//Query needs to be executed again.
              while ($row = $result->fetch())
              {
                    echo '<tr>
                    <th scope="row">'.$row['request_Date'].'</th>
                    <td>'.$row['request_id'].'</th>
                    <td>'.$row['item_count'].'</td>
                    <td>'.$row['total_price'].'</td>
                    <th><span style="float:left"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">Edit </button></span></th>
                    <td><button type="button" class="btn btn-primary" >Delete</button></td></tr>';
              }
          }
      }

    function getStaffHistory($uID) //Nick, This is a weird one.. The function works but it doesnt, 
        //It shows a blank table but does not show "No History" like it should if there are no results, it displays 
        //a blank table as if there ARE results but they're just not showing. I think line 539 might be the problem but cant quite figure it out
        //The terminal is returning an empty set which is good because that means the query is right (I think lol)
    {

        require 'connect.php'; 

        $courseTitle = $_SESSION['courseTitle'];
        
        $SQL_stmt = "SELECT users.userID AS 'Student_ID', bursaryRequests.bRequestsID AS 'Request_ID',
             CONCAT(users.userFirstName,' ',users.userLastName) AS 'Student_Name',
             bursaryRequests.bRequestsRequestDate AS 'Date_submitted',
             SUM(IFNULL(bursaryRequestItems.brItemPrice,0) + IFNULL(bursaryRequestItems.brItemPostage,0) + IFNULL(bursaryRequestItems.brItemAdditionalCharges,0)) AS 'Total_price',
             bursaryRequests.bRequestsStatus AS 'Status' FROM users
             INNER JOIN itemsAndRequests ON users.userID = itemsAndRequests.StudentID 
             INNER JOIN bursaryRequests ON bursaryRequests.bRequestsID = itemsAndRequests.RequestID
             AND bursaryRequests.bRequestsStaffID = '".$uID."'
             AND bursaryRequests.bRequestsStatus NOT LIKE 'Draft'
             AND bursaryRequests.bRequestsStaffRequest = 'TRUE'
             INNER JOIN bursaryRequestItems ON bursaryRequestItems.brItemID = itemsAndRequests.ItemID
             INNER JOIN course ON course.courseID = bursaryRequests.bRequestsCourseID
             AND course.courseTitle = '".$courseTitle."'
             GROUP BY bursaryRequests.bRequestsID
             ORDER BY bursaryRequests.bRequestsRequestDate DESC"; 

        $result = $DBconnection->query($SQL_stmt); 

        if ($result->fetch()==FALSE){
           echo '<tr style align ="middle">
              <th scope="row" colspan="6" >No History</th>
              </tr>';
            
         }
          else
          {
              $result = $DBconnection->query($SQL_stmt);
              while ($row = $result->fetch())
              { 
                  echo '<tr>
                    <th scope="row">'.$row['Student_ID'].'</th>
                    <td>'.$row['Student_Name'].'</td>
                    <td>'.$row['Request_ID'].'</td>
                    <td>'.$row['Date_submitted'].'</td>
                    <td>'.$row['Total_price'].'</td>
                    <td>'.$row['Status'].'</td>
                    </tr>';   
              }
              
          }
     
     }  
     
      function getStudentInformation($uID, $courseTitle, $courseYear)
      {
          //is called within StaffNewRequest.php Line 176
           //course title, year and level not defined here. SO i would just select 
           //from the course that the staff member is on instead.
        require 'connect.php';
        $courseTitle = $_SESSION['courseTitle'];
        $SQL_stmt = "SELECT DISTINCT users.userID AS 'Student_ID', users.userFirstName AS 'first', 
        users.userLastName AS 'last',
        student.availableBalance AS 'Available_Balance' FROM users INNER JOIN student ON users.userID = student.studentID
        INNER JOIN departmentsStaffCourseStudents ON users.userID = departmentsStaffCourseStudents.bscsStudentID
        AND departmentsStaffCourseStudents.bscsStaffID = '". $uID ."' 
        AND student.studentID = departmentsStaffCourseStudents.bscsStudentID
        INNER JOIN course ON departmentsStaffCourseStudents.bscsCourseID = course.courseID 
        AND course.courseTitle = '". $courseTitle ."'"; 
          
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
      function getstaffStudentHistory($uID)
      {
         require 'connect.php';
         
         $courseTitle = $_SESSION['courseTitle'];
         
         //Working solution. Outputs all requests under all statuses apart from Drafts
         //Based on a specific course title and all students linked to the staff member through requests
         $SQL_stmt =  "SELECT users.userID AS 'Student_ID', bursaryRequests.bRequestsID AS 'Request_ID',
             CONCAT(users.userFirstName,' ',users.userLastName) AS 'Student_Name',
             bursaryRequests.bRequestsStaffApproved AS 'Staff/Approved', bursaryRequests.bRequestsAdminApproved AS 'Admin/Approved',
             bursaryRequests.bRequestsRequestDate AS 'Date_submitted',
             SUM(IFNULL(bursaryRequestItems.brItemPrice,0) + IFNULL(bursaryRequestItems.brItemPostage,0) + IFNULL(bursaryRequestItems.brItemAdditionalCharges,0)) AS 'Total_price',
             bursaryRequests.bRequestsStatus AS 'Status' FROM users
             INNER JOIN itemsAndRequests ON users.userID = itemsAndRequests.StudentID
             INNER JOIN bursaryRequests ON bursaryRequests.bRequestsID = itemsAndRequests.RequestID
             AND bursaryRequests.bRequestsStaffID = '".$uID."'
             AND bursaryRequests.bRequestsStatus NOT LIKE 'Draft'
             INNER JOIN bursaryRequestItems ON bursaryRequestItems.brItemID = itemsAndRequests.ItemID
             INNER JOIN course ON course.courseID = bursaryRequests.bRequestsCourseID
             AND course.courseTitle = '".$courseTitle."'
             GROUP BY bursaryRequests.bRequestsID
             ORDER BY bursaryRequests.bRequestsRequestDate DESC";
         $result = 0;
        
         $result = $DBconnection->query($SQL_stmt); 
        
          if ($result->fetch()==FALSE){
            echo '<tr style align ="middle">
                <th scope="row" colspan ="8">No Student History</th>
                </tr>';
          }
          else
          {
              $result = $DBconnection->query($SQL_stmt);
              
              while ($row = $result->fetch())
              {
                  $staff = $row['Staff/Approved'];
                  $admin = $row['Admin/Approved'];
                  
                  if($staff == 'No' || $admin == 'No')//Display rejected
                  {
                    echo '<tr>
                    <th scope="row">'.$row['Student_ID'].'</th>
                    <td>'.$row['Student_Name'].'</td>
                    <td>'.$row['Request_ID'].'</td>                    
                    <td>'.$row['Date_submitted'].'</td>
                    <td>'.$row['Staff/Approved'].'</td>
                    <td>'.$row['Admin/Approved'].'</td>
                    <td>'.$row['Total_price'].'</td>
                    <td>Rejected</td>
                    </tr>';
                  }
                  else
                  {
                    echo '<tr>
                    <th scope="row">'.$row['Student_ID'].'</th>
                    <td>'.$row['Student_Name'].'</td>
                    <td>'.$row['Request_ID'].'</td>                    
                    <td>'.$row['Date_submitted'].'</td>
                    <td>'.$row['Staff/Approved'].'</td>
                    <td>'.$row['Admin/Approved'].'</td>
                    <td>'.$row['Total_price'].'</td>
                    <td>'.$row['Status'].'</td>
                    </tr>';
                  }
              }
          }
      }

    function getStaffSubmittedForms($uID) 
    {
     //All working now Danny. Very hard query, had to do a LEFT JOIN and two sub-queries.
     //Counts all UNIQUE items linked to the staff's requests
     //Sums the value of the unique items from bursaryRequests items linked to that requests
     //For example: Request for two students with 1 item and the price would be displayed as 5 pounds
     //instead of 10 (5X2) - Shows the full value of the item 
     //as staff will need to know the total price of the request for the students that are linked to it
     //Therefore the total price of the item will be deducted seperately from each student balance
     require 'connect.php'; 
     $courseTitle = $_SESSION['courseTitle'];
     $SQL_stmt = "SELECT bursaryRequests.bRequestsID AS 'Request_ID',    
             bursaryRequests.bRequestsRequestDate AS 'Date_submitted',
             (SELECT COUNT(DISTINCT itemsAndRequests.ItemID) FROM itemsAndRequests WHERE itemsAndRequests.RequestID = bursaryRequests.bRequestsID) AS 'item_count',
             (SELECT SUM(IFNULL(bursaryRequestItems.brItemPrice,0) + IFNULL(bursaryRequestItems.brItemPostage,0) + IFNULL(bursaryRequestItems.brItemAdditionalCharges,0)) FROM bursaryRequestItems WHERE bursaryRequestItems.brItemID = itemsAndRequests.ItemID) AS 'Total_price',
             bursaryRequests.bRequestsStatus AS 'Status' FROM bursaryRequests
             INNER JOIN itemsAndRequests ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID
             AND bursaryRequests.bRequestsStaffID = '".$uID."'    
             AND bursaryRequests.bRequestsStatus NOT LIKE 'Draft'
             AND bursaryRequests.bRequestsStaffApproved = 'Yes'
             AND bursaryRequests.bRequestsStaffRequest = 'TRUE' OR bursaryRequests.bRequestsStaffRequest = 1
             INNER JOIN student ON student.studentID = itemsAndRequests.StudentID
             LEFT JOIN bursaryRequestItems ON bursaryRequestItems.brItemID = itemsAndRequests.ItemID
             INNER JOIN course ON course.courseID = bursaryRequests.bRequestsCourseID
             AND course.courseTitle = '".$courseTitle."'
             AND itemsAndRequests.StaffItemApproved = 'Yes'
             GROUP BY bursaryRequests.bRequestsID
             ORDER BY bursaryRequests.bRequestsRequestDate DESC";  
        
            $result = 0;
        
         $result = $DBconnection->query($SQL_stmt); 
        
          if ($result->fetch()==FALSE){
            echo '<tr style align ="middle">
                <th scope="row" colspan ="5">No Submisions</th>
                </tr>';
          }
          else
          {
              $result = $DBconnection->query($SQL_stmt);
              
              while ($row = $result->fetch())
              {
                  echo '<tr>
                    <th scope="row">'.$row['Request_ID'].'</th>
                    <td>'.$row['item_count'].'</td>
                    <td>'.$row['Date_submitted'].'</td>                    
                    <td>'.$row['Total_price'].'</td>
                    <td>'.$row['Status'].'</td>
                    </tr>';
              }
          }
}
function getStaffStudents($uID)
{
    require 'connect.php';
    //Query that gets user details belonging to staff and their grants based on the system.
    $SQL_stmt = "SELECT users.userID AS 'id', users.userAccessGranted AS 'activated', users.userPIN AS 'pin', users.userRegistered AS 'reg',
    CONCAT(users.userFirstName, ' ', users.userLastName) AS 'user',
    course.courseTitle AS 'course' FROM users
    INNER JOIN departmentsStaffCourseStudents ON users.userID = departmentsStaffCourseStudents.bscsStudentID
    AND departmentsStaffCourseStudents.bscsStaffID = '".$uID."'
    INNER JOIN course ON course.courseID = departmentsStaffCourseStudents.bscsCourseID
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
<script src="../Scripts/ajaxTableUpdateDrop.js"></script>