<body id="demo">
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
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $userid = $_SESSION['userid'];
    $userName = $firstName . " " . $lastName;
    $courseTitle = $_SESSION['courseTitle'];
    $courseTutorFirstName = $_SESSION['courseTutorFirstName'];
    $courseTutorLastName = $_SESSION['courseTutorLastName'];
    $courseTutorId = $_SESSION['courseTutorId'];
?>
<!-- <div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="false"> -->
 <!-- <section class="container mt-5 w-50"> -->
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
    // check to see which button was pressed.
    //// set a counter for this purpose
    $count = 1;
    //// set the name="submit" variable
    //IF statement does not work with 2 == only 1 =
    //if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
    if (isset($_POST['submit'])){
        echo " Loop .if.yes. Step B1.0..: " . $count . "<br>"; // for testing purposes
        $submitButtons = $_POST['submit'];
        echo "Submit submit Buttons: ".$submitButtons."<br>"; //No value (empty)
        // now let's split the result
        $item = split("_", $submitButtons);
        // form item name
        $itemName = $item[0];
        echo "Submit submit itemName: ".$itemName."<br>"; //No value (empty)
        // form item value
        $itemValue = $item[1];
        echo "Submit submit itemValue: ".$itemValue."<br>"; //No value (empty)
        $requestid = $itemValue;
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

                // output data from query
                echo '<div class="row">
                        <h5 class="m-2">Item ' . $count . '</h5>
                    </div>
                    <div class="form-group row">
                        <label for="categoryField" class="col-sm-2 col-form-label">Category field:</label>
                        <div class="col-sm-10 mt-2">
                            <select class="custom-select" id="categoryField">';                    
                echo '<option selected name="itemcategory' . $count . '">' . $itemcategory . '</option>';
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
        }
        // for deleting selected file
        if ($itemName == 'delete'){
            //carry out this action
            echo " Loop .2. Step 1.0..<br>"; // for testing purposes
            ### now process the required actions for delete

            // break out of the for loop
            break;
        }
    }
?>
                  </div>
<div class="row mt-3 mb-5">
    
    <div class="col-5 mb-5 text-right">
        <button type="submit" name="submit" value="saveRequest" style="width: 38%;" class="btn btn-primary" id="Save" wide="45">Save</button>
    </div>
  <!-- need to add button for adding new item (+)-->
    <a href="javascript:addItem()" style="width: 2.5em; height: 2.5;" class="btn btn-info" title="Add an Item"><span>&#43;</span></a>
    <div class="col-5 mb-5 text-right">
        <button type="submit" name="submit" value="submitRequest" style="width: 38%;" class="btn btn-success" id="Submit">Submit</button>
    </div>
</div>
</form>
<!-- </section> -->
            </div>
        </div>
    </div>
</body>

