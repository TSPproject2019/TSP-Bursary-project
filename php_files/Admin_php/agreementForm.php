<?php
    $page_title = "Agreement Form";
    include('../../partials/header.html');
?>
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
                <input type="submit" name="submit" class="btn btn-success mt-2" id="send" value="Submit" disabled />
                  </div>
        </form>
        
    </section>

<?php
    include ('../../partials/footer.html');
?>