<?php
    session_start();
    // functions
    
    // get the totals from the bursaryRequests table using user ID and the request status.  
    function getTotals ($uID, $stat){
        global $totalResult;
        require 'connect.php';//connects to the SQL database.
       # echo " start Step 4.0..<br>"; // for testing purposes
        $SQL_stmt = "SELECT COUNT(*) AS 'Total' FROM bursaryRequests
          INNER JOIN itemsAndRequests WHERE itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
          AND itemsAndRequests.StudentID = " . $uID . " AND bursaryRequests.bRequestsStaffApproved is NULL 
          AND bursaryRequests.bRequestsAdminApproved is NULL 
          AND bRequestsStatus = '" . $stat . "'";
        $totalResult = 0;
        // now to run the query
        # echo " start Step 4.1..<br>"; // for testing purposes
        // first prepare and excecurte
        $result = $DBconnection->query($SQL_stmt);
        # echo " start Step 4.2..<br>"; // for testing purposes
        // now get the data
        if ($row = $result->fetch()){
            // varify that it is a valid userID
            # echo " start Step 4.2.1..<br>"; // for testing purposes
            // Bind results by column name
            $totalResult = $row['Total'];
            #return $submitTotal;
        }
        return $totalResult;
    }

    
    // just workibng through query, and then will re-merge it if needed..
    function getStaffTotals ($uID, $usrType, $stat){
        global $staffTotalResult;
        require 'connect.php';//connects to the SQL database.
        // what is the required query data ?
         if($usrType = 'Staff'){
            $SQL_stmt = "SELECT COUNT(*) AS 'Total' FROM bursaryRequests
            INNER JOIN itemsAndRequests ON itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
            AND bursaryRequests.bRequestsStaffID = " . $uID . " AND bursaryRequests.bRequestsStaffRequest = 'TRUE' 
            AND bursaryRequests.bRequestsStaffApprove = 'Yes'
            AND itemsAndRequests.StaffItemApproved = 'Yes'
            AND bRequestsStatus = '" . $stat . "'";
            $stafftotalResult = 0; // just incase this variable is holding any data, but should not be the case
            // now to run the query
            # echo " start Step 4.1..<br>"; // for testing purposes
            // first prepare and excecurte
            $result = $DBconnection->query($SQL_stmt);
            # echo " start Step 4.2..<br>"; // for testing purposes
            // now get the data
            if ($row = $result->fetch()){
                // varify that it is a valid userID
                # echo " start Step 4.2.1..<br>"; // for testing purposes
                // Bind results by column name
                $stafftotalResult = $row['Total'];
                #return $submitTotal;
            }
        }
        return $staffTotalResult;
    }
   
?>