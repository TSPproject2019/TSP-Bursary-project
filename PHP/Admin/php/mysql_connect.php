<?php

    DEFINE ('DB_USER', 'WEBAuth');
    DEFINE ('DB_PASSWORD', 'WEBAuthPW');
    DEFINE ('DB_HOST', 'localhost');
    DEFINE ('DB_NAME', 'bursary_database');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

    // drop down requirements on initial load (will run queries)
    // # - select
     
?>     