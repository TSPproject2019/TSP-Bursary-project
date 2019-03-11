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
        $availableBalance = getStudentAvailableBalance($userid);
    }
?>
<div class="col-md-4 ml-3">
                    <?php
                        echo '<p>Outstanding balance: <span>' . $availableBalance . '</span></p>';
                    ?>
                </div>
        <!-- <div class="row col-lg-6 justify-content-start align-items-center"> -->
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
<form action="Student_view_rejected.php" method="POST">
          <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Date Submitted</th>
      <th scope="col">Item Count</th>
      <!---<th scope="col">Item Description</th> ---->
      <th scope="col">Cost</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    
      <?php
          # just testing somthing.. 
          echo getStudentSubmittedForms($userid);//Standard wireframe function
    
          //Will need to add one more column called 'Item name/Description' for the functions below
          
         //echo getStudentForms ($userid, "Submitted"); //For new function test to display item name as well
         //echo getStudentForms ($userid, "Approved");
      ?>
    
  </tbody>
</table> 
</form>
