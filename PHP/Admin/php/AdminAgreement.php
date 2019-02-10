<?php
    session_start();
?>
    <div class="row">
        <div class="dropdown col-3 ml-4">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-list-ul"></i></a>
                    <!-- <div class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuLink"> -->
                    <div class="dropdown-menu bg-primary" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="admin_student_submissions.php">Review Student Submissions</a>
                    <a class="dropdown-item" href="admin_staff_submissions.php">Review Staff Submissions</a>
                    <a class="dropdown-item" href="admin_student_history.php">History Student Requests</a>
                    <a class="dropdown-item" href="admin_staff_history.php">History Staff Requests</a>
                    <a class="dropdown-item" href="admin_faq.php">FAQ</a>
                    <a class="dropdown-item" href="admin_agreement.php">Agreement Form</a>
                    <a class="dropdown-item" href="admin_home.php">Admin Home Page</a>
                </div>
            </div>
            <div>
                <li class="list-group-item  border-1">Admin Agreement Page</li>
            </div>
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item  border-0">Submitted: <span>10</span></li>
                    <li class="list-group-item  border-0">Approved: <span>8</span></li>
                    <li class="list-group-item  border-0">Awaiting delivery: <span>YES</span></li>
                </ul>
            </div>
            
    <section class="container">
        <div class="row justify-content-center border">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Nemo reiciendis sit rerum aperiam velit, necessitatibus quae provident maxime veritatis cum dignissimos suscipit, vero quod explicabo.
                  Repellat doloremque quasi similique a.
            </p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Dicta beatae repudiandae quibusdam nihil, molestias temporibus enim deserunt, earum sequi!
                  Perferendis quo error voluptate sed nostrum hic numquam magnam distinctio odit.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Dicta beatae repudiandae quibusdam nihil, molestias temporibus enim deserunt, earum sequi!
                  Perferendis quo error voluptate sed nostrum hic numquam magnam distinctio odit.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Dicta beatae repudiandae quibusdam nihil, molestias temporibus enim deserunt, earum sequi!
                  Perferendis quo error voluptate sed nostrum hic numquam magnam distinctio odit.</p>
        </div>
        
        <form class="mt-3">
        
            <div class="form-ckeck">
                <input class="col-1 form-check-input" type="checkbox" name="accept" value="Submit" id="agreeCheckbox">
                <label class="col-11 form-check-label text-center" for="agreeCheckbox">
                    I CONSENT TO THIS...
                </label>
            </div>
       
            <div>
                <button id="send" class="btn btn-success mt-2" value="Submit" disabled>Submit</button>
            </div>
        </form>
    </section>
        