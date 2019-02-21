<?php
    // PHP script to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.
    // P.S user 'username' and password 'password' was create so all of development team could access database


    /*Set the MySQL host, username, password, and database name,
    (PORT number 3306 is always same for 9cloud to access MySQL service):*/
    $servername = getenv('IP');
    $username = 'username';
    $password = "password";
    $database = "bursary_database";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    echo "Connected successfully (".$db->host_info.")";
    
   //perform a simple query to make sure it's working
    $query = "SELECT CONCAT(userFirstName, ', ', userLastName) AS name, userID as id FROM users";
    //run the query
    $result = mysqli_query($db, $query);

   /* while ($row = mysqli_fetch_assoc($result)) {
        echo "The ID is: " . $row['userID'] . " and the Username is: " . $row['userFirstName'];
    }*/
    
    if($result) { //if query ran OK, display records
    
        //Table header (code it to this century HTML and CSS standards later..)
        echo '<table align="center" cellspacing="3" cellpadding="3" width="25%">
                    <tr>
                        <td align="left"><strong>Name</strong></td>
                        <td align="left"><strong>ID</strong></td>
                    </tr>';
        
        //fetch and print all records from user table
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['id'] . '</td></tr>';
        }
        
        //close table
        echo '</table>';
        
        mysqli_free_result($result); // free up resources
        
    } else { //if query did not run OK
        echo '<p>FAILURE</p>';
        
        //debugging message
        echo '<p>' . mysqli_error($db) . '<br /><br />Query: ' . $query . '</p>';
    }
    
    mysqli_close($db); // close database connection