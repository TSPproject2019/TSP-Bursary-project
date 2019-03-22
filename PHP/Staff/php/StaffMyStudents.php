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
         //$submittedTotal = getStaffTotals($userid,$userType,"Submitted");
         //$approvedTotal = getStaffApproved($userid,$userType,"Approved");
         //$awaitingDelivery = getStaffAwaitingDelivery($userid,$userType);
    }

?>
<body id="demo">
                <!---<div class="col-md-4 ml-4">
                    <ul class="list-group list-group-flush">
                       <?php
                       //echo'<li class="list-group-item">Submitted: '. $submittedTotal .'</li>';
                       //echo'<li class="list-group-item">Approved: '. $approvedTotal .'</li>';
                       //echo'<li class="list-group-item">Awaiting delivery: '. $awaitingDelivery .'</li>';
                          ?>
                    </ul>
                </div> -->

<div class="container">
            
            <div class="row m-5"><!--table selectiom START -->  

               <div class="btn-group" style="text-align: center" "display:block;">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true" align=right>
                    Name of Group Selected
                  </button>
                  <div id="courseBtn" class="dropdown-menu dropdown-menu-lg-right">
                  <?php
                       echo getStaffAllCourses($userid);
                    ?>
    
          </div>
          </div>
        <div id="yearBtn" class="btn-group" style="text-align: center">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true" align=right>
                    Year Selected
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg-right">
                  <?php
                       echo getStaffAllCourseYears($userid);
                    ?>
                  </div>
               </div>
                <div id="levelBtn"></div>
    <form >
    <!--     <form action ="my_students_register_activate.php" method="POST"> -->
        
        <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Student ID</th>
      <th scope="col">Name</th>
      <th scope="col">Course</th>
      <th scope="col">Registered</th>
      <th scope="col">PIN CODE</th>
      <th scope="col">SEND CODE</th>
      <th scope="col">Approve</th>
    </tr>
  </thead>
  <tbody id="table">
     <?php 
      
          echo getStaffStudents($userid);
      
      ?>
  </tbody>
</table>
</form>
</div>
    </div>
</div>
</body>