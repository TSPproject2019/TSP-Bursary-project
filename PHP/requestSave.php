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
    $userType = $_SESSION['userType']; //user type
    $requestid = 0;
    $testCounter = 0; // this is for testing
    $goToPage = 0; // for switch end go back requirements
 
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
            $goToPage = 1;
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
                $testCounter++;
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
                    #goBack();
                    break;
                  
                }
                if ($testCounter >= 100){break;}// for testing, Limits the overpopulation potential overflow loop occurring
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
            #goBack();
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
            $goToPage = 1;
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
                $testCounter++;
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
                if ($testCounter >= 100){break;}// for testing, Limits the overpopulation potential overflow loop occurring
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
            // assign whitch page to go back to.
            $goToPage = 2;
            #$itemDescription = "'itemdescription" . $count. "'";
            echo " start Step 2.1.a.<br>"; // for testing purposes
            //Acquire request id for that request (To link the items)
            /*$SQL_stmt = "SELECT bursaryRequests.bRequestsID AS 'requestId' FROM bursaryRequests
            WHERE bRequestsCourseID = '$courseId' AND bRequestsStaffID = '$courseTutorId' 
            AND bRequestsStatus = '$bRequestsStatus'";
    echo 'this is user:'$userType;
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
                $testCounter++;
                // add count to POST item variables (this will be linked to request ID)
                $itemCategory = 'itemcategory' . $count;
                $itemDescription = 'itemdescription' . $count;
                $itemURL = 'itemUrl' . $count;
                $itemPrice = 'itemprice' . $count;
                $itemPostage = 'itempostage' . $count;
                $itemAdditionalCharges = 'itemadditionalcharges' . $count;
                $itemID = 'itemid' . $count;
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
                    $itemid = $_POST[$itemID]; //Gets item id of that item
                    echo " test echo 2.3.1.a :" . $itemprice . "<br>"; // for testing purposes
                    echo " test echo 2.3.1.a :" . $itempostage . "<br>";
                    echo " test echo 2.3.1.a :" . $itemdescription . "<br>";
                    if ($itemcategory == 1){$itemcategory = 'Qualification';}
                    if ($itemcategory == 2){$itemcategory = 'Equipment';}
                    if ($itemcategory == 3){$itemcategory = 'Events';}
                    if ($itemcategory == 4){$itemcategory = 'Professional accreditation';}
                    if ($itemcategory == 5){$itemcategory = 'Vocation placement';}
                
                    // run SQL script to post the information..
                    // Find item id of each item to update each item
                    
                   // echo "This is item category:". $itemcategory. "<br>"; //Category is currently empty
                    //Now retrieve item id of each item in a loop
                   /* $SQL_stmt = "SELECT brItemID AS 'itemId' FROM bursaryRequestItems
                    WHERE brItemDesc = '$itemdescription' AND brItemURL = '$itemUrl' 
                    AND brItemPrice = '$itemprice' AND brItemPostage = '$itempostage' 
                    AND brItemAdditionalCharges = '$itemadditionalcharges'";

                    $itemid = 0;

                    $result = $DBconnection->query($SQL_stmt); //Run query
                        
                        if ($row = $result->fetch()){ //Retrieve item id result
                            
                            $itemid = $row['itemId'];
                        }
                        else{
                          echo 'No item id found <br>';
                        }*/
                    //echo $itemid; //For testing
                    
                    if(empty($itemid)) //If item id is empty, add the new item and link to request
                    {
                       $SQL_stmt="INSERT INTO bursaryRequestItems (brItemCategory,brItemDesc,brItemURL,brItemPrice,brItemPostage,brItemAdditionalCharges)
                       VALUES ('$itemcategory', '$itemdescription' ,'$itemUrl', '$itemprice', '$itempostage', '$itemadditionalcharges')";
            
                       $DBconnection->exec($SQL_stmt); //Insert item to the items table
                        
                      //now select new item id of the added item
                       $SQL_stmt = "SELECT brItemID AS 'itemId' FROM bursaryRequestItems
                       WHERE brItemDesc = '$itemdescription' AND brItemCategory = '$itemcategory' 
                       AND brItemURL = '$itemUrl' AND brItemPrice = '$itemprice'
                       AND brItemPostage = '$itempostage' AND brItemAdditionalCharges = '$itemadditionalcharges'";

                       $itemid = 0;

                       $result = $DBconnection->query($SQL_stmt); //Run query

                         if ($row = $result->fetch()){ //Retrieve item id result

                                $itemid = $row['itemId'];
                            }
                      
                       //Now link item to the request and to student!
                       $SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
                       VALUES('$itemid', '$requestid', '$userid')";

                       $DBconnection->exec($SQL_stmt);//Link and loop again.
                    }
                    if(!empty($itemid)) //update item and insert/update to request and student
                    {
                      echo "Updating item<br>";
                      $SQL_stmt="UPDATE bursaryRequestItems SET brItemCategory = '$itemcategory',
                      brItemDesc = '$itemdescription',brItemURL = '$itemUrl',brItemPrice = '$itemprice',
                      brItemPostage = '$itempostage',brItemAdditionalCharges = '$itemadditionalcharges'
                      WHERE brItemID = '".$itemid."'";

                      $DBconnection->exec($SQL_stmt); //update item to the items table


                      echo " test echo 2.3.1.b :" . $itemprice . "<br>"; // for testing purposes


                      echo " test echo 2.3.1.c : Item id is:" . $itemid . "<br>"; // for testing purposes
                      echo " test echo 2.3.1.c : request id is:" . $requestid . "<br>";

                      //Now update link items to the request and to student!
                      //Removed for testing. Seems to be working fine without cause query doesnt execute
                      /*$SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID) VALUES('$itemid','$requestid','$userid')
                      ON DUPLICATE KEY UPDATE ItemID = '$itemid', RequestID = '$requestid', StudentID = '$userid' 
                      WHERE RequestID = '$requestid' AND ItemID = '$itemid'";

                      $DBconnection->exec($SQL_stmt);//Link and loop again. */
                      
                      //Does not need an update on the link because item exists
                      
                      echo "Query executed.<br>";
                      echo " test echo 2.3.1.d :" . $itemprice . "<br>"; // for testing purposes
                    }
                    //Add the item to the bursaryRequest items table
                    

                    
#                }
                if ($itemprice == NULL || $itemprice == 0 || $itemprice == ""){
                    echo " test echo 2.3.1.end :" . $itemprice . "<br>"; // for testing purposes
                    // return to page you were on as a fresh page
                    break;
                  
                }
                if ($testCounter >= 100){break;}// for testing, Limits the overpopulation potential overflow loop occurring
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
            break;
        
        
        case 'submitUpdated':
            echo " start Step 2.1..<br>"; // for testing purposes
            echo " We are in submit updated<br>";
            $courseTutorId = $_SESSION['courseTutorId'];
            $courseId = $_SESSION['courseid'];
            $txbJustication = $_POST['justification'];  
            $bRequestsStatus = 'Submitted'; //Submitted because of submitting the request
            $requestid = $_SESSION['requestId'];
            // assign a counter
            $count = 1;
            $goToPage = 5;
            echo " start Step 2.1.a.<br>"; // for testing purposes
           
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
                $testCounter++;
                // add count to POST item variables (this will be linked to request ID)
                $itemCategory = 'itemcategory' . $count;
                $itemDescription = 'itemdescription' . $count;
                $itemURL = 'itemUrl' . $count;
                $itemPrice = 'itemprice' . $count;
                $itemPostage = 'itempostage' . $count;
                $itemAdditionalCharges = 'itemadditionalcharges' . $count;
                $itemID = 'itemid' . $count;
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
                    $itemid = $_POST[$itemID];
                
                    if ($itemcategory == 1){$itemcategory = 'Qualification';}
                    if ($itemcategory == 2){$itemcategory = 'Equipment';}
                    if ($itemcategory == 3){$itemcategory = 'Events';}
                    if ($itemcategory == 4){$itemcategory = 'Professional accreditation';}
                    if ($itemcategory == 5){$itemcategory = 'Vocation placement';}
                    echo " test echo 2.3.1.a :" . $itemprice . "<br>"; // for testing purposes
                    echo " test echo 2.3.1.a :" . $itempostage . "<br>";
                    echo " test echo 2.3.1.a :" . $itemdescription . "<br>";
                    // run SQL script to post the information..
                    // Find item id of each item to update each item
                    
                    echo "This is item category:".$itemcategory." "; //Category is currently empty
                    //Now retrieve item id of each item in a loop
                    /*$SQL_stmt = "SELECT brItemID AS 'itemId' FROM bursaryRequestItems
                    WHERE brItemDesc = '$itemdescription' AND brItemURL = '$itemUrl' 
                    AND brItemPrice = '$itemprice' AND brItemPostage = '$itempostage' 
                    AND brItemAdditionalCharges = '$itemadditionalcharges'";

                    $itemid = 0;

                    $result = $DBconnection->query($SQL_stmt); //Run query
                        
                        if ($row = $result->fetch()){ //Retrieve item id result
                            
                            $itemid = $row['itemId'];
                        }
                        else{
                          echo 'No item id found <br>';
                        } */
                    //echo $itemid;
                   // echo $itemid; //For testing
                    
                    if(empty($itemid)) //If item id is empty, add the new item and link to request
                    {
                       $SQL_stmt="INSERT INTO bursaryRequestItems (brItemCategory,brItemDesc,brItemURL,brItemPrice,brItemPostage,brItemAdditionalCharges)
                       VALUES ('$itemcategory', '$itemdescription' ,'$itemUrl', '$itemprice', '$itempostage', '$itemadditionalcharges')";
            
                       $DBconnection->exec($SQL_stmt); //Insert item to the items table
                        
                      //now select new item id of the added item
                       $SQL_stmt = "SELECT brItemID AS 'itemId' FROM bursaryRequestItems
                       WHERE brItemDesc = '$itemdescription' AND brItemCategory = '$itemcategory' 
                       AND brItemURL = '$itemUrl' AND brItemPrice = '$itemprice'
                       AND brItemPostage = '$itempostage' AND brItemAdditionalCharges = '$itemadditionalcharges'";

                       $itemid = 0;

                       $result = $DBconnection->query($SQL_stmt); //Run query

                         if ($row = $result->fetch()){ //Retrieve item id result

                                $itemid = $row['itemId'];
                            }
                      
                       //Now link item to the request and to student!
                       $SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
                       VALUES('$itemid', '$requestid', '$userid')";

                       $DBconnection->exec($SQL_stmt);//Link and loop again.
                    }
                    if(!empty($itemid)) //update item and insert/update to request and student
                    {
                      $SQL_stmt="UPDATE bursaryRequestItems SET brItemCategory = '$itemcategory',
                      brItemDesc = '$itemdescription',brItemURL = '$itemUrl',brItemPrice = '$itemprice',
                      brItemPostage = '$itempostage',brItemAdditionalCharges = '$itemadditionalcharges'
                      WHERE brItemID = '".$itemid."'";

                      $DBconnection->exec($SQL_stmt); //update item to the items table


                      echo " test echo 2.3.1.b :" . $itemprice . "<br>"; // for testing purposes


                      echo " test echo 2.3.1.c : Item id is:" . $itemid . "<br>"; // for testing purposes
                      echo " test echo 2.3.1.c : request id is:" . $requestid . "<br>";

                      /*//Now update link items to the request and to student!
                      $SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID) VALUES('$itemid','$requestid','$userid')
                      ON DUPLICATE KEY UPDATE ItemID = '$itemid' WHERE RequestID = '$requestid' AND StudentID = '$userid'";

                      $DBconnection->exec($SQL_stmt);//Link and loop again. */
                        
                      //Does not need link here as the item exists already and is linked by default
                      echo " test echo 2.3.1.d :" . $itemprice . "<br>"; // for testing purposes
                    }
                    //Add the item to the bursaryRequest items table
                    

                    
#                }
                if ($itemprice == NULL || $itemprice == 0 || $itemprice == ""){
                    echo " test echo 2.3.1.end :" . $itemprice . "<br>"; // for testing purposes
                    // return to page you were on as a fresh page
                    #goBack();
                    break;
                  
                }
                if ($testCounter >= 100){break;}// for testing, Limits the overpopulation potential overflow loop occurring
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
            break;
            
        case "submitStaffVerdict":
            echo " start Step 2.1..<br>"; // for testing purposes
            echo " We are in submit updated<br>";
            $courseTutorId = $_SESSION['courseTutorId'];
            $courseId = $_SESSION['courseid'];
            $txbJustication = $_POST['justification'];  
            $txbTutorComments = $_POST['tutorComments'];
            $requestid = $_SESSION['requestId'];
            $approveCounter = 0;
            $rejectCounter = 0;
            // assign a counter
            $count = 1;
            $goToPage = 8;
            echo " start Step 2.1.a.<br>";
            echo "Tutor comments: '$txbTutorComments'<br>";
            echo " start Step 2.1.'$requestid'<br>";// for testing purposes
   
        // -loop through items which are in the form for items
            while (isset($_POST['itemprice' . $count]) > 0){
                $testCounter++;
                // add count to POST item variables (this will be linked to request ID)
                $itemCategory = 'itemcategory' . $count;
                $itemDescription = 'itemdescription' . $count;
                $itemURL = 'itemUrl' . $count;
                $itemPrice = 'itemprice' . $count;
                $itemPostage = 'itempostage' . $count;
                $itemAdditionalCharges = 'itemadditionalcharges' . $count;
                $itemID = 'itemid' . $count;
                $buttonValue = 'radio' . $count; 
                echo " test echo 2.2.b :" . $itemPrice . "<br>"; // for testing purposes
                //$itemprice = $_POST[$itemPrice];
                echo " test echo 2.2.b :" . $itemprice . "<br>";
                echo " test echo 2.2.b :" . $accept . "<br>";// for testing purposes

#                if (isset($_POST[$itemDescription]) && isset($_POST[$itemPrice])){
                    echo " start Step 2.3..<br>"; // for testing purposes
                        
                    //  If the form is submitted assign variables..
                    $itemcategory = $_POST[$itemCategory];
                    $itemdescription = $_POST[$itemDescription];
                    $itemUrl = $_POST[$itemURL];
                    $itemprice = $_POST[$itemPrice];
                    $itempostage = $_POST[$itemPostage];
                    $itemadditionalcharges = $_POST[$itemAdditionalCharges];
                    $itemid = $_POST[$itemID];
                    $acceptReject = $_POST[$buttonValue]; //For approve/reject items
                    
                    echo $acceptReject;
                    echo "Item id is:'$itemid'";
                    echo $requestid;
                    if($acceptReject == "approved")
                    {
                        echo " start Step 2.3 approved..<br>";
                        $approveCounter++;//Increment approved counter
                        //Approve that specific item
                        $SQL_stmt = "UPDATE itemsAndRequests SET StaffItemApproved = 'Yes'
                        WHERE ItemID = '".$itemid."' AND RequestID = '".$requestid."'";
                        
                        $DBconnection->exec($SQL_stmt);//Execute query
                        
                        
                        echo " start Step 2.3 approved done.<br>";
                    }
                    elseif($acceptReject == "rejected")
                    {
                        echo " start Step 2.3 rejected..<br>";
                        $rejectCounter++; //Increment reject counter
                        //Reject that item
                        $SQL_stmt = "UPDATE itemsAndRequests SET StaffItemApproved = 'No'
                        WHERE ItemID = '".$itemid."' AND RequestID = '".$requestid."'";
                        
                        $DBconnection->exec($SQL_stmt);//Execute query
                        
                        echo " start Step 2.3 rejected done.<br>";
                        
                        
                    }
                    if ($testCounter >= 100){break;}
                $count++;
            }
            //If all items have been approved, approve the whole request 
            //(-1 because counter increments one more time in the end)
            if($approveCounter == $count-1)
            {
                $SQL_stmt = "UPDATE bursaryRequests SET bRequestsStaffApproved = 'Yes'
                WHERE bRequestsID = '".$requestid."'";
                        
                $DBconnection->exec($SQL_stmt);//Execute query
                echo 'Approved request';
                
            }elseif($rejectCounter >= 1){ //If at least one item has been rejected
                //Reject the whole request.
                $SQL_stmt = "UPDATE bursaryRequests SET bRequestsStaffApproved = 'No',
                bRequestsTutorComments = '".$txbTutorComments."'
                WHERE bRequestsID = '".$requestid."'";
                        
                $DBconnection->exec($SQL_stmt);//Execute query
                
                echo 'Rejected request';
            }
            break;
    }
   // echo " SWITCH..CASE..End....<br>"; // for testing purposes
    #header("Location: student_home.php");
// start with the if ($gTooPage == 2){/then  / th;eif ($userType == 'watevere'...)}else
 /*if($goToPage == 2)
    {
       // echo $userType;
        if($userType == "Student")//This does not work.
        {
             header ("Location: student_review_draft.php? activity=request_draft_updated");
        }
        if($userType == "Staff")
        {
            header ("Location: staff_review_drafts.php? activity=request_draft_updated");
        }
    }elseif($goToPage == 5){
        if($userType == "Student")
        {
           header ("Location: student_submitted.php? activity=request_submitted");
        }
    }elseif($goToPage == 8){
      if($userType == "Staff")
      {
         header ("Location: staff_student_submissions.php? activity=submitted");
      }
    }else{goBack();}*/
         // new if here
   /* if($userType == "Student")
    {
        if ($goToPage == 2){
         //echo " SWITCH..CASE.2.End....<br>"; // for testing purposes
         header ("Location: student_review_draft.php? activity=request_draft_updated");
         //echo " SWITCH..CASE.3.End....<br>"; // for testing purposes
        }
        if($goToPage == 5)
        {
             header ("Location: student_submitted.php? activity=request_submitted");
        }
        else{
             goBack();
        }
    }
    if($userType == "Staff")
    {
        
    }*/
?>