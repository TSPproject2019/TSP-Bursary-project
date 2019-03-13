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
          <section class="content">
              <div class="row justify-content-center">
                  <article class="border col-lg-6 mt-2">
                      
                      Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                      sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                      magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                      quis nostrud exerci tation ullamcorper suscipit lobortis nisl
                      ut aliquip ex ea commodo consequat. Duis autem vel eum iriure
                      dolor in hendrerit in vulputate velit esse molestie consequat,
                      vel illum dolore eu feugiat nulla facilisis at vero eros et
                      accumsan et iusto odio dignissim qui blandit praesent luptatum
                      zzril delenit augue duis dolore te feugait nulla facilisi.
                      Nam liber tempor cum soluta nobis eleifend option congue
                      nihil imperdiet doming id quod mazim placerat facer possim
                      assum. Typi non habent claritatem insitam; est usus legentis
                      in iis qui facit eorum claritatem. Investigationes
                      demonstraverunt lectores legere me lius quod ii legunt saepius.
                      Claritas est etiam processus dynamicus, qui sequitur mutationem
                      consuetudium lectorum. Mirum est notare quam littera gothica,
                      quam nunc putamus parum claram, anteposuerit litterarum formas
                      humanitatis per seacula quarta decima et quinta decima. Eodem
                      modo typi, qui nunc nobis videntur parum clari, fiant sollemnes
                      in futurum.
                      
                  </article>
              </div>
          </section>
          
          <section class="container mt-2">
              <form class="mt-3">
              <!-- <div> -->
                  <div class="form-check" style="text-align: center">
                      <input class="form-check-input" type="checkbox" value="" id='agreeCheckbox'>
                      <label class="form-check-label" for="check1">I CONSENT THIS....</label>
                  </div>
                  <div class="form-check" style="text-align: center">
                      <input class="form-check-input" type="checkbox" value="" id="check2">
                      <label class="form-check-label" for="check2">I DO NOT CONSENT TO THIS....</label>
                      <div>
                           <input type="submit" name="submit" class="btn btn-success mt-2" id='send' value="Submit" disabled />
                      </div>
                  </div>
               </div>
            </form>
          </section>