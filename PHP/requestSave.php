<?php
    // file name: requestSave.php
    // author: Mike Wright
    // date created: 25/02/2019

    //Start the Session
    echo "<p> start Step 1.0..</p>"; // for testing purposes
    session_start();

    // Ensures the DB is connected too
    require_once 'connect.php';//creates a connection to the database

    // Ensure functions are connected
    require 'functions.php'; // connects to the functions.

    echo " start Step 1.1..<br>"; // for testing purposes

    // Get the session variables
    $userid = $_SESSION['userid'];
    $userFirstName = $_SESSION['firstName'];
    $userLastName = $_SESSION['lastName'];
    $requestid = 0;
 

    // see which buttin is pressed and excecute a method accordingly, using switch
    switch ($_POST['submit']) {
        //echo " start Step 2.0..<br>"; // for testing purposes

        // if pressed save Drafts
        case 'saveRequest':
            echo " start Step 2.1..<br>"; // for testing purposes
            $courseTutorId = $_POST['courseTutorId'];
            $courseId = $_POST['courseid'];
            $txbJustication = $_POST['justification'];  
            $dateNow = date('Y/m/d');
            $bRequestsStatus = 'Draft'; //Draft because of saving the request
            // assign a counter
            $count = 1;
            #$itemDescription = "'itemdescription" . $count. "'";
            echo " start Step 2.1.a.<br>"; // for testing purposes
            // add new request section script here
            // create initial SQL query to add the Bursary request to the table/s
            $SQL_stmt = "INSERT INTO bursaryRequests(bRequestsCourseID,bRequestsStaffID, bRequestsJustification, bRequestsRequestDate, bRequestsStatus,bRequestsStudentRequest)
            VALUES ('$courseId', '$courseTutorId', '$txbJustication', '$dateNow', '$bRequestsStatus', TRUE)";
            
            $DBconnection->exec($SQL_stmt); //Insert request
            echo " start Step 2.1.b.<br>"; // for testing purposes
            //Acquire request id for that request (To link the items)
            $SQL_stmt = "SELECT bursaryRequests.bRequestsID AS 'requestId' FROM bursaryRequests
            WHERE bRequestsCourseID = '$courseId' AND bRequestsStaffID = '$courseTutorId'
            AND bRequestsJustification = '$txbJustication' AND bRequestsRequestDate = '$dateNow'
            AND bRequestsStatus = '$bRequestsStatus'";
    
            $requestid = 0;
            echo " start Step 2.1.c.<br>"; // for testing purposes
            //Get request id from query
            $result = $DBconnection->query($SQL_stmt);
            if ($row = $result->fetch()){
                $requestid = $row['requestId'];
            }
            echo " test echo 2.3.1.c : requestId id is:" . $requestid . "<br>";
            echo " start Step 2.1.d.<br>"; // for testing purposes
            #echo " test echo 2.1.a :" . $itemDescription . "<br>"; // for testing purposes
        // -loop through items which are in the form for items
            while (isset($_POST['itemprice' . $count]) > 0){
                // add count to POST item variables (this will be linked to request ID)
                $itemDescription = 'itemdescription' . $count;
                $itemCategory = 'itemcategory' . $count;
                $itemDescription = 'itemdescription' . $count;
                $itemURL = 'itemUrl' . $count;
                $itemPrice = 'itemprice' . $count;
                $itemPostage = 'itempostage' . $count;
                $itemAdditionalCharges = 'itemadditionalcharges' . $count;
                echo " test echo 2.2.b :" . $itemPrice . "<br>"; // for testing purposes
                $itemprice = $_POST[$itemPrice];
                echo " test echo 2.2.b :" . $itemprice . "<br>"; // for testing purposes

#                if (isset($_POST[$itemDescription]) && isset($_POST[$itemPrice])){
                    echo " start Step 2.3..<br>"; // for testing purposes
                        
                    //  If the form is submitted assign variables..
                    $itemcategory = $_POST[$itemCategory];
                    $itemdescription = $_POST[$itemDescription];
                    $itemUrl = $_POST[$itemURL];
                    $itemprice = $_POST[$itemPrice];
                    $itempostage = $_POST[$itemPostage];
                    $itemadditionalcharges = $_POST[$itemAdditionalCharges];
                    echo " test echo 2.3.1.a :" . $itemprice . "<br>"; // for testing purposes
                    // run SQL script to post the information..
            
                    //Add the item to the bursaryRequest items table
                    $SQL_stmt="INSERT INTO bursaryRequestItems (brItemCategory,brItemDesc,brItemURL,brItemPrice,brItemPostage,brItemAdditionalCharges)
                    VALUES ('$itemcategory', '$itemdescription' ,'$itemUrl', '$itemprice', '$itempostage', '$itemadditionalcharges')";
            
                    $DBconnection->exec($SQL_stmt); //Insert item to the items table
                  echo " test echo 2.3.1.b :" . $itemprice . "<br>"; // for testing purposes
                  
                    //Now retrieve item id of that item!
                    $SQL_stmt = "SELECT brItemID AS 'itemId' FROM bursaryRequestItems
                    WHERE brItemCategory = '$itemcategory' AND brItemDesc = '$itemdescription'
                    AND brItemURL = '$itemUrl' AND brItemPrice = '$itemprice'
                    AND brItemPostage = '$itempostage' AND brItemAdditionalCharges = '$itemadditionalcharges'";

                    $itemid = 0;

                    $result = $DBconnection->query($SQL_stmt); //Run query
                        
                        if ($row = $result->fetch()){ //Retrieve item id result
                            
                            $itemid = $row['itemId'];
                        }
                  echo " test echo 2.3.1.c : Item id is:" . $itemid . "<br>"; // for testing purposes
                  echo " test echo 2.3.1.c : request id is:" . $requestid . "<br>";
                  
                    //Now link item to the request and to student!
                    $SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
                    VALUES('$itemid', '$requestid', '$userid')";

                    $DBconnection->exec($SQL_stmt);//Link and loop again.
                  echo " test echo 2.3.1.d :" . $itemprice . "<br>"; // for testing purposes

                    
#                }
                if ($itemprice == NULL || $itemprice == 0 || $itemprice == ""){
                    echo " test echo 2.3.1.end :" . $itemprice . "<br>"; // for testing purposes
                    // return to page you were on as a fresh page
                    goBack();
                    break;
                  
                }
/*                if (empty($_POST[$itemDescription]) && empty($_POST[$itemPrice])){
                    // now need to get the final secion of the request form
                    if (isset($_POST['justification']) && isset($_POST['tutorComments'])){
                        //  assign last variables..
                        $justification = $_POST['justification'];
                        $tutorComments = $_POST['tutorComments'];



                        // now start the SQL script to post the request
                    }
                }*/
                $count++;
            }
            goBack();
            #header("Location: student_review_draft.php? activity=request_saved");
            break;

        // if pressed submit
        case 'submitRequest':
             echo " start Step 2.1..<br>"; // for testing purposes
            $courseTutorId = $_POST['courseTutorId'];
            $courseId = $_POST['courseid'];
            $txbJustication = $_POST['justification'];  
            $dateNow = date('Y/m/d');
            $bRequestsStatus = 'Submitted'; //Draft because of saving the request
            // assign a counter
            $count = 1;
            #$itemDescription = "'itemdescription" . $count. "'";
            echo " start Step 2.1.a.<br>"; // for testing purposes
            // add new request section script here
            // create initial SQL query to add the Bursary request to the table/s
            $SQL_stmt = "INSERT INTO bursaryRequests(bRequestsCourseID,bRequestsStaffID, bRequestsJustification, bRequestsRequestDate, bRequestsStatus,bRequestsStudentRequest)
            VALUES ('$courseId', '$courseTutorId', '$txbJustication', '$dateNow', '$bRequestsStatus', TRUE)";
            
            $DBconnection->exec($SQL_stmt); //Insert request
            echo " start Step 2.1.b.<br>"; // for testing purposes
            //Acquire request id for that request (To link the items)
            $SQL_stmt = "SELECT bursaryRequests.bRequestsID AS 'requestId' FROM bursaryRequests
            WHERE bRequestsCourseID = '$courseId' AND bRequestsStaffID = '$courseTutorId'
            AND bRequestsJustification = '$txbJustication' AND bRequestsRequestDate = '$dateNow'
            AND bRequestsStatus = '$bRequestsStatus'";
    
            $requestid = 0;
            echo " start Step 2.1.c.<br>"; // for testing purposes
            //Get request id from query
            $result = $DBconnection->query($SQL_stmt);
            if ($row = $result->fetch()){
                $requestid = $row['requestId'];
            }
            echo " test echo 2.3.1.c : requestId id is:" . $requestid . "<br>";
            echo " start Step 2.1.d.<br>"; // for testing purposes
            #echo " test echo 2.1.a :" . $itemDescription . "<br>"; // for testing purposes
        // -loop through items which are in the form for items
            while (isset($_POST['itemprice' . $count]) > 0){
                // add count to POST item variables (this will be linkef to request ID)
                $itemDescription = 'itemdescription' . $count;
                $itemCategory = 'itemcategory' . $count;
                $itemDescription = 'itemdescription' . $count;
                $itemURL = 'itemUrl' . $count;
                $itemPrice = 'itemprice' . $count;
                $itemPostage = 'itempostage' . $count;
                $itemAdditionalCharges = 'itemadditionalcharges' . $count;
                echo " test echo 2.2.b :" . $itemPrice . "<br>"; // for testing purposes
                $itemprice = $_POST[$itemPrice];
                echo " test echo 2.2.b :" . $itemprice . "<br>"; // for testing purposes

                if (isset($_POST[$itemDescription]) && isset($_POST[$itemPrice])){
                    echo " start Step 2.3..<br>"; // for testing purposes
                        
                    //  If the form is submitted assign variables..
                    $itemcategory = $_POST[$itemCategory];
                    $itemdescription = $_POST[$itemDescription];
                    $itemUrl = $_POST[$itemURL];
                    $itemprice = $_POST[$itemPrice];
                    $itempostage = $_POST[$itemPostage];
                    $itemadditionalcharges = $_POST[$itemAdditionalCharges];
                    echo " test echo 2.3.1.a :" . $itemprice . "<br>"; // for testing purposes
                    // run SQL script to post the information..
            
                    //Add the item to the bursaryRequest items table
                    $SQL_stmt="INSERT INTO bursaryRequestItems (brItemCategory,brItemDesc,brItemURL,brItemPrice,brItemPostage,brItemAdditionalCharges)
                    VALUES ('$itemcategory', '$itemdescription' ,'$itemUrl', '$itemprice', '$itempostage', '$itemadditionalcharges')";
            
                    $DBconnection->exec($SQL_stmt); //Insert item to the items table
                  echo " test echo 2.3.1.b :" . $itemprice . "<br>"; // for testing purposes
                  
                    //Now retrieve item id of that item!
                    $SQL_stmt = "SELECT brItemID AS 'itemId' FROM bursaryRequestItems
                    WHERE brItemCategory = '$itemcategory' AND brItemDesc = '$itemdescription'
                    AND brItemURL = '$itemUrl' AND brItemPrice = '$itemprice'
                    AND brItemPostage = '$itempostage' AND brItemAdditionalCharges = '$itemadditionalcharges'";

                    $itemid = 0;

                    $result = $DBconnection->query($SQL_stmt); //Run query
                        
                        if ($row = $result->fetch()){ //Retrieve item id result
                            
                            $itemid = $row['itemId'];
                        }
                  echo " test echo 2.3.1.c : Item id is:" . $itemid . "<br>"; // for testing purposes
                  echo " test echo 2.3.1.c : request id is:" . $requestid . "<br>";
                  
                    //Now link item to the request and to student!
                    $SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
                    VALUES('$itemid', '$requestid', '$userid')";

                    $DBconnection->exec($SQL_stmt);//Link and loop again.
                  echo " test echo 2.3.1.d :" . $itemprice . "<br>"; // for testing purposes
                    
                }
/*                if (empty($_POST["'"$itemDescription . 1"'"]) && empty($_POST["'"$itemPrice . 1"'"])){
                    // now need to get the final secion of the request form
                    if (isset($_POST['justification']) && isset($_POST['tutorComments'])){
                        //  assign last variables..
                        $justification = $_POST['justification'];
                        $tutorComments = $_POST['tutorComments'];



                        // now start the SQL script to post the request
                    }
                }*/
                $count++;
            }
            #header("Location: student_review_draft.php? activity=request_saved");
            break;
        
        case 'saveUpdated':
            echo " start Step 2.1..<br>"; // for testing purposes
            echo " We are in save updated<br>";
            $courseTutorId = $_SESSION['courseTutorId'];
            $courseId = $_SESSION['courseid'];
            $txbJustication = $_POST['justification'];  
            $bRequestsStatus = 'Draft'; //Draft because of saving the request
            $requestid = $_SESSION['requestId'];
            // assign a counter
            $count = 1;
            #$itemDescription = "'itemdescription" . $count. "'";
            echo " start Step 2.1.a.<br>"; // for testing purposes
            //Acquire request id for that request (To link the items)
            /*$SQL_stmt = "SELECT bursaryRequests.bRequestsID AS 'requestId' FROM bursaryRequests
            WHERE bRequestsCourseID = '$courseId' AND bRequestsStaffID = '$courseTutorId' 
            AND bRequestsStatus = '$bRequestsStatus'";
    
            $requestid = 0;
            echo " start Step 2.1.c.<br>"; // for testing purposes
            //Get request id from query
            $result = $DBconnection->query($SQL_stmt);
            if ($row = $result->fetch()){
                $requestid = $row['requestId'];
            }
            else{
              echo 'No request id found <br>';
            }*/
            $dateNow = date('Y/m/d'); //Set date right now.
            // add new request section script here
            // create initial SQL query to update the Bursary request to the table/s
            $SQL_stmt = "UPDATE bursaryRequests SET bRequestsCourseID = '$courseId', bRequestsStaffID = '$courseTutorId',
            bRequestsJustification = '$txbJustication', bRequestsRequestDate = '$dateNow', bRequestsStatus = '$bRequestsStatus',
            bRequestsStudentRequest = TRUE WHERE bRequestsID = '$requestid'";
            
            $DBconnection->exec($SQL_stmt); //Update request info
            echo " start Step 2.1.b.<br>"; // for testing purposes
            
            echo " test echo 2.3.1.c : requestId id is:" . $requestid . "<br>";
            echo " test echo 2.3.1.c : Justification  is:" . $txbJustication . "<br>";
            echo " start Step 2.1.d.<br>"; // for testing purposes
            #echo " test echo 2.1.a :" . $itemDescription . "<br>"; // for testing purposes
        // -loop through items which are in the form for items
            while (isset($_POST['itemprice' . $count]) > 0){
                // add count to POST item variables (this will be linked to request ID)
                $itemCategory = 'itemcategory' . $count;
                $itemDescription = 'itemdescription' . $count;
                $itemURL = 'itemUrl' . $count;
                $itemPrice = 'itemprice' . $count;
                $itemPostage = 'itempostage' . $count;
                $itemAdditionalCharges = 'itemadditionalcharges' . $count;
                echo " test echo 2.2.b :" . $itemPrice . "<br>"; // for testing purposes
                //$itemprice = $_POST[$itemPrice];
                echo " test echo 2.2.b :" . $itemprice . "<br>"; // for testing purposes

#                if (isset($_POST[$itemDescription]) && isset($_POST[$itemPrice])){
                    echo " start Step 2.3..<br>"; // for testing purposes
                        
                    //  If the form is submitted assign variables..
                    $itemcategory = $_POST[$itemCategory];
                    $itemdescription = $_POST[$itemDescription];
                    $itemUrl = $_POST[$itemURL];
                    $itemprice = $_POST[$itemPrice];
                    $itempostage = $_POST[$itemPostage];
                    $itemadditionalcharges = $_POST[$itemAdditionalCharges];
                    echo " test echo 2.3.1.a :" . $itemprice . "<br>"; // for testing purposes
                    echo " test echo 2.3.1.a :" . $itempostage . "<br>";
                    echo " test echo 2.3.1.a :" . $itemdescription . "<br>";
                    // run SQL script to post the information..
                    // Find item id of each item to update each item
                    
                    echo "This is item category:".$itemcategory." "; //Category is currently empty
                    //Now retrieve item id of each item in a loop
                    $SQL_stmt = "SELECT brItemID AS 'itemId' FROM bursaryRequestItems
                    WHERE brItemDesc = '$itemdescription' AND brItemCategory = '$itemcategory'
                    AND brItemURL = '$itemUrl' AND brItemPrice = '$itemprice'
                    AND brItemPostage = '$itempostage' AND brItemAdditionalCharges = '$itemadditionalcharges'";

                    $itemid = 0;

                    $result = $DBconnection->query($SQL_stmt); //Run query
                        
                        if ($row = $result->fetch()){ //Retrieve item id result
                            
                            $itemid = $row['itemId'];
                        }
                        else{
                          echo 'No item id found <br>';
                        }
                    //echo $itemid;
                    //Add the item to the bursaryRequest items table
                    $SQL_stmt="UPDATE bursaryRequestItems SET brItemCategory = '$itemcategory',
                    brItemDesc = '$itemdescription',brItemURL = '$itemUrl',brItemPrice = '$itemprice',
                    brItemPostage = '$itempostage',brItemAdditionalCharges = '$itemadditionalcharges'
                    WHERE brItemID = '".$itemid."'";
            
                    $DBconnection->exec($SQL_stmt); //update item to the items table
                    

                    echo " test echo 2.3.1.b :" . $itemprice . "<br>"; // for testing purposes
                    
                  
                    echo " test echo 2.3.1.c : Item id is:" . $itemid . "<br>"; // for testing purposes
                  echo " test echo 2.3.1.c : request id is:" . $requestid . "<br>";
                  
                    //Now update link items to the request and to student!
                    $SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID) VALUES('$itemid','$requestid','$userid')
                    ON DUPLICATE KEY UPDATE ItemID = '$itemid' WHERE RequestID = '$requestid' AND StudentID = '$userid'";

                    $DBconnection->exec($SQL_stmt);//Link and loop again.
                  echo " test echo 2.3.1.d :" . $itemprice . "<br>"; // for testing purposes

                    
#                }
                if ($itemprice == NULL || $itemprice == 0 || $itemprice == ""){
                    echo " test echo 2.3.1.end :" . $itemprice . "<br>"; // for testing purposes
                    // return to page you were on as a fresh page
                    goBack();
                    break;
                  
                }
/*                if (empty($_POST[$itemDescription]) && empty($_POST[$itemPrice])){
                    // now need to get the final secion of the request form
                    if (isset($_POST['justification']) && isset($_POST['tutorComments'])){
                        //  assign last variables..
                        $justification = $_POST['justification'];
                        $tutorComments = $_POST['tutorComments'];



                        // now start the SQL script to post the request
                    }
                }*/
                $count++;
            }
           // goBack();
            #header("Location: student_review_draft.php? activity=request_saved");
            break;
    }
?>