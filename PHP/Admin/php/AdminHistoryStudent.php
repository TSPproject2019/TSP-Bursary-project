<?php
    session_start();
?>
<div class="row">
    <div class="dropdown col-3 ml-4">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-list-ul"></i></a>
                
            <div class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="admin_student_submissions.php">Review Student Submissions</a>
                <a class="dropdown-item" href="admin_staff_submissions.php">Review Staff Submissions</a>
                <a class="dropdown-item" href="admin_student_history.php">History Student Requests</a>
                <a class="dropdown-item" href="admin_staff_history.php">History Staff Requests</a>
                <a class="dropdown-item" href="FAQ.html">FAQ</a>
                <a class="dropdown-item" href="Agreement Form.html">Agreement Form</a>
                <a class="dropdown-item" href="admin_home.php">Admin Home Page</a>
            </div>
    </div>
    <div>
        <li class="list-group-item  border-1">Admin Studengt History Page</li>
    </div>
    <div class="col-3">
        <ul class="list-group">
                    <li class="list-group-item  border-0">Submitted: <span>10</span></li>
                    <li class="list-group-item  border-0">Approved: <span>8</span></li>
            <li class="list-group-item  border-0">Awaiting delivery: <span>YES</span></li>
        </ul>
    </div>
</div>

<section class="container-fluid">
    
 <!-- Choose course -->
    <div class="row">
        <select class="custom-select col-2 ml-2">
          <option selected>Name of Group Selected</option>
          <option value="1">BTECT IT</option>
          <option value="2">BSc Computer Science</option>
      </select>
       
  <!-- Choose Year -->       
    <select class="custom-select col-2 ml-2">
          <option selected>Year Selected</option>
          <option value="1">Level 4 19/20</option>
          <option value="2">Level 4 18/19</option>
          <option value="3">Level 5 19/20</option>
          <option value="3">Level 5 20/21</option>
      </select>    
 <!-- Choose staff name --> 
    <select class="custom-select col-2 ml-2">
          <option selected>Name of student Selected</option>
          <option value="1">Ben Stimson</option>
          <option value="2">David Williams</option>
          <option value="3">Danny McCombs</option>
    </select>
 <!-- Sort By -->       
    <select class="custom-select col-2 ml-2">
          <option selected>Sort By</option>
          <option value="1">Accepted</option>
          <option value="2">Rejected</option>
          <option value="3">Ordered</option>
          <option value="3">Delivered</option>
          <option value="3">All</option>
    </select>

    
    <!-- Table -->
    <table class="table table-hover table-striped table-bordered mt-5 w-75">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">BursaryID</th>
                <th scope="col">Submission date</th>
                <th scope="col">Item ID</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>23</td>
                <td>£300</td>
                <td><button class="btn btn-warning">Ordered</button></td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>10</td>
                <td>£100</td>
                <td><button class="btn btn-warning">Ordered</button></td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>5</td>
                <td>£50</td>
                <td><button class="btn btn-warning">Ordered</button></td>
            </tr>
        </tbody>
    </table>
    
    <!-- Rejected table -->
    
    <table class="table table-hover table-striped table-bordered mt-5 w-75">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">Student Number</th>
                <th scope="col">Web Form</th>
                <th scope="col">Submitted Date</th>
                <th scope="col">Staff Approval Date</th>
                <th scope="col">Item Count</th>
                <th scope="col">Total (Price)</th>
                <th scope="col">Status</th>
                <th scope="col">Admin Rejected Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td><a href="#">Link</a></td>
                <td>10/10/2018</td>
                <td>15/10/2018</td>
                <td>2</td>
                <td>£100.00</td>
                <td>Rejected</td>
                <td>20/10/2018</td>
            </tr>
            
            <tr>
                <td>351515</td>
                <td><a href="#">Link</a></td>
                <td>11/10/2018</td>
                <td>15/10/2018</td>
                <td>1</td>
                <td>£340.00</td>
                <td>Rejected</td>
                <td>20/10/2018</td>
            </tr>
            
            <tr>
                <td>351515</td>
                <td><a href="#">Link</a></td>
                <td>11/10/2018</td>
                <td>15/10/2018</td>
                <td>4</td>
                <td>£25.60</td>
                <td>Rejected</td>
                <td>20/10/2018</td>
            </tr>
        </tbody>
    </table>
    
    <!-- Ordered Table -->
    
    <table class="table table-hover table-striped table-bordered mt-5 w-75">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">BursaryID</th>
                <th scope="col">Submission date</th>
                <th scope="col">Item ID</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>23</td>
                <td>£300</td>
                <td><button class="btn btn-success">Delivered</button></td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>10</td>
                <td>£100</td>
                <td><button class="btn btn-success">Delivered</button></td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>5</td>
                <td>£50</td>
                <td><button class="btn btn-success">Delivered</button></td>
            </tr>
        </tbody>
    </table>
    
    <!-- Delivered Table -->
    
    <table class="table table-hover table-striped table-bordered mt-5 w-75">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">BursaryID</th>
                <th scope="col">Submission date</th>
                <th scope="col">Item ID</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>23</td>
                <td>£300</td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>10</td>
                <td>£100</td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>5</td>
                <td>£50</td>
            </tr>
        </tbody>
    </table>
</section>
  