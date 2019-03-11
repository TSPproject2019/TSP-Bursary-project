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
                <div class="col-md-4 ml-3">
            <p>Outstanding balance: <span>£500.00</span></p>
        </div>
    <section class="container-fluid mt-5">
    <section class="row">
     <div class="col-6">
            
         <form>
              <div class="form-group row">
    <label for="fullName" class="col-sm-2 col-form-label">Full Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" disabled value="" id="fullName">
    </div>
  </div>
            
             <div class="form-group row">
    <label for="course" class="col-sm-2 col-form-label">Course:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="course" placeholder="Auto-generated field">
    </div>
  </div>
  
              
              <div class="form-group row">
    <label for="tutor" class="col-sm-2 col-form-label">Tutor:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tutor" placeholder="Auto-generated field">
    </div>
  </div>
  
  <h5> Item 1 </h5>
  
  
  <h6>Category field(Qualification, Equipment, Events, Professional accreditation, Vocational placement)</h6>
         <form>
             <div class="form-group">
                 <div>
                     <input type="text" class="form-control" placeholder="Item description:">
                  </div>
              </div>
            
              <div class="form-group">
                 <div>
                     <input type="text" class="form-control" placeholder="URL to the item:">
                 </div>
                </div>
            
                <div class="form-group row justify-content-between">
                    <div class="input-group col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="price">Price:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="price">
                    </div>
                    
                    <div class="input-group col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="price">Postage:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="postage">
                    </div>
                    
                    <div class="input-group col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="additionalFees">Additional fees:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="additionalFees">
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="justification" rows="3" placeholder="Justification:"></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="tutorComments" rows="3" placeholder="Tutor Comments:"></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="additionalComments" rows="4" placeholder="Additional Comments:"></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="staffComments" rows="5" placeholder="Staff Comments (Additional comments to students)"></textarea>
                </div>
                
               <button type="button" class="btn btn-primary btn-lg">Save as Draft</button>
               <button type="button" class="btn btn-secondary btn-lg">Submit</button>
                
            </form>
        <section class="col-6">
            <div class="row justify-content-center">
                <select class="custom-select col-3 mr-2">
                    <option selected>Select group</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
           
            
                <select class="custom-select col-3">
                    <option selected>Select Year</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
          </div>
          </section>
                <input class="col-1 m-0" type="checkbox" id="checkbox3" value=""> </input>
           
                <label class="form-check-label" for="checkbox3">Select All Students</label>
            <div class="row justify-content-around mt-4 text-center"></div>
            <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Student ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">Additional Funds</th>
      <th scope="col">Selected</th>
    </tr>
  </thead>
  <tbody>
    
      <?php
      
          echo getStudentInformation($userid);   
      
      ?>
      
      <!--
      <tr>
      <th scope="row-1">ID ONE</th>
      <td>NAME ONE</td>
      <td>£500.00</td>
      <td><input type="checkbox"></td>

      
    </tr>
    <tr>
      <th scope="row-2">ID TWO</th>
      <td>NAME TWO</td>
      <td>£150.00</td>
      <td><input type="checkbox"></td>
      
    </tr>
    <tr>
      <th scope="row-3">ID THREE</th>
      <td>NAME THREE</td>
      <td>00.00</td>
      <td><input type="checkbox"></td>
     
    </tr>
     <tr>
      <th scope="row-4">ID FOUR</th>
      <td>NAME FOUR</td>
      <td>20.00</td>
      <td><input type="checkbox"></td>
      
    </tr>
     <tr>
      <th scope="row-5">ID FIVE</th>
      <td>NAME FIVE</td>
      <td>00.00</td>
      <td><input type="checkbox"></td>
    </tr> -->
  </tbody>
</table>         
