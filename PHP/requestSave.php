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

    // assign a counter
    $count = 0;
    # -loop through items which are in the form
    while (isset($_POST['itemcategory' . $count]) & !empty($_POST['itemcategory' . $count])
        if (isset($_POST['itemcategory' . $count]) && isset($_POST['itemdescription' . $count]) && isset($_POST['itemUrl' . $count]) && isset($_POST['itemprice' . $count]) && isset($_POST['itempostage' . $count]) && isset($_POST['itemadditionalcharges' . $count])){
            echo " start Step 2...<br>"; // for testing purposes

            #if(isset($_POST) & !empty($_POST)){
                
            //  If the form is submitted assign variables..
            $itemcategory . $count = $_POST['itemcategory' . $count];
            $itemdescription . $count = $_POST['itemdescription' . $count];
            $itemUrl . $count = $_POST['itemUrl' . $count];
            $itemprice . $count = $_POST['itemprice' . $count];
            $itempostage . $count = $_POST['itempostage' . $count];
            $itemadditionalcharges . $count = $_POST['itemadditionalcharges' . $count];
            // cycle counter
            $counter++;
        }
        if (empty($_POST['itemcategory' . $count . 1]){
            // now need to get the final secion of the request form
            if (isset($_POST['justification']) && isset($_POST['tutorComments'])){
                //  assign last variables..
                $justification = $_POST['justification'];
                $tutorComments = $_POST['tutorComments'];

                // now get the session variables need for posting the request to SQL
                $userid = $_SESSION['userid'];
                $userFirstName = $_SESSION['firstName'];
                $userLastName = $_SESSION['lastName'];

                // now start the SQL script to post the request
            }
        }
    }



?>