<?php
    // start the session
    session_start();
    // connect to the database
    //echo " start Step 0.0..<br>"; // for testing purposes
    require_once 'connect.php';//connects to the SQL database.
    //include (Student/php/StudentReviewDraft_A.php);
    #require_once '../../Shared/php/AllHeader.php'; 
    //connect to the functions
    require 'functions.php'; // connects to the functions.
    # echo " start Step 1.0..<br>"; // for testing purposes

    #require 'functions.php'; // connects to the functions. // seems to fails to load page if this is loaded.
    // get session variables.
    $_SESSION['htmlTitle'] =  "Review student submission";
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $userid = $_SESSION['userid'];
    $userName = $firstName . " " . $lastName;
    $courseTitle = $_SESSION['courseTitle'];
    //$courseTutorFirstName = $_SESSION['courseTutorFirstName'];
    //$courseTutorLastName = $_SESSION['courseTutorLastName'];
   // $courseTutorId = $_SESSION['courseTutorId'];
    $student_id = 0; //for student id capturing
    $courseid = 0;
    // get the data for the submitted requests
    $submitTotal = getTotals ($userid, "Submitted");
    $approved = getTotals ($userid, "Approved");
    $pending = getTotals ($userid, "Pending");
    //$availableBalance = getStudentAvailableBalance($userid);
    require_once 'Shared/php/AllHeader.php';//connects to the header section for all pages
    require_once 'Staff/php/StaffMenu.php';// Drop Down Menu for all student pages

?>
<!-- testing -->

<div class="col-md-4 ml-3">
                  <?php
                       // echo '<p>Outstanding balance: <span>' . $availableBalance . '</span></p>';
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
<!-- <div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="false"> -->
 <!-- <section class="container mt-5 w-50"> -->
<?php
    
    // check to see which button was pressed.
    //// set a counter for this purpose
    //$count = 1;
    //// set the name="submit" variable
    //IF statement does not work with 2 == only 1 =
    //if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
    if (isset($_POST['submit'])){

        $submitButtons = $_POST['submit'];

        // now let's split the result
        $item = split("_", $submitButtons);
        // form item name
        $itemName = $item[0];

        // form item value
        $itemValue = $item[1];

        $requestid = $itemValue;
        $_SESSION['requestId'] = $requestid;
        // for editing drafts
        if ($itemName == 'open'){
           
           //Display content here because we need request id retrieved firstName
           // to get student id and name 
          echo '<section class="container mt-5 w-50">   
          <div class="form-group row">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Bursary request</h5>
                </div>
                <div class="modal-body"> ';
                
               echo ' <form class="ml-2" action="requestSave.php" method="POST">
                        <div class="form-group row">
                             <label for="fullName" class="col-sm-2 col-form-label">Full Name:</label>
                             <div class="col-sm-10">';
            
                                    //Get user first and last name, id and course id of the student based on the request id
                                    $SQL_stmt = "SELECT users.userFirstName AS 'first', users.userLastName AS 'second', users.userID AS 'student_id',
                                    course.courseID AS 'courseid' FROM users
                                    INNER JOIN itemsAndRequests ON itemsAndRequests.StudentID = users.userID
                                    INNER JOIN bursaryRequests ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID
                                    INNER JOIN course ON course.courseID = bursaryRequests.bRequestsCourseID
                                    AND bursaryRequests.bRequestsStaffID = '". $userid . "' 
                                    AND bursaryRequests.bRequestsID = '". $requestid ."'"; 

                                    $firstName = 0;
                                    $lastName = 0;
                                    

                                    $result = $DBconnection->query($SQL_stmt);
                                    # echo " start Step 4.2..<br>"; // for testing purposes
                                    // now get the data
                                    if ($row = $result->fetch()){
                                        
                                        $firstName = $row['first'];
                                        $lastName = $row['second'];
                                        $student_id = $row['student_id'];
                                        $courseid = $row['courseid'];
                                    }
 

                                  echo '<input type="text" class="form-control" id="fullName" disabled value="' . $firstName .' '. $lastName . '" placeholder="Auto-generated field">';
                           echo'  </div>

                        </div>
                        <div class="form-group row">
                             <label for="course" class="col-sm-2 col-form-label">Course:</label>
                             <div class="col-sm-10">';
                                  echo '<input type="text" class="form-control" id="course" disabled value="' . $courseTitle . '" placeholder="Auto-generated field">';
                         echo'    </div>
                        </div>
                        <div class="form-group row">
                             <label for="tutor" class="col-sm-2 col-form-label">Tutor:</label>
                             <div class="col-sm-10">';
                                 echo '<input type="text" class="form-control" id="tutor" disabled value="'.$userName.'" placeholder="Auto-generated field">';
                       echo '      </div>
                        </div>';
                 //  <!-- For course tutor id, course id and user id --->
                 echo' <input type="hidden" name="courseTutorId" value="'.$userid.'" />';
                  //<!-- Turtor Course id stored in session storage at login page -->
                 echo ' <input type="hidden" name="courseid" value="' .$courseid.'" />';
                 // <!--Student id -->
                 echo ' <input type="hidden" name="userid" value="'.$student_id.'" />';
            
            
            //Using the request id, find the item info 
            $SQL_stmt = "SELECT brItemID AS 'itemId', brItemCategory AS 'category', 
            brItemDesc AS 'item_description', brItemURL AS 'URL', 
            brItemPrice AS 'price', brItemPostage AS 'postage',
            brItemAdditionalCharges AS 'additional_charges' FROM bursaryRequestItems
            INNER JOIN itemsAndRequests ON itemsAndRequests.ItemID = bursaryRequestItems.brItemID 
            AND itemsAndRequests.RequestID = ". $requestid ."
            AND itemsAndRequests.StudentID = '". $student_id . "'";
            
            $result = $DBconnection->query($SQL_stmt);
            // set the counter, this is here as it is also used outside if the loop
            //$count = 1;
            // now get the data
            $count = 1;
            while ($row = $result->fetch()){
                // loop through the request results
                $itemId = $row['itemId'];
                $itemcategory = $row['category'];
                $itemdescription = $row['item_description'];
                $itemUrl = $row['URL'];
                $itemprice = $row['price'];
                $itempostage = $row['postage'];
                $itemadditionalcharges = $row['additional_charges'];
                $itemSelectedOptionNumber = 0;
                if ($itemcategory == 'Qualification'){$itemSelectedOptionNumber = 1;}
                if ($itemcategory == 'Equipment'){$itemSelectedOptionNumber = 2;}
                if ($itemcategory == 'Events'){$itemSelectedOptionNumber = 3;}
                if ($itemcategory == 'Professional accreditation'){$itemSelectedOptionNumber = 4;}
                if ($itemcategory == 'Vocational placement'){$itemSelectedOptionNumber = 5;}
                
                //echo "Item id is :$itemId"; //For testing
                // output data from query
                echo '<div class="row">
                        <h5 class="m-2">Item ' . $count . '</h5>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        
                        
                        <div class="p-2 a">
                        
                        <label for="categoryField" class="col-md-2 col-form-label">Category field:</label>
                            <select class="custom-select" id="categoryField" name="itemcategory' . $count . '">'
                    ;                    
                echo '<option selected="'.$itemSelectedOptionNumber.'">' . $itemcategory . '</option>';
                echo '<option value="1">Qualification</option>';
                echo '<option value="2">Equipment</option>';
                echo '<option value="3">Events</option>';
                echo '<option value="4">Professional accreditation</option>';
                echo '<option value="5">Vocational placement</option>';
                echo '</select>';
                echo '<input type="hidden" name="itemid" value="'.$itemId.'" /></div>';
                
                echo '<div class="p-2 b">
                        <input type="radio" class ="form-control" name="radio'. $count . '" id="accept'. $count .'" value="approved" checked = "checked"/> 
                        
                        <label for="accept'. $count .'">Approve</label>
                     
                        </div>
                        
                        <div class="p-2 c">
                        <input type="radio" class ="form-control" name="radio'. $count . '" id="reject'. $count .'" value="rejected" /> 
                        
                        <label for="reject'. $count .'">Reject</label>
                     
                        </div>';
                
                
            
                
                // now output the data
                echo '      </div>
                        
                        <div class="form-group">
                            <div>';
                                echo '<label for="itemDescription' . $count . '">Item description:</label>';
                                echo '<textarea class="form-control" id="itemDescription' . $count . '" name="itemdescription' . $count . '" rows="2" disabled value="'.$itemdescription.'">' . $itemdescription . '</textarea>';
                                echo '</div>
                        </div>';
                        echo '
                        <div class="form-group">
                            <div>
                                <input type="text" class="form-control" name="itemUrl' . $count . '" placeholder="URL for item here" value='.$itemUrl.'/>
                            </div>
                        </div>
                        
                        <div class="form-row justify-content-between text-center">
                            <div class="form-group col-md-2">
                            <label for="price' . $count . '">Price:</label>
                            <input type="text" class="form-control" name="itemprice' . $count . '" id="price" value="' . $itemprice . '" />
                            </div>
                            <div class="form-group col-md-2">
                            <label for="postage' . $count . '">Postage:</label>
                            <input type="text" class="form-control" name="itempostage' . $count . '" id="postage" value="' . $itempostage . '" />
                            </div>
                            <div class="form-group col-md-3">
                            <label for="additionalFees' . $count . '">Additional Fees:</label>
                            <input type="text" class="form-control" name="itemadditionalcharges' . $count . '" id="additionalFees" value="' . $itemadditionalcharges . '" />
                            
                            </div>
                            </div>';
                    // cycle counter
                    $count++;
            // break out of the for loop*/
            }
            //Now select justification to display.
            $SQL_stmt = "SELECT bRequestsJustification, bRequestsTutorComments FROM bursaryRequests WHERE bRequestsID = '". $requestid . "'";
            $txbJustification = 0;
            $txbTutorComments = 0;
            //Execute query
            $result = $DBconnection->query($SQL_stmt);
            
            if ($row = $result->fetch()){
                
                $txbJustification = $row['bRequestsJustification'];
                $txbTutorComments = $row['bRequestsTutorComments'];
            }
            // set the number of items counter for javascript to read
            echo '<input type="hidden" name="numberOfItems" value="'.$count.'" />';
            //Display justification and tutor comments
            echo '<div class="form-group">
            <textarea class="form-control" type="textarea" name="justification" disabled value="'.$txbJustification.'" rows="3" placeholder="Justification:" required>'.$txbJustification.'</textarea>
            </div>';
            echo '                  </div>
            <div class="form-group">
            <textarea class="form-control" type="textarea" name="tutorComments" value="'.$txbTutorComments.'" rows="3" placeholder="Tutor Comments:">'.$txbTutorComments.'</textarea>
            </div>
            <div class="row mt-3 mb-5">
                <div class="col-5 mb-5 text-right">
                    <button type="submit" name="submit" value="submitStaffVerdict" style="width: 38%;" class="btn btn-primary" id="Save" wide="45">Submit</button>
                </div>
                </div>
                </form>
                </section>';
        }
    }
?>
                    
<?php
    require_once 'Staff/php/StaffFooter.php';//connects to the footer section for all pages for Admin
?>