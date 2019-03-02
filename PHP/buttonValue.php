<?php
    // start the session
    session_start();
    // connect to the database
    # echo " start Step 0.0..<br>"; // for testing purposes
    require_once 'connect.php';//connects to the SQL database.
    //connect to the functions
    # echo " start Step 1.0..<br>"; // for testing purposes
    require 'functions.php'; // connects to the functions.
    // Test
    echo 'This is the edit button press <br>';
    if(isset($_POST['submit']))
    {
      echo 'banana<br>';
    }





function multiPostButtonValue($buttonValueName) {
    require 'connect.php';//connects to the SQL database
    // input item name from submit, using $_POST
    $inputItemName = $_POST['submit'];
    $inputItemValues = $_POST['value'];  
    foreach ($inputItemValues as $inputItemValue) {
        //split the variable items into a list
        list($valueName, $valueNumber) = split("_", $inputItemValue);
        // OR split this variable item into name/value pair
        $item = split("_", $inputItemValue);
        // form item name
        $itemName = $item[0];
        // form item value
        $itemValue = $item[1];
        if ($itemName == $inputItemName) {
                $arrayOutput[] = $itemValue;
        } 
    } 
    return $arrayOutput;
}

?>