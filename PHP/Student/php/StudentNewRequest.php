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
      
        $result = $DBconnection->query($SQL_stmt);
      
        if ($row = $result->fetch()){
            $courseTitle = $row['courseTitle'];
            $_SESSION['courseTitle'] =  $courseTitle;
        }
        $SQL_stmt = "SELECT DISTINCT userid, userFirstName, userLastName FROM users
        INNER JOIN departmentsStaffCourseStudents ON users.userID = departmentsStaffCourseStudents.bscsStaffID
        AND departmentsStaffCourseStudents.bscsStudentID  = '" . $userid . "'";

        $result = $DBconnection->query($SQL_stmt);

        if ($row = $result->fetch()){

            $courseTutorFirstName = $row['userFirstName'];
            $courseTutorLastName = $row['userLastName'];
            $courseTutorId = $row['userid'];
           
            $_SESSION['courseTutorFirstName'] =  $courseTutorFirstName;
            $_SESSION['courseTutorLastName'] =  $courseTutorLastName;
            $_SESSION['courseTutorId'] =  $courseTutorId;           
        }
     
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
        $deliveredTotal = getDelivered($userid);
        $availableBalance = getStudentAvailableBalance($userid);
    }
?>

<div class="col-md-4 ml-3">
     <?php //Balance is not defined but in HTML the value is shown.
        echo '<p id="balance1" value="'.$availableBalance.'">Outstanding balance: <span>' . $availableBalance . '</span></p>';
      ?>
 </div>
        <!-- <div class="row col-lg-6 justify-content-start align-items-center"> -->
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
          
<section class="container mt-5 w-50">
  <!--Fieldset and legends for accessability (e.g, grouping information for screen readers) -->
    <!-- Bootstraps resets fieldset attributes e.g., removes border wrapping fieldset elements -->
  <fieldset class="border p-2">
        <legend id="setLegend">Your Details</legend>
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
  </fieldset>

  
  <!-- FORM START -->
  <form action="requestSave.php" method="POST">
    <!--Student ID using id stored in session storage at login page -->
    <input type="hidden" name="courseTutorId" value="<?php echo $_SESSION['courseTutorId'] ?>" />
    <!-- Turtor Course id stored in session storage at login page -->
    <input type="hidden" name="courseid" value="<?php echo $_SESSION['courseid'] ?>" />
    <!--Student id -->
    <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>" />
    <div id = "newlink">
        <div id="1">
            <fieldset class="border p-2">
                <legend id="setLegend">Item Details</legend>
                
                <div class="form-group row justify-content-between">   
                    <h5 id="hd05" name="numberOfItems" class="ml-4 border">Item 1</h5>   
                    <div class="col-lg-3">
                         <div>
                             <a href="javascript:addItem()" style="width: 2.5em; height: 2.5em;" class="btn btn-info m-1" title="Add an Item"><span>&#43;</span></a>                       
                             <a href="javascript:deleteItem(1)" style="width: 2.5em; height: 2.5em;" class="btn btn-warning m-1" title="Delete this Item"><span>&#45;</span></a>             
                         </div>
                    </div>
                </div>
        <!--Category selection -->
        <div class="col-12 mt-2 mb-5">
            <label for="categoryField">Choose Category</label>
                <select class="custom-select" id="categoryField" name="itemcategory1">                
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
            <label for="itemDescription">Item Description:</label>
            <input type="text" id="itemDescription" name="itemdescription1" class="form-control" placeholder="Item description:" required>
         </div>
    </div> 
    <!--Item URL-->
    <div class="form-group row">
       <div class="col-12">
           <label for="itemAddress">Item URL:</label>
           <input id="itemAddress" type="text" name="itemUrl1" class="form-control" placeholder="URL to the item:"
                  value="<?php if (isset($_POST['itemUrl'])) echo $_POST['itemUrl']; ?>">
       </div>
    </div>
  </fieldset> 
    
        <fieldset class="border p-2">
            <legend id="setLegend">Item Costs</legend>
            <!--FORM FEES ROW-->
            <div class="form-group row justify-content-between">
            <!--Form Price field -->
                  <div  class="input-groupl co-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="price" required>Price:</span>
                  </div>
                  <input type="text" id="itemprice1" class="form-control" value="" name="itemprice1" aria-describedby="price">
              </div>
             <!--Form Postage field -->              
              <div class="input-group col-lg-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="price" required>Postage:</span>
                  </div>
                  <input type="text" id="itempostage1" class="form-control" value="" name="itempostage1" aria-describedby="postage">
               </div>
              <!--Form Additional Fees -->
                  <div class="input-group col-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="additionalFees">Add. fees:</span>
                      </div>
                      <input type="text" id="itemaddionalcharges1" class="form-control" value="" name="itemadditionalcharges1" aria-describedby="additionalFees">
                  </div>                   
             </div> <!--End of Fees row -->
        </fieldset>
    
    
  </div> <!--div ID end -->
</div><!--newlink end -->
       
    <!--Form Justification textarea -->
      <hr>
      <div class="form-group">
          <label for="justification">Justification:</label>
          <textarea class="form-control" type="textarea" id="justification" name="justification" rows="3" placeholder="Justification:" required></textarea>
      </div>
      
       <div align="right" style="margin-bottom:5px;">
         <a href="javascript:addItem()" style="width: 2.5em; height: 2.5;" class="btn btn-info" title="Add an Item"><span>&#43;</span></a>
       </div>
         <button type="submit" name="submit" value="saveRequest" class="btn btn-warning btn-lg" id="Save">Save as Draft</button>
         <button type="submit" name="submit" value="submitRequest" class="btn btn-success btn-lg" id="Submit">Submit</button>                
  </form>
      
</section>
