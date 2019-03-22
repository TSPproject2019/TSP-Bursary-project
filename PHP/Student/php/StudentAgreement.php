<body id="demo">
<?php
    session_start();
   # echo " start Step 0.0..<br>"; // for testing purposes
    require_once 'connect.php';//connects to the SQL database.
   # echo " start Step 1.0..<br>"; // for testing purposes
    require 'functions.php'; // connects to the functions.
    
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
        $submitTotal = getTotals ($userid, "Submitted");
        $approved = getTotals ($userid, "Approved");
        $pending = getStudentAwaitingDelivery($userid);
        $deliveredTotal = getDelivered($userid);
        $availableBalance = getStudentAvailableBalance($userid);
    }
?>
<div class="col-md-4 ml-3">   
      <h6>Outstanding balance: <span><?php echo $availableBalance ?></span></h6>                   
        <ul class="removeBullets">            
             <li>Submitted: <span><?php echo $submitTotal ?></span></li>
             <li>Approved: <span><?php echo $approved ?></span></li>
             <li>Awaiting delivery: <span><?php echo $pending ?></span></li>
             <li>Delivered: <span><?php $deliveredTotal ?></span></li>                      
        </ul>
    </div>
</div>
          <section class="content">
              <div class="row justify-content-center">
                  <article class="border col-lg-6 mt-2">
                      
                      Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                      sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                      magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                      quis nostrud exerci tation ullamcorper suscipit lobortis nisl
                      ut aliquip ex ea commodo consequat. Duis autem vel eum iriure
                      dolor in hendrerit in vulputate velit esse molestie consequat,
                      vel illum dolore eu feugiat nulla facilisis at vero eros et
                      accumsan et iusto odio dignissim qui blandit praesent luptatum
                      zzril delenit augue duis dolore te feugait nulla facilisi.
                      Nam liber tempor cum soluta nobis eleifend option congue
                      nihil imperdiet doming id quod mazim placerat facer possim
                      assum. Typi non habent claritatem insitam; est usus legentis
                      in iis qui facit eorum claritatem. Investigationes
                      demonstraverunt lectores legere me lius quod ii legunt saepius.
                      Claritas est etiam processus dynamicus, qui sequitur mutationem
                      consuetudium lectorum. Mirum est notare quam littera gothica,
                      quam nunc putamus parum claram, anteposuerit litterarum formas
                      humanitatis per seacula quarta decima et quinta decima. Eodem
                      modo typi, qui nunc nobis videntur parum clari, fiant sollemnes
                      in futurum.
                      
                  </article>
              </div>
          </section>
</body>                                       
          