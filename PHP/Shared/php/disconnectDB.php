<?php
    // file name: disconnectDB.php
    // author: Mike Wright
    // date created: 27/01/2019
    session_start();
    session_unset();
    session_destroy();
?>