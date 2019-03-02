<!--Created by Andrius 20-02-2019 -->
<!-- New student bursury request form submission processing -->

<!--Version 2.0 -->
<!-- Student can add and submit ONE item -->

<?php
session_start();
require_once '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  if(isset($_POST['submit'])) {
    $courseTutorId = $_POST['courseTutorId'];
    $courseId = $_POST['courseid']; 
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
  }
   

 //Submit data to bursaryRequestItems table
    $SQL_stmt = "INSERT INTO bursaryRequests(bRequestsCourseID,bRequestsStaffID, bRequestsJustification, bRequestsRequestDate, bRequestsStatus,bRequestsStudentRequest)
    VALUES ('$courseid', '$courseTutorId', '$txbJustication', '$dateNow', '$bRequestsStatus', TRUE)";
  
    $DBconnection->exec($SQL_stmt);
//Then, submit data to bursaryRequests table
    
    $SQL_stmt = "INSERT INTO bursaryRequestItems (brItemCategory,brItemDesc,brItemURL,brItemPrice,brItemPostage,brItemAdditionalCharges)
    VALUES ('$txbItemCategory', '$txbItemDescription' ,'$itemURL', '$txbPrice', '$txbPostage', '$txbAdditionalCharges')";

    $DBconnection->exec($SQL_stmt);
    
    //Select request id
    $SQL_stmt = "SELECT bursaryRequests.bRequestsID AS 'requestId' FROM bursaryRequests
    WHERE bRequestsCourseID = '$courseid' AND bRequestsStaffID = '$courseTutorId'
    AND bRequestsJustification = '$txbJustication' AND bRequestsRequestDate = '$dateNow'
    AND bRequestsStatus = '$bRequestsStatus'";
       
   
    $result = $DBconnection->query($SQL_stmt);
        // now get the data
        if ($row = $result->fetch()){
            // Bind results by column name
            $requestid = $row['requestId'];
        }
    echo "<p>This is the request ID:$requestid</p>";

    //Now retrieve item id
    $SQL_stmt = "SELECT brItemID AS 'itemId' FROM bursaryRequestItems
    WHERE brItemCategory = '$txbItemCategory' AND brItemDesc = '$txbItemDescription'
    AND brItemURL = '$itemURL' AND brItemPrice = '$txbPrice'
    AND brItemPostage = '$txbPostage' AND brItemAdditionalCharges = '$txbAdditionalCharges'";
        
    
    $result = $DBconnection->query($SQL_stmt);
        // now get the data
        if ($row = $result->fetch()){
            // Bind results by column name
            $itemid = $row['itemId'];
        }
    echo "<p>This is the itemId:$itemid</p>";
   /*Finally, submit data to itemsAndRequests */
   
    
    //Link item to request and to student.
    $SQL_stmt = "INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
    VALUES('$itemid', '$requestid', '$userid')";
    
    $DBconnection->exec($SQL_stmt); //Everything is put. Check in my submitted forms page if request is there.
   
?>

   


