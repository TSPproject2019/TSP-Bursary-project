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

    // see which buttin is pressed and excecute a method accordingly, using switch
    switch ($_POST['submit']) {
        //echo " start Step 2.0..<br>"; // for testing purposes

        // if pressed save
        case 'saveRequest':
            echo " start Step 2.1..<br>"; // for testing purposes
            // create initial SQL query to add the Items to the table/s
            $SQL_stmt = "";
            // assign a counter
            $count = 1;
            #$itemDescription = "'itemdescription" . $count. "'";
            #echo " test echo 2.1.a :" . $itemDescription . "<br>"; // for testing purposes
            # -loop through items which are in the form
            while (!empty($_POST["'itemprice" . $count . "'"]) == FALSE){
                // add count to POST item variables
                $itemDescription = "'itemdescription" . $count. "'";
                $itemCategory = "'itemcategory" . $count . "'";
                $itemDescription = "'itemdescription" . $count. "'";
                $itemURL = "'itemUrl" . $count . "'";
                $itemPrice = "'itemprice" . $count . "'";
                $itemPostage = "'itempostage" . $count . "'";
                $itemAdditionalCharges = "'itemadditionalcharges" . $count . "'";
                echo " test echo 2.1.b :" . $itemPrice . "<br>"; // for testing purposes
/*
                if (isset($_POST[$itemCategory]) && isset($_POST[$itemDescription]) && isset($_POST[$itemURL]) && isset($_POST[$itemPrice]) && isset($_POST[$itemPostage]) && isset($_POST[$itemAdditionalCharges])){
                    echo " start Step 2...<br>"; // for testing purposes
                        
                    //  If the form is submitted assign variables..
                    $itemcategory = $_POST[$itemCategory];
                    $itemdescription = $_POST[$itemDescription];
                    $itemUrl = $_POST[$itemURL];
                    $itemprice = $_POST[$itemPrice];
                    $itempostage = $_POST[$itemPostage];
                    $itemadditionalcharges = $_POST[$itemAdditionalCharges];
                    // cycle counter
                    #$count++;
                }
                if (empty($_POST["'"$itemDescription . 1"'"]) && empty($_POST["'"$itemPrice . 1"'"])){
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

        // if pressed submit
        case 'submitRequest':
            echo " start Step 2.2..<br>"; // for testing purposes
            // create initial SQL query to add the Items to the table/s
            $SQL_stmt = "";
            // assign a counter
            $count = 1;
            #$itemDescription = "'itemdescription" . $count. "'";
            #echo " test echo 2.2.a :" . $itemDescription . "<br>"; // for testing purposes
            # -loop through items which are in the form
            while (!empty($_POST["'itemprice" . $count . "'"]) == FALSE){
                // add count to POST item variables
                $itemCategory = "'itemcategory" . $count . "'";
                $itemDescription = "'itemdescription" . $count. "'";
                $itemURL = "'itemUrl" . $count . "'";
                $itemPrice = "'itemprice" . $count . "'";
                $itemPostage = "'itempostage" . $count . "'";
                $itemAdditionalCharges = "'itemadditionalcharges" . $count . "'";
                echo " test echo 2.2.b :" . $itemPrice . "<br>"; // for testing purposes

                if (isset($_POST[$itemCategory]) && isset($_POST[$itemDescription]) && isset($_POST[$itemURL]) && isset($_POST[$itemPrice]) && isset($_POST[$itemPostage]) && isset($_POST[$itemAdditionalCharges])){
                    echo " start Step 2...<br>"; // for testing purposes
                        
                    //  If the form is submitted assign variables..
                    $itemcategory = $_POST[$itemCategory];
                    $itemdescription = $_POST[$itemDescription];
                    $itemUrl = $_POST[$itemURL];
                    $itemprice = $_POST[$itemPrice];
                    $itempostage = $_POST[$itemPostage];
                    $itemadditionalcharges = $_POST[$itemAdditionalCharges];
                    echo " test echo 2.2.1.a :" . $itemprice . "<br>"; // for testing purposes
                    // cycle counter
                    
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
            #header("Location: student_review_draft.php? activity=request_submitted");
            break;

    }



?>