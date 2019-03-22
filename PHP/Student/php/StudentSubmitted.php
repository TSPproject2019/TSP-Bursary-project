<body id="demo">
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
        $pending = getStudentAwaitingDelivery($userid);
        $deliveredTotal = getDelivered($userid);
        $availableBalance = getStudentAvailableBalance($userid);
    }
?>
<div class="col-md-4 ml-3">
                    <?php
                        echo '<h6>Outstanding balance: <span>' . $availableBalance . '</span></h6>';
                    ?>
                </div>
        <!-- <div class="row col-lg-6 justify-content-start align-items-center"> -->
        <div class="col-3">
                    <ul class="removeBullets">
                      <?php
                         echo '<li>Pending Approval: <span>' . $submitTotal . '</span></li>';
                         echo '<li>Approved: <span>' . $approved . '</span></li>';
                         echo '<li>Awaiting delivery: <span>' . $pending . '</span></li>';
                         echo '<li>Delivered: <span>' . $deliveredTotal . '</span></li>';
                      ?>
                    </ul>
                </div>
          </div>
<form action="Student_view_form.php" method="POST">
          <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Date Submitted</th>
      <th scope="col">Item Count</th>
      <!---<th scope="col">Item Description</th> ---->
      <th scope="col">Cost</th>
      <th scope="col">Status</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
    
      <?php
          echo getStudentSubmittedForms($userid);//Standard wireframe function
      ?>
    
  </tbody>
</table> 
</form>
</body>