<?php
    session_start();
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
      
      //query student courseID
        $SQL_stmt = "SELECT stcCourseID AS 'courseid', stcStudentStatus AS 'status'
        FROM studentToCourse WHERE stcStudentID = '" . $userid . "' and stcStudentStatus = 'Continuing'";
      
        $result = $DBconnection->query($SQL_stmt);
      
        if ($row = $result->fetch()) {
          $courseid = $row['courseid'];
          $_SESSION['courseid'] = $courseid;
          
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
          
<section class="container mt-5 w-50">
   <!--Student Name -->          
  <div class="form-group row">
    <label for="fullName" class="col-sm-2 col-form-label">Full Name:</label>
    <div class="col-sm-10">
        <?php
            echo '<input type="text" class="form-control" id="fullName" disabled value="' . $userName . '" placeholder="Auto-generated field">'
        ?>     
    </div>    
  </div>
  
    <!--Course Name -->        
  <div class="form-group row">
    <label for="course" class="col-sm-2 col-form-label">Course:</label>
    <div class="col-sm-10">
        <?php
            echo '<input type="text" class="form-control" id="course" disabled value="' . $courseTitle . '" placeholder="Auto-generated field">'
        ?>
    </div>
  </div>
  
   <!--Tutor Name -->            
  <div class="form-group row">
    <label for="tutor" class="col-sm-2 col-form-label">Tutor:</label>
    <div class="col-sm-10">
        <?php
            echo '<input type="text" class="form-control" id="tutor" disabled value="' . $courseTutorFirstName . ' ' . $courseTutorLastName . '" placeholder="Auto-generated field">'
        ?>  
    </div>
  </div>
  
  <!-- FORM START -->
  <form onload="onFormLoad()" action="requestSave.php" method="POST">
    <!--Student ID using id stored in session storage at login page -->
    <input type="hidden" name="courseTutorId" value="<?php echo $_SESSION['courseTutorId'] ?>" />
    <!-- Turtor Course id stored in session storage at login page -->
    <input type="hidden" name="courseid" value="<?php echo $_SESSION['courseid'] ?>" />
    <!--Student id -->
    <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>" />
   <div id="newlink">
    <h5> Item 1 </h5>
    <!--Category selection -->
    <div class="col-12 mt-2 mb-5">
            <select class="custom-select" id="categoryField" name="itemcategory1">
                <option value ="" selected="">Choose...</option>
                <option value="Qualification">Qualification</option>
                <option value="Equipment">Equipment</option>
                <option value="Events">Events</option>
                <option value="Professional accreditation">Professional accreditation</option>
                <option value="Vocational placement">Vocational placement</option>
            </select>
        </div>    
    <!--Item description -->
    <div class="form-group row">
        <div class="col-12">
            <input type="text" name="itemdescription1" class="form-control" placeholder="Item description:" required>
         </div>
    </div> 
    <!--Item URL-->
    <div class="form-group row">
       <div class="col-12">
           <input type="text" name="itemUrl1" class="form-control" placeholder="URL to the item:" required
                  value="<?php if (isset($_POST['itemUrl'])) echo $_POST['itemUrl']; ?>">
       </div>
    </div>
    <!--FORM FEES ROW-->
    <div class="form-group row justify-content-between">
    <!--Form Price field -->
      <div class="input-group col-3">
          <div class="input-group-prepend">
              <span class="input-group-text" id="price" required>Price:</span>
          </div>
          <input type="text" class="form-control" name="itemprice1" aria-describedby="price">
      </div>
     <!--Form Postage field -->              
      <div class="input-group col-3">
          <div class="input-group-prepend">
             <span class="input-group-text" id="price">Postage:</span>
          </div>
          <input type="text" class="form-control" name="itempostage1" aria-describedby="postage">
       </div>
      <!--Form Additional Fees -->
          <div class="input-group col-4">
              <div class="input-group-prepend">
                  <span class="input-group-text" id="additionalFees">Additional fees:</span>
              </div>
              <input type="text" class="form-control" name="itemadditionalcharges1" aria-describedby="additionalFees">
          </div>                   
     </div> <!--End of Fees row -->
       
    <!--Form Justification textarea -->
      <div class="form-group">
          <textarea class="form-control" type="textarea" name="justification" rows="3" placeholder="Justification:" required></textarea>
      </div>
    <!--Form Tutor Comments textarea -->
      <div class="form-group">
          <textarea class="form-control" type="textarea" name="tutorComments" rows="3" placeholder="Tutor Comments:"></textarea>
      </div>
   </div>
     <input type="hidden" name="numberOfItems" value="1" />
     <button type="submit" name="submit" value="saveRequest" class="btn btn-warning btn-lg" id="Save">Save as Draft</button>
     <button type="submit" name="submit" value="submitRequest" class="btn btn-success btn-lg" id="Submit">Submit</button>                
  </form>
    <!--*************************************************************************-->
<!-- NEW FORM ELEMENTS TO ADD                                               *-->
<!--*************************************************************************-->

  <div align="right" style="margin-bottom:5px;">
    <a href="javascript:add_feed()">Add New</a>
  </div>
  
  <div align="left" style="margin-bottom:5px;">
    <a href="javascript:add_feed()">Add New</a>
  </div>
  
  <div id="newitem" style="display: none">
     <!-- <h5>Item '+ct+'</h5> -->
      <h5>Item '+itemCounter+'</h5>
      <div class="col-12 mt-2 mb-5">
            <select class="custom-select" name="itemcategory">
                <option value ="" selected>Choose...</option>
                <option value="Qualification">Qualification</option>
                <option value="Equipment">Equipment</option>
                <option value="Events">Events</option>
                <option value="Professional accreditation">Professional accreditation</option>
                <option value="Vocational placement">Vocational placement</option>
            </select>
        </div>   
        
    <!--Item description -->
    <div class="form-group row">
        <div class="col-12">
            <input type="text" name="itemdescription[]" class="form-control" placeholder="Item description:" required />
         </div>
    </div> 
    <!--Item URL-->
    <div class="form-group row">
       <div class="col-12">
           <input type="text" name="itemUrl[]" class="form-control" placeholder="URL to the item:" required />
       </div>
    </div>
    <!--FORM FEES ROW-->
    <div class="form-group row justify-content-between">
    <!--Form Price field -->
      <div class="input-group col-3">
          <div class="input-group-prepend">
              <span class="input-group-text" id="price" required>Price:</span>
          </div>
          <input type="text" class="form-control" name="itemprice[]" aria-describedby="price">
      </div>
     <!--Form Postage field -->              
      <div class="input-group col-3">
          <div class="input-group-prepend">
             <span class="input-group-text" id="postprice">Postage:</span>
          </div>
          <input type="text" class="form-control" name="itempostage[]" aria-describedby="postage">
       </div>
      <!--Form Additional Fees -->
          <div class="input-group col-4">
              <div class="input-group-prepend">
                  <span class="input-group-text" id="additionalFees">Additional fees:</span>
              </div>
              <input type="text" class="form-control" name="itemadditionalcharges[]" aria-describedby="additionalFees">
          </div>                   
     </div> <!--End of Fees row -->
  </div>
</section>
