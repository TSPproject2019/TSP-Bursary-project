<?php
    session_start();
    require_once 'connect.php';//connects to the SQL database.

    // drop down requirements on initial load (will run queries)
    // # - select
?>     
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
    <div class="row ml-2 mb-5">
        <select class="custom-select col-2">
          <option selected>Name of Group Selected</option>
          <option value="1">BTEC IT</option>
          <option value="2">BSc Computer Science</option>
      </select>
       
  <!-- Choose Year -->       
    <select class="custom-select col-2 ml-2">
          <option selected>Year</option>
          <option value="1">16/17</option>
          <option value="2">17/18</option>
          <option value="3">18/19</option>
      </select>    
 <!-- Choose staff name --> 
    <select class="custom-select col-2 ml-2">
          <option selected>Name of Staff Selected</option>
          <option value="1">Ben Stimson</option>
          <option value="2">David Williams</option>
          <option value="3">Danny McCoombs</option>
    </select>
 <!-- Sort By -->       
    <select class="custom-select col-2 ml-2">
          <option selected>Sort By</option>
          <option value="1">Accepted</option>
          <option value="2">Rejected</option>
          <option value="3">Ordered</option>
          <option value="3">Delivered</option>
    </select>
    </div>
    
<hr>
     <!-- ACCEPTED PAGE -->
     <div class="row">
        <select class="custom-select col-2 ml-2">
          <option value="1" selected>BTEC IT</option>
          <option value="2">BSc Computer Science</option>
      </select>
       
  <!-- Choose Year -->       
    <select class="custom-select col-2 ml-2">
          <option value="1" selected>16/17</option>
          <option value="2">17/18</option>
          <option value="3">18/19</option>
      </select>

    <!-- StudentID -->
     <select class="custom-select col-2 ml-2">
          <option value="1" selected>290250</option>
          <option value="2">2458792</option>
          <option value="3">9875157</option>
      </select>
 <!-- Choose staff name --> 
    <select class="custom-select col-2 ml-2">
          <option value="1">Ben Stimson</option>
          <option value="2" selected>David Williams</option>
          <option value="3">Danny McCoombs</option>
    </select>
 <!-- Sort By -->       
    <select class="custom-select col-2 ml-2">
          <option value="1" selected>Accepted</option>
          <option value="2">Rejected</option>
          <option value="3">Ordered</option>
          <option value="3">Delivered</option>
    </select>
   
    </div>
    
    <!-- Table -->
    <table class="table table-hover table-striped table-bordered mt-5 w-75">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">StaffID</th>
                <th scope="col">BursaryID</th>
                <th scope="col">Submission date</th>
                <th scope="col">StudentID</th>
                <th scope="col">Item ID</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>64364</td>
                <td>23</td>
                <td>£300</td>
                <td><button class="btn btn-warning">Ordered</button></td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>52525</td>
                <td>10</td>
                <td>£100</td>
                <td><button class="btn btn-warning">Ordered</button></td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>42642</td>
                <td>5</td>
                <td>£50</td>
                <td><button class="btn btn-warning">Ordered</button></td>
            </tr>
        </tbody>
    </table>
    
<hr>
<!-- REJECTED Page -->
<div class="row">
        <select class="custom-select col-2 ml-2">
          <option value="1" selected>BTEC IT</option>
          <option value="2">BSc Computer Science</option>
      </select>
       
  <!-- Choose Year -->       
    <select class="custom-select col-2 ml-2">
          <option value="1" selected>16/17</option>
          <option value="2">17/18</option>
          <option value="3">18/19</option>
      </select>

    <!-- StudentID -->
     <select class="custom-select col-2 ml-2">
          <option value="1" selected>290250</option>
          <option value="2">2458792</option>
          <option value="3">9875157</option>
      </select>
 <!-- Choose staff name --> 
    <select class="custom-select col-2 ml-2">
          <option value="1">Ben Stimson</option>
          <option value="2" selected>David Williams</option>
          <option value="3">Danny McCoombs</option>
    </select>
 <!-- Sort By -->       
    <select class="custom-select col-2 ml-2">
          <option value="1">Accepted</option>
          <option value="2" selected>Rejected</option>
          <option value="3">Ordered</option>
          <option value="3">Delivered</option>
    </select>
   
    </div>
    
    <!-- Table -->
    <table class="table table-hover table-striped table-bordered mt-5 w-75">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">StaffID</th>
                <th scope="col">BursaryID</th>
                <th scope="col">Submission date</th>
                <th scope="col">StudentID</th>
                <th scope="col">Item ID</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>64364</td>
                <td>23</td>
                <td>£300</td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>52525</td>
                <td>10</td>
                <td>£100</td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>42642</td>
                <td>5</td>
                <td>£50</td>
            </tr>
        </tbody>
    </table>
<hr>
    <!-- ORDERED PAGE -->
 <div class="row">
        <select class="custom-select col-2 ml-2">
          <option value="1" selected>BTEC IT</option>
          <option value="2">BSc Computer Science</option>
      </select>
       
  <!-- Choose Year -->       
    <select class="custom-select col-2 ml-2">
          <option value="1" selected>16/17</option>
          <option value="2">17/18</option>
          <option value="3">18/19</option>
      </select>

    <!-- StudentID -->
     <select class="custom-select col-2 ml-2">
          <option value="1" selected>290250</option>
          <option value="2">2458792</option>
          <option value="3">9875157</option>
      </select>
 <!-- Choose staff name --> 
    <select class="custom-select col-2 ml-2">
          <option value="1">Ben Stimson</option>
          <option value="2" selected>David Williams</option>
          <option value="3">Danny McCoombs</option>
    </select>
 <!-- Sort By -->       
    <select class="custom-select col-2 ml-2">
          <option value="1">Accepted</option>
          <option value="2">Rejected</option>
          <option value="3" selected>Ordered</option>
          <option value="3">Delivered</option>
    </select>
   
    </div>
    
    <!-- Table -->
    <table class="table table-hover table-striped table-bordered mt-5 w-75">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">StaffID</th>
                <th scope="col">BursaryID</th>
                <th scope="col">Submission date</th>
                <th scope="col">StudentID</th>
                <th scope="col">Item ID</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>64364</td>
                <td>23</td>
                <td>£300</td>
                <td><button class="btn btn-success">Delivered</button></td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>52525</td>
                <td>10</td>
                <td>£100</td>
                <td><button class="btn btn-success">Delivered</button></td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>42642</td>
                <td>5</td>
                <td>£50</td>
                <td><button class="btn btn-success">Delivered</button></td>
            </tr>
        </tbody>
    </table>   
    
<hr>
    <!-- Delivered PAGE-->
    <div class="row">
        <select class="custom-select col-2 ml-2">
          <option value="1" selected>BTEC IT</option>
          <option value="2">BSc Computer Science</option>
      </select>
       
  <!-- Choose Year -->       
    <select class="custom-select col-2 ml-2">
          <option value="1" selected>16/17</option>
          <option value="2">17/18</option>
          <option value="3">18/19</option>
      </select>

    <!-- StudentID -->
     <select class="custom-select col-2 ml-2">
          <option value="1" selected>290250</option>
          <option value="2">2458792</option>
          <option value="3">9875157</option>
      </select>
 <!-- Choose staff name --> 
    <select class="custom-select col-2 ml-2">
          <option value="1">Ben Stimson</option>
          <option value="2" selected>David Williams</option>
          <option value="3">Danny McCoombs</option>
    </select>
 <!-- Sort By -->       
    <select class="custom-select col-2 ml-2">
          <option value="1">Accepted</option>
          <option value="2">Rejected</option>
          <option value="3">Ordered</option>
          <option value="3" selected>Delivered</option>
    </select>
   
    </div>
    
    <!-- Table -->
    <table class="table table-hover table-striped table-bordered mt-5 w-75">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">StaffID</th>
                <th scope="col">BursaryID</th>
                <th scope="col">Submission date</th>
                <th scope="col">StudentID</th>
                <th scope="col">Item ID</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>64364</td>
                <td>23</td>
                <td>£300</td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>52525</td>
                <td>10</td>
                <td>£100</td>
            </tr>
            <tr>
                <td>351515</td>
                <td>521521</td>
                <td>10/10/10</td>
                <td>42642</td>
                <td>5</td>
                <td>£50</td>
            </tr>
        </tbody>
    </table>
    
</section>
 