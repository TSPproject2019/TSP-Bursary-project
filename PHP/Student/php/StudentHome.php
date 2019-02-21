<?php
    session_start();

   # echo " start Step 0.0..<br>"; // for testing purposes
    require_once 'connect.php';//connects to the SQL database.
   # echo " start Step 1.0..<br>"; // for testing purposes
    // functions
    
    function getTotals ($uID, $stat){
        global $totalResult;
        require 'connect.php';//connects to the SQL database.
       # echo " start Step 4.0..<br>"; // for testing purposes
        $SQL_stmt = "SELECT COUNT(*) AS 'Total' FROM bursaryRequests
          INNER JOIN itemsAndRequests WHERE itemsAndRequests.RequestID = bursaryRequests.bRequestsID 
          AND itemsAndRequests.StudentID = " . $uID . " AND bursaryRequests.bRequestsStaffApproved is NULL 
          AND bursaryRequests.bRequestsAdminApproved is NULL 
          AND bRequestsStatus = '" . $stat . "'";
        $totalResult = 0;
        // now to run the query
        # echo " start Step 4.1..<br>"; // for testing purposes
        // first prepare and excecurte
        $result = $DBconnection->query($SQL_stmt);
        # echo " start Step 4.2..<br>"; // for testing purposes
        // now get the data
        if ($row = $result->fetch()){
            // varify that it is a valid userID
            # echo " start Step 4.2.1..<br>"; // for testing purposes
            // Bind results by column name
            $totalResult = $row['Total'];
            #return $submitTotal;
        }
        return $totalResult;
    }
    // end functions
    
    // Get the _SESSION user details.
    if (isset($_SESSION['lastName'])){
       # echo " start Step 2.0..<br>"; // for testing purposes
        $firstName = $_SESSION['firstName'];
        $lastName = $_SESSION['lastName'];
        $userid = $_SESSION['userid'];
        $userName = $firstName . " " . $lastName;
        // get course title
        $SQL_stmt = "SELECT DISTINCT courseTitle FROM course 
        INNER JOIN studentToCourse ON course.courseID = studentToCourse.stcCourseID
        INNER JOIN users ON users.userID = " . $userid . " and studentToCourse.stcStudentID = '" . $userid . "'";
        // now to run the query

        //
       # echo " start Step 2.0..<br>"; // for testing purposes
        // first prepare and excecurte
        $result = $DBconnection->query($SQL_stmt);
       # echo " start Step 2.1..<br>"; // for testing purposes
        // now get the data
        if ($row = $result->fetch()){
            // varify that it is a valid userID
           # echo " start Step 2.1.1..<br>"; // for testing purposes
            // Bind results by column name
            $courseTitle = $row['courseTitle'];
            // store session variables
            $_SESSION['courseTitle'] =  $courseTitle;
            // this varisable is also used for posting.

        }
        // get the data for the submitted requests
        $submitTotal = getTotals ($userid, "Submitted");
        $approved = getTotals ($userid, "Approved");
        $pending = getTotals ($userid, "Pending");
    }
?>
        <!-- <div class="row col-lg-6 justify-content-start align-items-center"> -->
            <div>
                  <li class="list-group-item  border-1">Student Home Page</li>
            </div>
            <div class="col-3">
                    <ul class="list-group">
                      <?php
                         echo '<li class="list-group-item  border-0">Submitted: <span>' . $submitTotal . '</span></li>';
                         echo '<li class="list-group-item  border-0">Approved: <span>' . $approved . '</span></li>';
                         echo '<li class="list-group-item  border-0">Awaiting delivery: <span>' . $pending . '</span></li>';
                      ?>
                    </ul>
                </div>
          </div>
          
 <section class="container">         
            <h1 class="text-center">Student Home</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi et voluptate nam, aliquid amet maiores fuga,
                    facilis ipsam soluta,
                    reprehenderit, explicabo repellat. Maiores libero mollitia esse illo. Nam, officia, quisquam!
                </p>
   </section>   