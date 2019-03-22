<?php
  // ensure session ID's are retrievable
  session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php
  // get the headed page htmlPagename from session variables
  echo "<title>" . $_SESSION['htmlTitle'] . "</title>";
?>
<!-- <title>Admin Home Page </title> -->

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
    <script src="../../../Scripts/nightMode.js"></script>   
    <script src="../../../Scripts/fontSize.js"></script>
   
   <!--Include page name in header -->

    
</head>

<body>
    
<header class="jumbotron bg-secondary">
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
                  //echo'<h1>' . $_SESSION['htmlTitle'] .'</h1>'; //Display page name in header
                echo '</div>';
              }
            
          ?>
        <div class="col-lg-6">
            <img src="Shared/images/logo.png" class="img-fluid" width="100px" height="50px" alt="Responsive image">
            <!-- <img src="../images/logo.png" ></img> -->
            <a href="logout.php" class="btn btn-success">Log out</a>
            
            
        </div>
        
    </div>
    <div class="text-right">
        <div class="btn-group dropleft">
             <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Accessibility
             </button>
             <div class="dropdown-menu">
               <a class="dropdown-item" id="button1" value="larger" type="button" onclick="changeFontSize(this)" href="#">Increase font size</a> 
               <a class="dropdown-item" id="button2" vale="smaller" type="button" onclick="changeFontSize(this)"  href="#">Decrease font size</a>
                 <a class="modeSelect" onclick="nightfall()">Nightfall Mode</a>
                 <a class="modeSelect" onclick="summerJam()">Summer Jam</a>
                 <a class="modeSelect" onclick="winterChill()">Winter Chill</a>
                 <a class="modeSelect" onclick="autumnBreez()">Autumn Breez</a>
                                  
             </div>            
        </div>
</div>   
</header>
