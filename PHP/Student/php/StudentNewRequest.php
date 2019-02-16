<?php
    session_start();
    require_once 'connect.php';//connects to the SQL database.
    // Get the _SESSION user details.
    if (isset($_SESSION['lastName'])){
        echo " start Step 2.0..<br>"; // for testing purposes
        $firstName = $_SESSION['firstName'];
        $lastName = $_SESSION['lastName'];
        $userid = $_SESSION['userid'];
        $userName = $firstName . " " . $lastName;
        // get course title
        $SQL_stmt = "SELECT DISTINCT courseTitle FROM course 
        INNER JOIN studentToCourse ON course.courseID = studentToCourse.stcCourseID
        INNER JOIN users ON users.userID = " . $userid . " and studentToCourse.stcStudentID = '" . $userid . "'";
        // now to run the query
        echo " start Step 2.0..<br>"; // for testing purposes
        // first prepare and excecurte
        $result = $DBconnection->query($SQL_stmt);
        echo " start Step 2.1..<br>"; // for testing purposes
        // now get the data
        if ($row = $result->fetch()){
            // varify that it is a valid userID
            echo " start Step 2.1.1..<br>"; // for testing purposes
            // Bind results by column name
            $courseTitle = $row['courseTitle'];
        }
    }

?>
        <!-- <div class="row col-lg-6 justify-content-start align-items-center"> -->
        <div>
                <li class="list-group-item  border-1">New Bursary Request</li>
        </div>
        <div class="col-3">
                    <ul class="list-group">
                       <li class="list-group-item  border-0">Submitted: <span>10</span></li>
                        <li class="list-group-item  border-0">Approved: <span>8</span></li>
                        <li class="list-group-item  border-0">Awaiting delivery: <span>YES</span></li>
                    </ul>
                </div>
          </div>
          
     <section class="container-fluid mt-5">
    <section class="row">
     <div class="col-6">
            
         <form>
              <div class="form-group row">
    <label for="fullName" class="col-sm-2 col-form-label">Full Name:</label>
    <div class="col-sm-10">
        <?php
            echo '<input type="text" class="form-control" id="fullName" value="' . $userName . '" placeholder="Auto-generated field">'
        ?>
      <!-- <input type="text" class="form-control" id="fullName" value="$userName" placeholder="Auto-generated field"> -->
    </div>
  </div>
            
             <div class="form-group row">
    <label for="course" class="col-sm-2 col-form-label">Course:</label>
    <div class="col-sm-10">
        <?php
            echo '<input type="text" class="form-control" id="course" value="' . $courseTitle . '" placeholder="Auto-generated field">'
        ?>
        <!-- <input type="text" class="form-control" id="course" placeholder="Auto-generated field"> -->
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
                    <h6>Status of the form: <span>Status</span></h6>
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