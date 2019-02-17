<?php
    session_start();

   # echo " start Step 0.0..<br>"; // for testing purposes
    require_once 'connect.php';//connects to the SQL database.
   # echo " start Step 1.0..<br>"; // for testing purposes
    // functions
    
    function getTotals ($uID, $stat){
        global $totalResult;
        require 'connect.php';//connects to the SQL database.
       # echo " start Step 4.0..<br>"; // for testing purposes
        $SQL_stmt = "SELECT COUNT(*) AS 'Total' FROM bursaryRequests
          INNER JOIN itemsAndRequests WHERE itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
          AND itemsAndRequests.StudentID = " . $uID . " AND bursaryRequests.bRequestsStaffApproved is NULL 
          AND bursaryRequests.bRequestsAdminApproved is NULL 
          AND bRequestsStatus = '" . $stat . "'";
        $totalResult = 0;
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
    // end functions
    
    // Get the _SESSION user details.
    if (isset($_SESSION['lastName'])){
       # echo " start Step 2.0..<br>"; // for testing purposes
        $firstName = $_SESSION['firstName'];
        $lastName = $_SESSION['lastName'];
        $userid = $_SESSION['userid'];
        $userName = $firstName . " " . $lastName;
        // get course title
        $SQL_stmt = "SELECT DISTINCT courseTitle FROM course 
        INNER JOIN studentToCourse ON course.courseID = studentToCourse.stcCourseID
        INNER JOIN users ON users.userID = " . $userid . " and studentToCourse.stcStudentID = '" . $userid . "'";
        // now to run the query

        //
       # echo " start Step 2.0..<br>"; // for testing purposes
        // first prepare and excecurte
        $result = $DBconnection->query($SQL_stmt);
       # echo " start Step 2.1..<br>"; // for testing purposes
        // now get the data
        if ($row = $result->fetch()){
            // varify that it is a valid userID
           # echo " start Step 2.1.1..<br>"; // for testing purposes
            // Bind results by column name
            $courseTitle = $row['courseTitle'];
            // store session variables
            $_SESSION['courseTitle'] =  $courseTitle;
            // this varisable is also used for posting.

        }
        // get the data for the submitted requests
        $submitTotal = getTotals ($userid, "Submitted");
        $approved = getTotals ($userid, "Approved");
        $pending = getTotals ($userid, "Pending");
    }
?>
        <!-- <div class="row col-lg-6 justify-content-start align-items-center"> -->
        <div>
                <li class="list-group-item  border-1">My submitted Forms</li>
        </div>
        <div class="col-3">
                    <ul class="list-group">
                      <?php
                       echo '<li class="list-group-item  border-0">Submitted: <span>' . $submitTotal . '</span></li>';
                       echo '<li class="list-group-item  border-0">Approved: <span>' . $approved . '</span></li>';
                       echo '<li class="list-group-item  border-0">Awaiting delivery: <span>' . $pending . '</span></li>';
                      ?>
                    </ul>
                </div>
          </div>
          
          <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      
      <th scope="col">Date Submitted</th>
      <th scope="col">Item Count</th>
      <th scope="col">Cost</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">27/01/2019</td>
      <td>1</td>
      <td>£230.00</td>
      <td>ACCEPTED</td>
    </tr>
    <tr>
      <th scope="row">28/01/2019</td>
       <td>1</td>
      <td>£78.00</td>
      <td>DELIVERED</td>
    </tr>
    <tr>
      <th scope="row">27/01/2019</td>
      <td>2</td>
      <td>£499.99</td>
      <td>PENDING</td>
    </tr>
     <tr>
      <th scope="row">27/01/2019</td>
      <td>4</td>
      <td>£79.50</td>
      <td>PENDING</td>
    </tr>
     <tr>
      <th scope="row">27/01/2019</td>
      <td>1</td>
      <td>£99.99</td>
      <td>PENDING</td>
    </tr>
  </tbody>
</table>         