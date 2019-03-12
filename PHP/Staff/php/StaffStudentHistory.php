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

                <div class="col-md-4 ml-5">
                    <ul class="list-group list-group-flush">
                       <?php
                       echo'<li class="list-group-item">Submitted: '. $submittedTotal .'</li>';
                       echo'<li class="list-group-item">Approved: '. $approvedTotal .'</li>';
                       echo'<li class="list-group-item">Awaiting delivery: '. $awaitingDelivery .'</li>';
                          ?>
                    </ul>
                </div>
</div>

<div class="container">
    
    <div class="row m-5"><!--table selectiom START -->        
         <div class="col btn-group">
             <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true" align=right>
               Name of Group Selected
             </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <?php
                     echo getStaffAllCourses($userid);
                  ?>
               </div>
           </div>
        <div class="col btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true" align=right>
                    Year Selected
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg-right">
                  <?php
                       echo getStaffAllCourseYears($userid);
                    ?>
                  </div>
               </div>
        <div class="col btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true" align=right>
                    Level
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg-right">
                  <?php
                       echo getStaffAllCourseLevels($userid);
                    ?>
                  </div>
               </div>
    
        <div class="col btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true" align=right>
                    Sort by
                  </button> 
                  <div class="dropdown-menu dropdown-menu-lg-right">
                  <?php
                      
                    ?>
                  </div>
         </div>
       </div><!--selection row END -->
       
  <!-- table start --> 
<div class="row col-10 ml-4">              
 <table class="table table-striped">
   <thead class="thead-dark">
              <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Request ID</th>
                <th scope="col">Date Submitted</th>
                <th scope="col">Staff</th>
                <th scope="col">Admin</th>
                <th scope="col">Cost</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
     
            <tbody> 
             <?php 
                 echo getstaffStudentHistory($userid);          
                ?>
                
            </tbody>
       </table> <!--table end-->
    </div><!--table row END-->
</div>    


