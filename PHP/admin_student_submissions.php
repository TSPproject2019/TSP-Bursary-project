<?php
  // file: admin_student_submissions.php
  session_start();
  if (!isset($_SESSION['firstName'])){
    echo "<p> No user details found</p>";
  }
// for testing purposes only
  /*if (isset($_SESSION['firstName'])){
    $firstName = $_SESSION['firstName'];
        if (isset($_SESSION['lastName'])){
          $lastName = $_SESSION['lastName'];
          echo "<p>The session usernameA " . $firstName . " " . $lastName . "</p>";
          echo "<p>The session usernameB " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</p>";
        }
  }*/
  try
  {

    //require_once 'connect.php';//connects to the SQL database.
    require_once 'Shared/php/AllHeader.php';//connects to the header section for all pages
    require_once 'Admin/php/AdminMenu.php';// Drop Down Menu for all student pages
    require_once 'Admin/php/AdminSubmissionStudent.php';//connects to the main Home scripit and page section for Admin
    require_once 'Admin/php/AdminFooter.php';//connects to the footer section for all pages for Admin
  }
  catch(PDOException $e)
  {
      echo $sql . "<br>" . $e->getMessage();
  }
?>