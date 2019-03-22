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
<body id="demo">
                <div class="col-md-4 ml-4">
                    <ul class="removeBullets">
                      <?php
                       echo'<li>Submitted: '. $submittedTotal .'</li>';
                       echo'<li>Approved: '. $approvedTotal .'</li>';
                       echo'<li>Awaiting delivery: '. $awaitingDelivery .'</li>';
                          ?>
                    </ul>
                </div>
          <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Date Saved</th>
      <th scope="col">Request ID</th>
      <th scope="col">Item Count</th>
      <th scope="col">Price (Total)</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>  
    </tr>
  </thead>
  <tbody>
    <?php
          echo getStaffDraftItems($userid);
    ?>
  </tbody>
</table> 

<div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Student Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="ml-2">
                        <div class="form-group row">
                             <label for="fullName" class="col-sm-2 col-form-label">Full Name:</label>
                             <div class="col-sm-10">
                                  <input type="text" class="form-control" id="fullName">
                             </div>

                        </div>
                        <div class="form-group row">
                             <label for="course" class="col-sm-2 col-form-label">Course:</label>
                             <div class="col-sm-10">
                                  <input type="text" class="form-control" id="course">
                             </div>
                        </div>
                        
                        <div class="form-group row">
                             <label for="tutor" class="col-sm-2 col-form-label">Tutor:</label>
                             <div class="col-sm-10">
                                  <input type="text" class="form-control" id="tutor">
                             </div>
                        </div>
                         <div id = "newlink">
    <div id="1">
    <div class="form-group row justify-content-between">
    <h5  id="hd05" name="numberOfItems"> Item 1 </h5>
    
    <div class="delete-group col-2">
         <div class="input-group-prepend">
             <a href="javascript:addItem()" style="width: 6; height: 6;" class="btn btn-success" title="Add an Item"><span>&#43;</span>  </a>
             <a href="javascript:deleteItem(1)" style="width: 5; height: 5;" class="btn btn-danger" title="Delete this Item"><span>&#45;</span></a>
         </div>
    </div>
    </div>
    <!--Category selection -->
    <div class="col-12 mt-2 mb-5">
            <select class="custom-select" id="categoryField" name="itemcategory1">
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
      <div class="input-group col-3">
          <div class="input-group-prepend">
              <span class="input-group-text" id="price" required>Item Price:</span>
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
    </div> <!--div ID end -->
  </div><!--newlink end -->
       
    <!--Form Justification textarea -->
      <div class="form-group">
          <textarea class="form-control" type="textarea" name="justification" rows="3" placeholder="Justification:" required></textarea>
      </div>

                        
                       
                    </form>
                </div>
            </div>
    </div>
    </div>
</body>