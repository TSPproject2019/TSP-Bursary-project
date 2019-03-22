<?php
    session_start();
    require_once 'connect.php';//connects to the SQL database.

    require_once 'functions.php';

    $submitted = getAdminSubmitted();
    $approved = getAdminApproved();
    $waitDelivery = getAdminAwaitingDelivery();
?>  

   <div class="col-3">
       <?php
        echo '<ul class="list-group">
              <li class="list-group-item  border-0">Submitted: <span>'.$submitted.'</span></li>
              <li class="list-group-item  border-0">Approved: <span>'.$approved.'</span></li>
              <li class="list-group-item  border-0">Awaiting delivery: <span>'.$waitDelivery.'</span></li>
                        
        </ul>';
            ?>
    </div>
</div>
          
 <section class="container">         
            <h1 class="text-center" >Admin Home</h1>
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

         
    