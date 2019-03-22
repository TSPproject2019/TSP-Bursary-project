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
<section class="container-fluid mt-5"> <!--Container START -->
    <section class="row"><!--Row Start -->
     <div class="col-6">
            <div class="col-12 mt-2 mb-5">
                                <select class="custom-select" id="categoryField">
                                    <option selected>Qualification</option>
                                    <option value="1">Equipment</option>
                                    <option value="2">Events</option>
                                    <option value="3">Professional acccreditation</option>
                                    <option value="4">Vocational placement</option>
                                </select>
                            </div>
         <form>
             <div class="form-group">
                 <div>
                     <input type="text" class="form-control" placeholder="Item description:">
                  </div>
              </div>
            
              <div class="form-group">
                 <div>
                     <input type="text" class="form-control" placeholder="URL to the item:">
                 </div>
               </div>
            
                <div class="form-group row justify-content-between">
                    <div class="input-group col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="price">Price:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="price">
                    </div>
                    
                    <div class="input-group col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="price">Postage:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="postage">
                    </div>
                    
                    <div class="input-group col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="additionalFees">Additional fees:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="additionalFees">
                    </div>
                    <input class="col-1" type="checkbox" value="">
                </div>
                
                <h6>ITEM 2</h6>
                 <div class="form-group">
                 <div>
                     <input type="text" class="form-control" placeholder="Item description:">
                  </div>
              </div>
            
              <div class="form-group">
                 <div>
                     <input type="text" class="form-control" placeholder="URL to the item:">
                 </div>
                </div>
            <!--Put Price, Postage and Additional fees label above inut field -->>
                <div class="form-group row justify-content-between">
                    <div class="input-group col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="price">Price:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="price">
                    </div>
                    
                    <div class="input-group col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="price">Postage:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="postage">
                    </div>
                    
                    <div class="input-group col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="additionalFees">Additional fees:</span>
                        </div>
                        <input type="text" class="form-control"   aria-describedby="additionalFees">
                    </div>
                    <input class="col-1" type="checkbox" value="">
                </div>
                
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="justification" rows="3" placeholder="Justification:"></textarea>
                </div>
                <div class="form-group">
                    <h6>Status of the form: <span>Status</span></h6>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="tutorComments" rows="3" placeholder="Tutor Comments:"></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="adminComments" rows="5" placeholder="Comments (by admin)-if any"></textarea>
                </div>
                
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
        
        </div>
        <section class="col-6"> <!-- Table left side START -->
            <div class="row justify-content-center">
                <select class="custom-select col-3 mr-2">
                    <option selected>Select group</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
           
            
                <select class="custom-select col-3">
                    <option selected>Select Year</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            
                <input class="col-1 m-0" type="checkbox" id="checkbox3" value="">
                <label class="form-check-label" for="checkbox3">Select All Students</label>
            </div>
                <table class="table table-hover table-striped table-bordered mt-5">
                    <thead>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Submission Date</th>
                        <th>Status</th>
                    </thead>
                    <tr>
                        <td>317717</td>
                        <td>Andrius Markusenka</td>
                        <td>06/01/19</td>
                        <td>Pending</td>
                    </tr>
                
                    <tr>
                        <td>123456</td>
                        <td>Liviu Pussy Destroyer 300</td>
                        <td>06/01/2018</td>
                        <td>Confirmed</td>
                    </tr>
                
                    <tr>
                        <td>213456</td>
                        <td>Nikita The Spy</td>
                        <td>03/12/2018</td>
                        <td>Pending</td>
                    </tr>
            </table>
       
    </section><!-- Table left side END -->               
  </section><!--Row END -->
</section><!--Container END -->
