<?php
    // start the session
    session_start();
    // connect to the database
    # echo " start Step 0.0..<br>"; // for testing purposes
    require_once 'connect.php';//connects to the SQL database.
    //include (Student/php/StudentReviewDraft_A.php);
    #require_once '../../Shared/php/AllHeader.php'; 
    //connect to the functions
    require 'functions.php'; // connects to the functions.
    # echo " start Step 1.0..<br>"; // for testing purposes

    #require 'functions.php'; // connects to the functions. // seems to fails to load page if this is loaded.
    // get session variables.
    $_SESSION['htmlTitle'] =  "View Form";
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $userid = $_SESSION['userid'];
    $userName = $firstName . " " . $lastName;
    $courseTitle = $_SESSION['courseTitle'];
    $courseTutorFirstName = $_SESSION['courseTutorFirstName'];
    $courseTutorLastName = $_SESSION['courseTutorLastName'];
    $courseTutorId = $_SESSION['courseTutorId'];
    // get the data for the submitted requests
    $submitTotal = getTotals ($userid, "Submitted");
    $approved = getTotals ($userid, "Approved");
    $pending = getStudentAwaitingDelivery($userid);
    $availableBalance = getStudentAvailableBalance($userid);
    require_once 'Shared/php/AllHeader.php';//connects to the header section for all pages
    require_once 'Student/php/StudentMenu.php';// Drop Down Menu for all student pages

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
    }
?>
<!-- testing -->

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
<!-- <div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="false"> -->
 <!-- <section class="container mt-5 w-50"> -->
 <section class="container mt-5 w-50">
   <!--Student Name -->          
  <div class="form-group row">
   <!--  <div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="false"> -->
        <!-- <div class="modal-dialog modal-lg" role="document"> -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle"> Bursary Request </h5>
                   <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false">&times;</span>
                    </button> -->
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
                                 echo '<input type="text" class="form-control" id="tutor" disabled value="'  .$courseTutorFirstName . ' ' . $courseTutorLastName . '" placeholder="Auto-generated field">';
                                ?>
                             </div>
                        </div>
                   <!-- For course tutor id, course id and user id --->
                  <input type="hidden" name="courseTutorId" value="<?php echo $_SESSION['courseTutorId'] ?>" />
                  <!-- Turtor Course id stored in session storage at login page -->
                  <input type="hidden" name="courseid" value="<?php echo $_SESSION['courseid'] ?>" />
                  <!--Student id -->
                  <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'] ?>" />
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
        if ($itemName == 'openRejected'){
            //Using the request id, find the item info (whether its approved or not)
            $SQL_stmt = "SELECT brItemID AS 'itemId', brItemCategory AS 'category', 
            brItemDesc AS 'item_description', brItemURL AS 'URL', 
            brItemPrice AS 'price', brItemPostage AS 'postage',
            brItemAdditionalCharges AS 'additional_charges',
            itemsAndRequests.StaffItemApproved AS 'staff',
            itemsAndRequests.AdminItemApproved AS 'admin' FROM bursaryRequestItems
            INNER JOIN itemsAndRequests ON itemsAndRequests.ItemID = bursaryRequestItems.brItemID 
            AND itemsAndRequests.RequestID = '" . $requestid . "'
            AND itemsAndRequests.StudentID = '" . $userid . "'";
            
            $result = $DBconnection->query($SQL_stmt);
            // set the counter, this is here as it is also used outside if the loop
            $count = 1;
            // now get the data
            $count = 1;
            echo '<div id = "newlink">';
            while ($row = $result->fetch()){
                // loop through the request results
                $staff = $row['staff']; //getting staff and admin approved values
                $admin = $row['admin'];
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
                
                $background = ""; //For background colour
                
                
                //echo $admin;
                //echo $staff;
                if($staff == 'No' || $admin == 'No')
                {
                    $background = "red";
                }
                else
                {
                    $background = "green";
                }
                //echo "Item id is :$itemId"; //For testing
                // output data from query
                echo '<div style="background-color: '.$background.';">
                <div class="row">
                        <h5 id="hd05" name="numberOfItems" class="m-2">Item ' . $count . '</h5>
                    </div>
                    <div class="form-group row">
                        <label for="categoryField" class="col-sm-2 col-form-label">Category field:</label>
                        <div class="col-sm-10 mt-2">
                            <select class="custom-select" id="categoryField" disabled value = "name="itemcategory' . $count . '"">';                    
                echo '<option disabled selected="'.$itemSelectedOptionNumber.'">' . $itemcategory . '</option>';
                echo '<option disabled value="1">Qualification</option>';
                echo '<option disabled value="2">Equipment</option>';
                echo '<option disabled value="3">Events</option>';
                echo '<option disabled value="4">Professional accreditation</option>';
                echo '<option disabled value="5">Vocational placement</option>';
                echo '</select>';
                echo '<input type="hidden" name="itemid'. $count .'" value="'.$itemId.'" />';
                // now output the data
                echo '      </div>
                        </div>
                        <div class="form-group">
                            <div>';
                                echo '<label for="itemDescription' . $count . '">Item description:</label>';
                                echo '<textarea class="form-control" id="itemDescription' . $count . '" disabled value = "name="itemdescription' . $count . '" rows="2"">' . $itemdescription . '</textarea>';
                                echo '</div>
                        </div>
            
                        <div class="form-group">
                            <div>';
                                echo '<label for="itemUrl' . $count . '">Item URL:</label>';
                                echo '<input type="text" class="form-control" name="itemUrl' . $count . '" placeholder="URL to the item:" disabled value="' . $itemUrl . '" />
                            </div>
                        </div>
                        
                        <div class="form-row justify-content-between text-center">
                            <div class="form-group col-md-2">
                            <label for="price' . $count . '">Price:</label>
                            <input type="text" class="form-control" name="itemprice' . $count . '" id="price" disabled  value="' . $itemprice . '" />
                            </div>
                            <div class="form-group col-md-2">
                            <label for="postage' . $count . '">Postage:</label>
                            <input type="text" class="form-control" name="itempostage' . $count . '" id="postage" disabled value="' . $itempostage . '" />
                            </div>
                            <div class="form-group col-md-3">
                            <label for="additionalFees' . $count . '">Additional Fees:</label>
                            <input type="text" class="form-control" name="itemadditionalcharges' . $count . '" id="additionalFees" disabled value="' . $itemadditionalcharges . '" />
                            </div>
                            </div>
                            </div>';
                            
                    // cycle counter
                    $count++;
            // break out of the for loop*/
            }
            
            //Now select justification to display.
            $SQL_stmt = "SELECT bRequestsTutorComments AS 'staffc', 
            bRequestsAdminComments AS 'adminc', bRequestsJustification
            FROM bursaryRequests WHERE bRequestsID = '". $requestid ."'";
            $txbJustification = 0;
            $staffc = 0;
            $adminc = 0;
            
            //Execute query
            $result = $DBconnection->query($SQL_stmt);
            
            if ($row = $result->fetch()){
                
                $txbJustification = $row['bRequestsJustification'];
                $staffc = $row['staffc'];//Retrieving comments 
                $adminc = $row['adminc'];
            }
            // set the number of items counter for javascript to read
            //echo '<input type="hidden" name="numberOfItems" value="'.$count.'" />';
            echo '</div><!--newlink end -->';
            //Display justification
            echo '<div class="form-group">
            <textarea class="form-control" type="textarea" name="justification" disabled value="'.$txbJustification.'" rows="3" placeholder="Justification:" required>'.$txbJustification.'</textarea>
            </div>';
            echo '<div class="form-group">
            <textarea class="form-control" type="textarea" name="tutorcomments" disabled value="'.$staffc.'" rows="3" placeholder="Tutor comments:" required>'.$staffc.'</textarea>
            </div>';
            echo '<div class="form-group">
            <textarea class="form-control" type="textarea" name="admincomments" disabled value="'.$adminc.'" rows="3" placeholder="Admin comments:" required>'.$adminc.'</textarea>
            </div>';  
        }
        if($itemName == "openSubmitted")
        {
            //Using the request id, find the item info (whether its approved or not)
            $SQL_stmt = "SELECT brItemID AS 'itemId', brItemCategory AS 'category', 
            brItemDesc AS 'item_description', brItemURL AS 'URL', 
            brItemPrice AS 'price', brItemPostage AS 'postage',
            brItemAdditionalCharges AS 'additional_charges',
            itemsAndRequests.StaffItemApproved AS 'staff',
            itemsAndRequests.AdminItemApproved AS 'admin' FROM bursaryRequestItems
            INNER JOIN itemsAndRequests ON itemsAndRequests.ItemID = bursaryRequestItems.brItemID 
            AND itemsAndRequests.RequestID = '" . $requestid . "'
            AND itemsAndRequests.StudentID = '" . $userid . "'";
            
            $result = $DBconnection->query($SQL_stmt);
            // set the counter, this is here as it is also used outside if the loop
            $count = 1;
            // now get the data
            $count = 1;
            echo '<div id = "newlink">';
            while ($row = $result->fetch()){
                // loop through the request results
                $staff = $row['staff']; //getting staff and admin approved values
                $admin = $row['admin'];
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
                
                $background = "white"; //For background colour
                
                
                //echo $admin;
                //echo $staff;
               /* if($staff == 'No' || $admin == 'No')
                {
                    $background = "red";
                }
                else
                {
                    $background = "green";
                }*/
                //echo "Item id is :$itemId"; //For testing
                // output data from query
                echo '<div style="background-color: '.$background.';">
                <div class="row">
                        <h5 id="hd05" name="numberOfItems" class="m-2">Item ' . $count . '</h5>
                    </div>
                    <div class="form-group row">
                        <label for="categoryField" class="col-sm-2 col-form-label">Category field:</label>
                        <div class="col-sm-10 mt-2">
                            <select class="custom-select" id="categoryField" disabled value = "name="itemcategory' . $count . '"">';                    
                echo '<option disabled selected="'.$itemSelectedOptionNumber.'">' . $itemcategory . '</option>';
                echo '<option disabled value="1">Qualification</option>';
                echo '<option disabled value="2">Equipment</option>';
                echo '<option disabled value="3">Events</option>';
                echo '<option disabled value="4">Professional accreditation</option>';
                echo '<option disabled value="5">Vocational placement</option>';
                echo '</select>';
                echo '<input type="hidden" name="itemid'. $count .'" value="'.$itemId.'" />';
                // now output the data
                echo '      </div>
                        </div>
                        <div class="form-group">
                            <div>';
                                echo '<label for="itemDescription' . $count . '">Item description:</label>';
                                echo '<textarea class="form-control" id="itemDescription' . $count . '" disabled value = "name="itemdescription' . $count . '" rows="2"">' . $itemdescription . '</textarea>';
                                echo '</div>
                        </div>
            
                        <div class="form-group">
                            <div>';
                                echo '<label for="itemUrl' . $count . '">Item URL:</label>';
                                echo '<input type="text" class="form-control" disabled name="itemUrl' . $count . '" placeholder="URL to the item:" value="' . $itemUrl . '" />
                            </div>
                        </div>
                        
                        <div class="form-row justify-content-between text-center">
                            <div class="form-group col-md-2">
                            <label for="price' . $count . '">Price:</label>
                            <input type="text" class="form-control" name="itemprice' . $count . '" id="price" disabled  value="' . $itemprice . '" />
                            </div>
                            <div class="form-group col-md-2">
                            <label for="postage' . $count . '">Postage:</label>
                            <input type="text" class="form-control" name="itempostage' . $count . '" id="postage" disabled value="' . $itempostage . '" />
                            </div>
                            <div class="form-group col-md-3">
                            <label for="additionalFees' . $count . '">Additional Fees:</label>
                            <input type="text" class="form-control" name="itemadditionalcharges' . $count . '" id="additionalFees" disabled value="' . $itemadditionalcharges . '" />
                            </div>
                            </div>
                            </div>';
                            
                    // cycle counter
                    $count++;
            // break out of the for loop*/
            }
            
            //Now select justification to display.
            $SQL_stmt = "SELECT bRequestsTutorComments AS 'staffc', 
            bRequestsAdminComments AS 'adminc', bRequestsJustification
            FROM bursaryRequests WHERE bRequestsID = '". $requestid ."'";
            $txbJustification = 0;
            $staffc = 0;
            $adminc = 0;
            
            //Execute query
            $result = $DBconnection->query($SQL_stmt);
            
            if ($row = $result->fetch()){
                
                $txbJustification = $row['bRequestsJustification'];
                $staffc = $row['staffc'];//Retrieving comments 
                $adminc = $row['adminc'];
            }
            // set the number of items counter for javascript to read
            //echo '<input type="hidden" name="numberOfItems" value="'.$count.'" />';
            echo '</div><!--newlink end -->';
            //Display justification
            echo '<div class="form-group">
            <textarea class="form-control" type="textarea" name="justification" disabled value="'.$txbJustification.'" rows="3" placeholder="Justification:" required>'.$txbJustification.'</textarea>
            </div>';
            echo '<div class="form-group">
            <textarea class="form-control" type="textarea" name="tutorcomments" disabled value="'.$staffc.'" rows="3" placeholder="Tutor comments:" required>'.$staffc.'</textarea>
            </div>';
            echo '<div class="form-group">
            <textarea class="form-control" type="textarea" name="admincomments" disabled value="'.$adminc.'" rows="3" placeholder="Admin comments:" required>'.$adminc.'</textarea>
            </div>'; 
        }
    }
?>


                 
</section>
<!-- </section> -->
<?php
    require_once 'Student/php/StudentFooter.php';//connects to the footer section for all pages for Admin
?>