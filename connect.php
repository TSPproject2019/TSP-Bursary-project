<?php
    // PHP script to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.
    // P.S user 'username' and password 'password' was create so all og development team could access database

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
    $query = "SELECT * FROM users";
    $result = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "The ID is: " . $row['userID'] . " and the Username is: " . $row['userFirstName'];
    }