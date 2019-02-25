<?php
   session_start();
   # echo " start Step 0.0..<br>"; // for testing purposes
   require_once 'connect.php';//connects to the SQL database.
   # echo " start Step 1.0..<br>"; // for testing purposes
   require 'functions.php'; // connects to the functions.
    
    // Get the _SESSION user details.
    if (isset($_SESSION['lastName'])){
       # echo " start Step 2.0..<br>"; // for testing purposes
        $firstName = $_SESSION['firstName'];
        $lastName = $_SESSION['lastName'];
        $userid = $_SESSION['userid'];
        $userType = $_SESSION['userType'];
        $userName = $firstName . " " . $lastName;
        // get course title of a staff member
        $SQL_stmt = "SELECT DISTINCT courseTitle from course 
        inner join departmentsStaffCourseStudents on course.courseID = departmentsStaffCourseStudents.bscsCourseID
        and departmentsStaffCourseStudents.bscsStaffID = '" . $userid . "'";
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
            $_SESSION['courseTitle'] =  $courseTitle; // Course title is defined for staff to display
            // this varisable is also used for posting.

        }
         $submittedTotal = getStaffTotals($userid,$userType,"Submitted");
         $approvedTotal = getStaffApproved($userid,$userType,"Approved");
         $awaitingDelivery = getStaffAwaitingDelivery($userid,$userType);
    }

?>
                <div class="col-md-4 ml-4">
                    <ul class="list-group list-group-flush">
                       <?php
                       echo'<li class="list-group-item">Submitted: '. $submittedTotal .'</li>';
                       echo'<li class="list-group-item">Approved: '. $approvedTotal .'</li>';
                       echo'<li class="list-group-item">Awaiting delivery: '. $awaitingDelivery .'</li>';
                          ?>
                    </ul>
                </div>
               <div class="btn-group" style="text-align: center" "display:block;">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true" align=right>
                    Name of Group Selected
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg-right">
                  <?php
                       echo getStaffAllCourses($userid);
                    ?>
    
          </div>
          </div>
        <div class="btn-group" style="text-align: center">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true" align=right>
                    Year Selected
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg-right">
                  <?php
                       echo getStaffAllCourseYears($userid);
                    ?>
                  </div>
               </div>
    
        <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Student ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">File Name</th>
      <th scope="col">Date Submitted</th>
      <th scope="col">Date Approved</th>
      <th scope="col">Cost</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">ID ONE</th>
      <td>NAME ONE</td>
      <td>WEBFORM 1</td>
      <td>27/01/2019</td>
      <td>28/01/2019</td>
      <td>£230.00</td>
      <td>ACCEPTED</td>
    </tr>
    <tr>
      <th scope="row">ID TWO</th>
      <td>NAME TWO</td>
      <td>WEBFORM 2</td>
      <td>27/01/2019</td>
      <td>28/01/2019</td>
      <td>£78.00</td>
      <td>DELIVERED</td>
    </tr>
    <tr>
      <th scope="row">ID THREE</th>
      <td>NAME THREE</td>
      <td>WEBFORM 3</td>
      <td>27/01/2019</td>
      <td>28/01/2019</td>
      <td>£499.99</td>
      <td>PENDING</td>
    </tr>
     <tr>
      <th scope="row">ID FOUR</th>
      <td>NAME FOUR</td>
      <td>WEBFORM 4</td>
      <td>27/01/2019</td>
      <td>28/01/2019</td>
      <td>£79.50</td>
      <td>PENDING</td>
    </tr>
     <tr>
      <th scope="row">ID FIVE</th>
      <td>NAME FIVE</td>
      <td>WEBFORM 5</td>
      <td>27/01/2019</td>
      <td>28/01/2019</td>
      <td>£99.99</td>
      <td>PENDING</td>
    </tr>
  </tbody>
</table>         