<?php
  // file: admin_staff_history.php
  session_start();
  if (!isset($_SESSION['firstName'])){
      echo "<p> No user details found</p>";
      header("Location: ../index.html? activity=Credentials_Missing_error");
  }
  // ensure that the user is authorised, correct user type 
  if ($_SESSION['userType'] == 'Admin'){
    $_SESSION['htmlTitle'] =  "History Staff Requests";
    try
    {
      //require_once 'connect.php';//connects to the SQL database.
      require_once 'Shared/php/AllHeader.php';//connects to the header section for all pages
      require_once 'Admin/php/AdminMenu.php';// Drop Down Menu for all student pages
      require_once 'Shared/php/PageName.php';//For page name
      require_once 'Admin/php/AdminHistoryStaff.php';//connects to the main Home scripit and page section for Admin
      require_once 'Admin/php/AdminFooter.php';//connects to the footer section for all pages for Admin
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
  }else{
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.html? activity=Credentials_Not_User_Type_error");
  }
?>