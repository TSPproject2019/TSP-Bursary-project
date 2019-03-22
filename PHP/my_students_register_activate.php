<?php
    // start the session
    session_start();
    // connect to the database
    //echo " start Step 0.0..<br>"; // for testing purposes
    require_once 'connect.php';//connects to the SQL database.
    //include (Student/php/StudentReviewDraft_A.php);
    #require_once '../../Shared/php/AllHeader.php'; 
    //connect to the functions
    require_once 'functions.php'; // connects to the functions.
    # echo " start Step 1.0..<br>"; // for testing purposes

    #require 'functions.php'; // connects to the functions. // seems to fails to load page if this is loaded.
    // get session variables.
    $_SESSION['htmlTitle'] =  "Validate user";
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $userid = $_SESSION['userid'];
    $userName = $firstName . " " . $lastName;
    $courseTitle = $_SESSION['courseTitle'];
    //$courseTutorFirstName = $_SESSION['courseTutorFirstName'];
    //$courseTutorLastName = $_SESSION['courseTutorLastName'];
   // $courseTutorId = $_SESSION['courseTutorId'];
    $student_id = 0; //for student id capturing
    $courseid = 0;
    // get the data for the submitted requests
    //$submitTotal = getTotals ($userid, "Submitted");
    //$approved = getTotals ($userid, "Approved");
    //$pending = getTotals ($userid, "Pending");
    //$availableBalance = getStudentAvailableBalance($userid);
    //require_once 'Shared/php/AllHeader.php';//connects to the header section for all pages
    //require_once 'Staff/php/StaffMenu.php';// Drop Down Menu for all student pages

?>

<?php
    echo "<p> here. </p>";
    // check to see which button was pressed.
    //// set a counter for this purpose
    //$count = 1;
    //// set the name="submit" variable
    //IF statement does not work with 2 == only 1 =
    //if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
    if (isset($_POST['submit'])){

        echo "inside submit";
        $submitButtons = $_POST['submit'];

        // now let's split the result
        $item = split("_", $submitButtons);
        // form item name
        $itemName = $item[0];

        // form item value
        $itemValue = $item[1];

        $userid = $itemValue;
        $_SESSION['userid'] = $userid;
        // for editing drafts
        if ($itemName == 'send'){
            
            //Find user email first, name and pin code
            $SQL_stmt="SELECT CONCAT(users.userFirstName, ' ',users.userLastName) AS 'name', 
            users.userEmail AS 'email', users.userPIN AS 'pin' FROM users
            WHERE users.userID = '".$userid."'";
            
            $email = 0;
            $name = 0;
            $pin = 0;
            $result = $DBconnection->query($SQL_stmt);
            
            if ($row = $result->fetch()){
                
                $email = $row['email'];
                $name = $row['name'];
                $pin = $row['pin'];
            }
            //SEND EMAIL HERE CODE the current code is re-marked out and does not work.
            //When you go back to the page, the page table gets lost for some reason.
            //Log out and log in again as the staff member to see the table again.
            
             $to = $email;
             $subject = "Bursary request system registration PIN code.";

             $message = "Dear '".$name."',";
             $message .= "The PIN code for registration is: '".$pin."'.";
             $message .= "Enter this code on the registration page of the Bursary request system.";

             $from = "From:skripnikovnikita@gmail.com";
             $header = "From:skripnikovnikita@gmail.com \r\n";
             $header .= "To: '".$email."'\r\n";
             $header .= 'MIME-Version: 1.0' . "\r\n";
             $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             $header .= "Cc:skripnikovnikita@gmail.com \r\n";

             $retval = mail ($to,$subject,$message,$from);
             
             echo'<a href="mailto:'.$to.'S?ubject=Bursary Request PIN?Body=<b>'.$pin.'</b>" target=""></a>';

             if($retval == true ) {
                echo "<p>Message sent successfully...</p>";
             }else {
                echo "<p>Message could not be sent...</p>";
             }
            //goBack(); 
        }
    }
?>