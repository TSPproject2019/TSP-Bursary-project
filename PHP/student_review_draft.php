<?php
    // file: student_review_draft.php
    session_start();
    if (!isset($_SESSION['firstName'])){
        echo "<p> No user details found</p>";
        header("Location: ../index.html? activity=Credentials_Missing_error");
    }
    // ensure that the user is authorised, correct user type 
    if ($_SESSION['userType'] == 'Student'){
        $_SESSION['htmlTitle'] =  "Review my drafts";
        try
        {
            //require_once 'connect.php';//connects to the SQL database.
            require_once 'Shared/php/AllHeader.php';//connects to the header section for all pages
            require_once 'Student/php/StudentMenu.php';// Drop Down Menu for all student pages
            require_once 'Shared/php/PageName.php';//For page name
            #require_once 'Student/php/StudentReviewDraft.php';//connects to the main Home scripit and page section for Admin
            require_once 'Student/php/StudentReviewDraft_A.php';//connects to the main Home scripit and page section for Admin
          # require_once 'Student/php/StudentReviewDraft_B.php';//connects to the main Home scripit and page section for Admin
            require_once 'Student/php/StudentFooter.php';//connects to the footer section for all pages for Admin
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