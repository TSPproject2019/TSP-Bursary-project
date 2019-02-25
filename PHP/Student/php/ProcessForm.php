<!--Created by Andrius 20-02-2019 -->
<!-- New student bursury request form submission processing -->
<!--Version 1.0 -->

<?php
session_start();
//require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  if(isset($_POST['submit'])) {
    $courseTutorId = $_POST['courseTutorId'];
    $courseid = $_POST['courseid']; 
    $userid = $_POST['userid'];
    $txbItemCategory = $_POST['itemcategory'];
    $txbItemDescription = $_POST['itemdescription'];
    $itemURL = $_POST['itemUrl'];
    $txbPrice = $_POST['itemprice'];
    $txbPostage = $_POST['itempostage'];
    $txbAdditionalCharges = $_POST['itemadditionalcharges'];
    $txbJustication = $_POST['justification'];  
    $dateNow = date('Y/m/d');
    $bRequestsStatus = 'Submitted';
    
    
  
    echo "<h2>Form submitted!<br /></h2>";
    echo "<p>Values submitted:</p>
            <ul>
              <li>Category field: $txbItemCategory</li>
              <li>Course Tutor id: $courseTutorId</li>
              <li>Student id: $userid</li> 
              <li>Student course id: $courseid</li>
              <li>Item description: $txbItemDescription </li>
              <li>Item URL: $itemURL</li>
              <li>Item Price: $txbPrice</li>
              <li>Item Postage Fee: $txbPostage</li>
              <li>Item Additional Charges: $txbAdditionalCharges</li>
              <li>Justification: $txbJustication</li>
              <li>Date and Time: $dateNow </li>
              <li>Request status: $bRequestsStatus</li>
            </ul>";
  }
/*
//Connect to database using PDO //Or just use require connect.php?
$DB_Host = 'localhost';
$DB_User = 'WEBAuth'; //'root';
$DB_Pass = 'WEBAuthPW';
$DB_Name = 'bursary_database';

try {
    $DBconnection = new PDO("mysql:host=$DB_Host;dbname=$DB_Name", $DB_User, $DB_Pass);
    // set the PDO error mode to exception
    $DBconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    /*$SQL_stmt = "INSERT INTO bursaryRequestItems (brItemCategory,brItemDesc,brItemURL,brItemPrice,brItemPostage,brItemAdditionalCharges)
    VALUES ('$txbItemCategory', '$txbItemDescription' ,'$itemURL', '$txbPrice', '$txbPostage', '$txbAdditionalCharges')";
  
    $SQL_stmt = "INSERT INTO bursaryRequests(bRequestsCourseID,bRequestsStaffID, bRequestsJustification, bRequestsRequestDate, bRequestsStatus,bRequestsStudentRequest)
    VALUES ('$courseid', '$courseTutorId', '$txbJustication', '$dateNow', '$bRequestsStatus', TRUE)";
    
    $SQL_stmt = get itemid, requestid and userid(student);
  
    /*$SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
    VALUES('$itemid', '$requestid', '$userid')"; 
  
    // use exec() because no results are returned
    $DBconnection->exec($SQL_stmt);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $SQL_stmt . "<br>" . $e->getMessage();
    }

$conn = null;
*/
}  

?>

   


