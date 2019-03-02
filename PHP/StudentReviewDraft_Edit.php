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
    $_SESSION['htmlTitle'] =  "Review my drafts";
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
    $pending = getTotals ($userid, "Pending");
    $availableBalance = getStudentAvailableBalance($userid);
    require_once 'Shared/php/AllHeader.php';//connects to the header section for all pages
    require_once 'Student/php/StudentMenu.php';// Drop Down Menu for all student pages
?>
<!-- testing -->
<script src="./Scripts/studentJava.js" type="text/javascript"></script>
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
                    <h5 class="modal-title" id="ModalLongTitle">Bursary request</h5>
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
                                 echo '<input type="text" class="form-control" id="tutor" disabled value="' . $courseTutorFirstName . ' ' . $courseTutorLastName . '" placeholder="Auto-generated field">';
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
    $count = 1;
    //// set the name="submit" variable
    //IF statement does not work with 2 == only 1 =
    //if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
    if (isset($_POST['submit'])){
#        echo " Loop .if.yes. Step B1.0..: " . $count . "<br>"; // for testing purposes
        $submitButtons = $_POST['submit'];
#        echo "Submit submit Buttons: ".$submitButtons."<br>"; //No value (empty)
        // now let's split the result
        $item = split("_", $submitButtons);
        // form item name
        $itemName = $item[0];
#        echo "Submit submit itemName: ".$itemName."<br>"; //No value (empty)
        // form item value
        $itemValue = $item[1];
#        echo "Submit submit itemValue: ".$itemValue."<br>"; //No value (empty)
        $requestid = $itemValue;
        $_SESSION['requestId'] = $requestid;
        // for editing drafts
        if ($itemName == 'edit'){
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
                $itemSelectedOptionNumber = 0;
                if ($itemcategory == 'Qualification'){$itemSelectedOptionNumber = 1;}
                if ($itemcategory == 'Equipment'){$itemSelectedOptionNumber = 2;}
                if ($itemcategory == 'Events'){$itemSelectedOptionNumber = 3;}
                if ($itemcategory == 'Professional accreditation'){$itemSelectedOptionNumber = 4;}
                if ($itemcategory == 'Vocational placement'){$itemSelectedOptionNumber = 5;}

                // output data from query
                echo '<div class="row">
                        <h5 class="m-2">Item ' . $count . '</h5>
                    </div>
                    <div class="form-group row">
                        <label for="categoryField" class="col-sm-2 col-form-label">Category field:</label>
                        <div class="col-sm-10 mt-2">
                            <select class="custom-select" id="categoryField">';                    
                echo '<option selected="'.$itemSelectedOptionNumber.'" name="itemcategory' . $count . '">' . $itemcategory . '</option>';
                echo '<option value="1">Qualification</option>';
                echo '<option value="2">Equipment</option>';
                echo '<option value="3">Events</option>';
                echo '<option value="4">Professional accreditation</option>';
                echo '<option value="5">Vocational placement</option>';
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
                                <input type="text" class="form-control" name="itemUrl' . $count . '" placeholder="URL to the item:" value="' . $itemUrl . '" />
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
            break;
            }
            //Now select justification to display.
            $SQL_stmt = "SELECT bRequestsJustification FROM bursaryRequests WHERE bRequestsID = '".$requestid."'";
            $txbJustification = 0;
            //Execute query
            $result = $DBconnection->query($SQL_stmt);
            
            if ($row = $result->fetch()){
                
                $txbJustification = $row['bRequestsJustification'];
            }
            //Display justification
            echo '<div class="form-group">
            <textarea class="form-control" type="textarea" name="justification" value="'.$txbJustification.'" rows="3" placeholder="Justification:" required>'.$txbJustification.'</textarea>
            </div>';
          
        }
        // for deleting selected file (need HTML code)
        if ($itemName == 'delete'){
            //carry out this action
            echo " Loop .2. Step 1.0..<br>"; // for testing purposes
            ### now process the required actions for delete
          
            //Query for delete using request id
            
            //Refresh page?
          
            // break out of the for loop
            break;
        }
    }
?>
                  </div>
<div class="row mt-3 mb-5">
    
    <div class="col-5 mb-5 text-right">
        <button type="submit" name="submit" value="saveUpdated" style="width: 38%;" class="btn btn-primary" id="Save" wide="45">Save</button>
    </div>
  <!-- need to add button for adding new item (+)-->
    <div class="col-5 mb-5 text-right">
        <button type="submit" name="submit" value="submitUpdated" style="width: 38%;" class="btn btn-success" id="Submit">Submit</button>
    </div>
</div>
</form>
</section>
<!-- </section> -->
<?php
    require_once 'Student/php/StudentFooter.php';//connects to the footer section for all pages for Admin
?>