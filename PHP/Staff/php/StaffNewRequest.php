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
        $SQL_stmt = "SELECT DISTINCT courseTitle, courseID from course 
        inner join departmentsStaffCourseStudents on course.courseID = departmentsStaffCourseStudents.bscsCourseID
        and departmentsStaffCourseStudents.bscsStaffID = '" . $userid . "'";
        // now to run the query
        $courseid=0;
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
            $courseid = $row['courseID'];
            
            $_SESSION['courseid'] = $courseid;
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
</div>
        

<section class="container-fluid mt-5"> <!--Container section start -->      
    <section class="row"> <!-- Row left side start -->
         <div class="col-6">           
             <div class="form-group row">
                <label for="course" class="col-sm-2 col-form-label">Course:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="course" disabled value="<?php echo $_SESSION['courseTitle']; ?>" placeholder="Auto-generated field">
                </div>
              </div>
      <form class="m-1">
        <!-- Tutor Course id stored in session storage at login page -->
        <input id="courseid" type="hidden" name="courseid" value="<?php echo $_SESSION['courseid'] ?>" />
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
                      <span class="input-group-text" id="price" required>Price:</span>
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
             <button type="submit" name="submit" value="saveStaffRequest" class="btn btn-warning btn-lg" id="Save">Save as Draft</button>
             <button type="submit" name="submit" value="submitStaffRequest" class="btn btn-success btn-lg" id="Submit">Submit</button>  
            
        </div>
        <section class="col-6"> <!--Student row right side table -->
                <div class="row">
                    <select id="courses" onchange="selectCourse(this.value);" class="custom-select col-12 mr-2 mb-5">
                        <option selected>Select course</option>
                        <?php
                              
                              $SQL_stmt = "SELECT DISTINCT courseTitle AS 'Course' FROM course
                              INNER JOIN departmentsStaffCourseStudents ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
                              WHERE bscsStaffID = '". $userid ."'";

                              $result = $DBconnection->query($SQL_stmt);
                                
                              //$count = 1;

                              while ($row = $result->fetch())
                              {
                                echo '<option value="'.$row['Course'].'">'.$row['Course'].'</option>';
                                //$count++;
                              }
                        ?>
                    </select>
                </div>
                
                <div class="row">
                    <select id="levels" onchange="selectLevel(this.value);" class="custom-select col-12 mr-2 mb-5">
                        <option selected>Select Level</option>
                         <?php
                           $SQL_stmt = "SELECT DISTINCT courseLevel AS 'Level' FROM course
                           INNER JOIN departmentsStaffCourseStudents
                           ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
                           WHERE bscsStaffID = '". $userid ."' ORDER BY course.courseLevel ASC";

                          $result = $DBconnection->query($SQL_stmt);

                          //$count = 1;

                              while ($row = $result->fetch())
                              {
                                echo '<option value="'.$row['Level'].'">'.$row['Level'].'</option>';
                                //$count++;
                              }
                        ?>
                    </select>
                </div>
                    
            <div class="row">
                <select id="years" onchange="selectYear(this.value);" class="custom-select col--2 mr-2 mb-5">
                    <option selected>Select Year</option>
                    <?php
                      $SQL_stmt = "SELECT DISTINCT courseYear AS 'Year' FROM course
                      INNER JOIN departmentsStaffCourseStudents
                      ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
                      WHERE bscsStaffID = '". $userid ."' ORDER BY course.courseYear ASC";
                    
                       $result = $DBconnection->query($SQL_stmt);

                       //$count = 1;

                              while ($row = $result->fetch())
                              {
                                echo '<option value="'.$row['Year'].'">'.$row['Year'].'</option>';
                                //$count++;
                              }
                    ?>
                </select>
            </div>
            <div class="row">
                <select id="type" onchange="selectType(this.value);" class="custom-select col--2 mr-2 mb-5">
                    <option selected>Select Type</option>
                    <?php
                      $SQL_stmt = "SELECT DISTINCT courseType AS 'Type' FROM course
                      INNER JOIN departmentsStaffCourseStudents
                      ON departmentsStaffCourseStudents.bscsCourseID = course.courseID
                      WHERE bscsStaffID = '". $userid ."' ORDER BY course.courseType ASC";
                    
                       $result = $DBconnection->query($SQL_stmt);

                       //$count = 1;

                              while ($row = $result->fetch())
                              {
                                echo '<option value="'.$row['Type'].'">'.$row['Type'].'</option>';
                                //$count++;
                              }
                    echo '<option value="All">All</option>';
                    ?>
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
                
  <tbody id="students">
    
      <?php
      
          echo getStudentInformation($userid);   
      
      ?>
  </tbody>
                
</table>
       <label class="form-check-label" for="checkbox3">Select All Students</label>
      <input class="col-1 m-0" type="checkbox" id="select_all">
       
            
       </section><!--Student table section  END -->
      </section><!-- Row left side END -->
         </form>
     </secion><!--Container section END -->


