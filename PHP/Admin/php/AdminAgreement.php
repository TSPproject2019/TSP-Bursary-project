<?php
    session_start();
    require_once 'connect.php';//connects to the SQL database.

    // drop down requirements on initial load (will run queries)
    // # - selectthat 
?>
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
        