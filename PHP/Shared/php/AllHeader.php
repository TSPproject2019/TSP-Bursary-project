<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Home Page </title>

 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="../../../CSS/styles.css">

    <!-- Bootstrap 4.1 CND -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awsome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
   <!--Include page name in header -->
  
    
</head>

<body>
    
 <header class="jumbotron">
    <div class="row text-center">
          <?php
                //$firstName = $_SESSION['firstName'];
                //$lastName = $_SESSION['lastName'];
            if (isset($_SESSION['lastName'])){
                //echo '<div id="loggedIn">';
                //echo '<p style="margin-left: 30px;">Welcome '
                echo '<div class="col-lg-6">';
                  echo "<h2 class=\"header2\">Welcome " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</h2>";
                  echo "<p>To the Bursary Request System</p>";
                echo '</div>';
              }
          ?>
        
        <div class="col-lg-6">
            <img src="Shared/images/logo.png" class="img-fluid" width="100px", height="50px" alt="Responsive image"></img>
            <a href="" class="btn btn-outline-success btn-sm">Log out</a>
        </div>
    </div>
 </header>