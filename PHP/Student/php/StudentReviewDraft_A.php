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
      // get student course tutor
        $SQL_stmt = "SELECT DISTINCT userid, userFirstName, userLastName FROM users
        INNER JOIN departmentsStaffCourseStudents ON users.userID = departmentsStaffCourseStudents.bscsStaffID
        AND departmentsStaffCourseStudents.bscsStudentID  = '" . $userid . "'";
        // now to run the query
       # echo " start Step 3.0..<br>"; // for testing purposes
        // first prepare and excecurte
        $result = $DBconnection->query($SQL_stmt);
       # echo " start Step 3.1..<br>"; // for testing purposes
        // now get the data
        if ($row = $result->fetch()){
            // varify that it is a valid userID
           # echo " start Step 3.1.1..<br>"; // for testing purposes
            // Bind results by column name
            $courseTutorFirstName = $row['userFirstName'];
            $courseTutorLastName = $row['userLastName'];
            $courseTutorId = $row['userid'];
            // store session variables
            $_SESSION['courseTutorFirstName'] =  $courseTutorFirstName;
            $_SESSION['courseTutorLastName'] =  $courseTutorLastName;
            $_SESSION['courseTutorId'] =  $courseTutorId;
            // this varisable is also used for posting.
        }
        
        // get the data for the submitted requests
        $submitTotal = getTotals ($userid, "Submitted");
        $approved = getTotals ($userid, "Approved");
        $pending = getTotals ($userid, "Pending");
        $deliveredTotal = getDelivered($userid);
        $availableBalance = getStudentAvailableBalance($userid);
    }
?>
<!-- <script src="./Scripts/studentJava.js" type="text/javascript"></script> -->
<div class="col-md-4 ml-3">
                    <?php
                        echo '<p>Outstanding balance: <span>' . $availableBalance . '</span></p>';
                    ?>
                </div>
            <div class="col-3">
                    <ul class="list-group">
                      <?php
                         echo '<li class="list-group-item  border-0">Submitted: <span>' . $submitTotal . '</span></li>';
                         echo '<li class="list-group-item  border-0">Approved: <span>' . $approved . '</span></li>';
                         echo '<li class="list-group-item  border-0">Awaiting delivery: <span>' . $pending . '</span></li>';
                         echo '<li class="list-group-item  border-0">Delivered: <span>' . $deliveredTotal . '</span></li>';
                      ?>
                    </ul>
                </div>
        </div>
           <form action="StudentReviewDraft_Edit.php" method="POST">
          <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Date saved</th>
      <th scope="col">Request id</th>
      <th scope="col">Item</th>
      <th scope="col">Price (Total)</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
   <tbody>

         <?php
          echo getStudentDraftItems($userid);
          ?>

  </tbody>

</table>
</form>

<?php
    #require_once 'StudentReviewDraft_B.php';
?>