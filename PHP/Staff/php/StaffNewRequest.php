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
         $availableBalance = getStudentAvailableBalance($userid);
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
</div>
        

<section class="container-fluid mt-5"> <!--Container section start -->      
    <section class="row"> <!-- Row left side start -->
         <div class="col-6">           
             <div class="form-group row">
                <label for="course" class="col-sm-2 col-form-label">Course:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="course" placeholder="Auto-generated field">
                </div>
              </div>
                  <input type="hidden" class="form-control" id="tutor" placeholder="Auto-generated field">
                   <input type="hidden" "disabled" class="form-control" disabled value="" id="fullName">
                

      <form class="m-1">
         <!--Staff ID using id stored in session storage at login page -->
        <input type="hidden" name="courseTutorId" value="<?php echo $_SESSION['courseTutorId'] ?>" />
        <!-- Turtor Course id stored in session storage at login page -->
        <input type="hidden" name="courseid" value="<?php echo $_SESSION['courseid'] ?>" />
        <!--Student id -->
        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>" />
      
        <div id = "newlink">
           <div id="1">
            <div class="form-group row justify-content-between">
            <h5  id="hd05" name="numberOfItems" class="ml-4"> Item 1 </h5>
    
            <div class="delete-group col-2">
                 <div class="input-group-prepend">
                     <a href="javascript:addItem()" style="width: 5; height: 5;" class="btn btn-success m-1" title="Add an Item"><span>&#43;</span>  </a>
                     <a href="javascript:deleteItem(1)" style="width: 5; height: 5;" class="btn btn-danger m-1" title="Delete this Item"><span>&#45;</span></a>
                 </div>
            </div>
            </div>
            <!--Category selection -->
            <div class="mt-2 mb-5">
                    <select class="custom-select col-12" id="categoryField" name="itemcategory1">
                        <option value ="" selected="">Choose Category...</option>
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
              <div class="input-group col-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="price" required>Item Price:</span>
                  </div>
                  <input type="text" class="form-control" name="itemprice1" aria-describedby="price">
              </div>
             <!--Form Postage field -->              
              <div class="input-group col-4">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="price">Postage:</span>
                  </div>
                  <input type="text" class="form-control" name="itempostage1" aria-describedby="postage">
               </div>
          <!--Form Additional Fees -->
              <div class="input-group col-4">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="additionalFees">Add. fees:</span>
                  </div>
                  <input type="text" class="form-control" name="itemadditionalcharges1" aria-describedby="additionalFees">
              </div>                   
         </div> <!--End of Fees row -->
       </div>
      </div><!--newlink end -->
                
          <!--Form Justification textarea -->
          <div class="form-group">
              <textarea class="form-control" type="textarea" name="justification" rows="3" placeholder="Justification:" required></textarea>
          </div>
           <div align="right" style="margin-bottom:5px;">
             <a href="javascript:addItem()" style="width: 15; height: 15;" class="btn btn-success" title="Add an Item"><span>&#43;</span></a>
           </div>
             <button type="submit" name="submit" value="saveRequest" class="btn btn-warning btn-lg" id="Save">Save as Draft</button>
             <button type="submit" name="submit" value="submitRequest" class="btn btn-success btn-lg" id="Submit">Submit</button>            
            </div>
      </form>
     
        <section class="col-6"> <!--Student row right side table -->
                <div class="row">
                    <select class="custom-select col-12 mr-2 mb-5">
                        <option selected>Select Group</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                
                <div class="row">
                    <select class="custom-select col-12 mr-2 mb-5">
                        <option selected>Select Level</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                    
            <div class="row">
                <select class="custom-select col--2 mr-2 mb-5">
                    <option selected>Select Year</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
     
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
       <label class="form-check-label" for="checkbox3">Select All Students</label>
      <input class="col-1 m-0" type="checkbox" id="select_all">
       
            
       </section><!--Student table section  END -->
      </section><!-- Row left side END -->
     </section><!--Container section END -->


