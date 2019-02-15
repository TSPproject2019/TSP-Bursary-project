<?php
    session_start();
?>
        <!-- <div class="row col-lg-6 justify-content-start align-items-center"> -->
        <div>
                <li class="list-group-item  border-1">New Bursary Request</li>
        </div>
        <div class="col-3">
                    <ul class="list-group">
                       <li class="list-group-item  border-0">Submitted: <span>10</span></li>
                        <li class="list-group-item  border-0">Approved: <span>8</span></li>
                        <li class="list-group-item  border-0">Awaiting delivery: <span>YES</span></li>
                    </ul>
                </div>
          </div>
          
     <section class="container-fluid mt-5">
    <section class="row">
     <div class="col-6">
            
         <form>
              <div class="form-group row">
    <label for="fullName" class="col-sm-2 col-form-label">Full Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fullName" placeholder="Auto-generated field">
    </div>
  </div>
            
             <div class="form-group row">
    <label for="course" class="col-sm-2 col-form-label">Course:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="course" placeholder="Auto-generated field">
    </div>
  </div>
  
              
              <div class="form-group row">
    <label for="tutor" class="col-sm-2 col-form-label">Tutor:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tutor" placeholder="Auto-generated field">
    </div>
  </div>
  
  <h5> Item 1 </h5>
  
  
  <h6>Category field(Qualification, Equipment, Events, Professional accreditation, Vocational placement)</h6>
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
                    <textarea class="form-control" type="textarea" name="additionalComments" rows="4" placeholder="Additional Comments:"></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="staffComments" rows="5" placeholder="Staff Comments (Additional comments to students)"></textarea>
                </div>
                
               <button type="button" class="btn btn-primary btn-lg">Save as Draft</button>
               <button type="button" class="btn btn-secondary btn-lg">Submit</button>
                
            </form>