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
            <div class="col-md-4 ml-4">
                <ul class="list-group list-group-flush">
                <!-- <ul class="list-group"> -->
                    <?php
                        echo '<li class="list-group-item">Submitted: <span>' . $submitTotal . '</span></li>';
                        echo '<li class="list-group-item">Approved: <span>' . $approved . '</span></li>';
                        echo '<li class="list-group-item">Awaiting delivery: <span>' . $pending . '</span></li>';
                    ?>
                </ul>
            </div>
        </div>
          
          <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Date saved</th>
      <th scope="col">Item</th>
      <th scope="col">Price (Total)</th>
    </tr>
  </thead>
  <tbody>
    <?php
          echo getStudentDraftItems($userid);
    ?>
  </tbody>
</table> 

<div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Bursary request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="ml-2" action="requestSave.php" method="POST">
                        <div class="form-group row">
                             <label for="fullName" class="col-sm-2 col-form-label">Full Name:</label>
                             <div class="col-sm-10">
                               <?php
                                  echo '<input type="text" class="form-control" id="fullName" disabled value="' . $userName . '" placeholder="Auto-generated field">';
                                ?>
                             </div>

                        </div>
                        <div class="form-group row">
                             <label for="course" class="col-sm-2 col-form-label">Course:</label>
                             <div class="col-sm-10">
                               <?php
                                  echo '<input type="text" class="form-control" id="course" disabled value="' . $courseTitle . '" placeholder="Auto-generated field">';
                                ?>
                             </div>
                        </div>
                        <div class="form-group row">
                             <label for="tutor" class="col-sm-2 col-form-label">Tutor:</label>
                             <div class="col-sm-10">
                               <?php
                                 echo '<input type="text" class="form-control" id="tutor" disabled value="' . $courseTutorFirstName . ' ' . $courseTutorLastName . '" placeholder="Auto-generated field">';
                                ?>
                             </div>
                        </div>
                              
                                  <?php
                                    //Outputting draft request item info when edit button is pressed UNDER TESTING
                                    //Fetch request id for the draft
                                    $SQL_stmt = "SELECT brItemID AS 'itemID', bursaryRequests.bRequestsID AS 'requestid' FROM bursaryRequests
                                    INNER JOIN itemsAndRequests ON bursaryRequests.bRequestsID = itemsAndRequests.RequestID
                                    INNER JOIN bursaryRequestItems ON bursaryRequestItems.brItemID = itemsAndRequests.ItemID
                                    AND itemsAndRequests.StudentID = ".$userid." AND bursaryRequests.bRequestsStatus = 'Draft'";
                                    $requestid = 0;
                                    $category = 0;
                                    $itemDesc = 0;
                                    $url = 0;
                                    $price = 0;
                                    $postage = 0;
                                    $addCharges = 0;
                                    
                                    $result = $DBconnection->query($SQL_stmt);
                                    
                                    // now get the data
                                    if ($row = $result->fetch()){
                                       
                                        $requestid = $row['requestid'];
                                    }

                                    //Using the request id, find the item info 
                                    $SQL_stmt = "SELECT brItemCategory AS 'category', brItemDesc AS 'item_description',
                                    brItemURL AS 'URL', brItemPrice AS 'price', brItemPostage AS 'postage',
                                    brItemAdditionalCharges AS 'additional_charges' FROM bursaryRequestItems
                                    INNER JOIN itemsAndRequests ON itemsAndRequests.ItemID = bursaryRequestItems.brItemID 
                                    AND itemsAndRequests.RequestID = " . $requestid . "
                                    AND itemsAndRequests.StudentID = '" . $userid . "'";
                                    
                                    $result = $DBconnection->query($SQL_stmt);
                                   
                                    // now get the data
                                    $count = 1;
                                    while ($row = $result->fetch()){
                                        // loop through the request results
                                        $itemcategory = $row['category'];
                                        $itemdescription = $row['item_description'];
                                        $itemUrl = $row['URL'];
                                        $itemprice = $row['price'];
                                        $itempostage = $row['postage'];
                                        $itemadditionalcharges = $row['additional_charges'];

                                        // output data from query
                                        echo '<div class="row">
                                              <h5 class="m-2">Item ' . $count . '</h5>
                                          </div>
                                          <div class="form-group row">
                                              <label for="categoryField" class="col-sm-2 col-form-label">Category field:</label>
                                              <div class="col-sm-10 mt-2">
                                                  <select class="custom-select" id="categoryField">';                    
                                        echo '<option selected name="itemcategory' . $count . '">' . $itemcategory . '</option>';
                                        echo '<option value="1">Equipment</option>';
                                        echo '<option value="2">Events</option>';
                                        echo '<option value="3">Professional accreditation</option>';
                                        echo '<option value="4">Vocational placement</option>';
                                        echo '</select>';

                                        // now output the data
                                        echo '      </div>
                                              </div>
                                              <div class="form-group">
                                                  <div>';
                                                      echo '<label for="itemDescription' . $count . '">Item description:</label>';
                                                      echo '<textarea class="form-control" id="itemDescription' . $count . '" name="itemdescription' . $count . '" rows="2">' . $itemdescription . '</textarea>';
                                                      echo '</div>
                                              </div>
                                  
                                              <div class="form-group">
                                                  <div>
                                                      <input type="text" class="form-control" name="itemUrl' . $count . '" placeholder="URL to the item:" value="' . $itemUrl . '" >
                                                  </div>
                                              </div>
                                              
                                              <div class="form-row justify-content-between text-center">
                                                  <div class="form-group col-md-2">
                                                    <label for="price' . $count . '">Price:</label>
                                                    <input type="text" class="form-control" name="itemprice' . $count . '" id="price" value="' . $itemprice . '">
                                                  </div>
                                                  <div class="form-group col-md-2">
                                                    <label for="postage' . $count . '">Postage:</label>
                                                    <input type="text" class="form-control" name="itempostage' . $count . '" id="postage" value="' . $itempostage . '">
                                                  </div>
                                                  <div class="form-group col-md-3">
                                                    <label for="additionalFees' . $count . '">Additional Fees:</label>
                                                    <input type="text" class="form-control" name="itemadditionalcharges' . $count . '" id="additionalFees" value="' . $itemadditionalcharges . '">
                                                  </div>
                                                  </div>';
                                          // cycle counter
                                          $count++;
                                    }
                                  ?>

                                <div class="row mt-3 mb-5">
                                    
                                    <div class="col-5 mb-5 text-right">
                                        <button type="submit" name="submit" value="saveRequest" style="width: 38%;" class="btn btn-primary" id="Save" wide="45">Save</button>
                                    </div>
                                  <!-- need to add button for adding new item (+)-->
                                    <div class="col-5 mb-5 text-right">
                                        <button type="submit" name="submit" value="submitRequest" style="width: 38%;" class="btn btn-success" id="Submit">Submit</button>
                                    </div>
                                </div>
                    </form>
