<?php
    session_start();
?>
        <!-- <div class="row col-lg-6 justify-content-start align-items-center"> -->
            <div>
                  <li class="list-group-item  border-1">Review my drafts</li>
            </div>
            <div class="col-md-4 ml-3">
                <p>Outstanding balance:</p>
            </div>
            <div class="col-md-4 ml-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Submitted:</li>
                    <li class="list-group-item">Approved:</li>
                    <li class="list-group-item">Awaiting delivery:</li>
                </ul>
            </div>
        </div>
          
          <table class="table table-striped">
   <thead class="thead-dark">
    <tr>
      <th scope="col">Date Saved</th>
      <th scope="col">Item Count</th>
      <th scope="col">Price (Total)</th>
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">20/01/2019</th>
      <td>2</td>
      <td>£420.00</td>
     <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">
  Edit
</button></td>
     <td><button type="button" class="btn btn-primary" >Delete</button></td>
    <tr>
      <th scope="row">21/01/2019</th>
      <td>1</td>
      <td>£150.00</td>
      <th><span style="float:left"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">
  Edit
</button></span></th>
      <td><button type="button" class="btn btn-primary" >Delete</button></td>
      
    </tr>
    <tr>
      <th scope="row-3">03/01/2019</th>
      <td>1</td>
      <td>£100.00</td>
      <th><span style="float:left"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">
  Edit
</button></span></th>
      <td><button type="button" class="btn btn-primary" >Delete</button></td>
     
    </tr>
    
  </tbody>
</table> 

<div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Student Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="ml-2">
                        <div class="form-group row">
                             <label for="fullName" class="col-sm-2 col-form-label">Full Name:</label>
                             <div class="col-sm-10">
                                  <input type="text" class="form-control" id="fullName">
                             </div>

                        </div>
                        <div class="form-group row">
                             <label for="course" class="col-sm-2 col-form-label">Course:</label>
                             <div class="col-sm-10">
                                  <input type="text" class="form-control" id="course">
                             </div>
                        </div>
                        
                        <div class="form-group row">
                             <label for="tutor" class="col-sm-2 col-form-label">Tutor:</label>
                             <div class="col-sm-10">
                                  <input type="text" class="form-control" id="tutor">
                             </div>
                        </div>
                        <div class="row">
                            <h5 class="m-2">ITEM 1</h5>
                        </div>
                        <div class="form-group row">
                            <label for="categoryField" class="col-sm-2 col-form-label">Category field:</label>
                            <div class="col-sm-10 mt-2">
                                <select class="custom-select" id="categoryField">
                                    <option selected>Qualification</option>
                                    <option value="1">Equipment</option>
                                    <option value="2">Events</option>
                                    <option value="3">Professional acccreditation</option>
                                    <option value="4">Vocational placement</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                             <div>
                                <label for="itemDescription">Item description:</label>
                                <textarea class="form-control" id="itemDescription" rows="5"></textarea>
                              </div>
                        </div>
            
                         <div class="form-group">
                             <div>
                                 <input type="text" class="form-control" placeholder="URL to the item:">
                             </div>
                        </div>
                        
                        <div class="form-row justify-content-between text-center">
                            <div class="form-group col-md-2">
                              <label for="price">Price:</label>
                              <input type="text" class="form-control" id="price">
                            </div>
                            <div class="form-group col-md-2">
                              <label for="postage">Postage:</label>
                              <input type="text" class="form-control" id="postage">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="additionalFees">Additional Fees:</label>
                              <input type="text" class="form-control" id="additionalFees">
                            </div>
                          </div> 

                        <div class="row mt-3 mb-5">
                            
                            <div class="col-5 mb-5 text-right">
                                <button type="submit" class="btn btn-primary" id="test">Save</button>
                            </div>
                        </div>
                       
                    </form>
