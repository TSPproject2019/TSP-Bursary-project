<?php
$page_title = "Review Staff Submissions";
include('../../partials/header.html');
?>
<section class="container-fluid">
    <form class="col-6 ml-2">
        <div class="row">
            <div>
                <select class="custom-select mr-3">
                    <option selected>Select group</option>
                    <option value="1">BTEC IT</option>
                    <option value="2">BSc Computer Science</option>
                    <option value="3">Engineering</option>
                </select>
            </div>
            <div>
                <select class="custom-select ml-3">
                    <option selected>Select Staff Member</option>
                    <option value="1">Stephen Smith</option>
                    <option value="2">Danny McCombs</option>
                    <option value="3">Nikita Skripnikov</option>
                </select>
            </div>
            <div class="text-right ml-5">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <!-- Table -->
    <table class="table table-hover table-striped table-bordered mt-5 w-50">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Staff Name</th>
                <th scope="col">File Name</th>
                <th scope="col">Date Submitted</th>
                <th scope="col">Cost</th>
                <th scope="col">Available Student Funds</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>351515</td>
                <td>STAFFNAME1</td>
                <td><a data-toggle="modal" data-target="#ModalLong">WEBFORM</a></td>
                <td>10/10/2018</td>
                <td>£50</td>
                <td>£500</td>
                <td>Pending</td>
            </tr>
            <tr>
                <td>351515</td>
                <td>STAFFNAME2</td>
                <td><a data-toggle="modal" data-target="#ModalLong">WEBFORM</a></td>
                <td>10/10/2018</td>
                <td>£100</td>
                <td>£500</td>
                <td>Pending</td>
            </tr>
            <tr>
                <td>351515</td>
                <td>STAFFNAME3</td>
                <td><a data-toggle="modal" data-target="#ModalLong">WEBFORM</a></td>
                <td>10/10/2018</td>
                <td>£150</td>
                <td>£300</td>
                <td>Pending</td>
            </tr>
        </tbody>
    </table>
    
<!-- Modal LG -->
    <div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Modal Webform</h5>
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
                            <div class="col-6">
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </div>
                            <div class="col-5 mb-5 text-right">
                                <button type="submit" class="btn btn-primary" id="test">Submit</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    
            <!-- ITEM 2 -->
            <form class="ml-2">
                        <div class="row">
                            <h5 class="m-2">ITEM 2</h5>
                        </div>
                        <div class="form-group row">
                            <label for="categoryField" class="col-sm-2 col-form-label">Category field:</label>
                            <div class="col-sm-10 mt-2">
                                <select class="custom-select btn btn-secondary" id="categoryField">
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
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="textarea">Justification:</label>
                                    <textarea class="form-control" id="textarea" rows="8" placeholder="Type here..."></textarea>
                                 </div>
                            </div>     
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label>Status of the form: <span>status goes here</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="textarea2">Tutor comments: (To be filled out by the Tutor)</label>
                                <textarea class="form-control" id="textarea2" rows="5" placeholder="Type here..."></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-5 mb-5">
                                <button class="btn btn-danger">Reject</button>
                                
                            </div>
                            <div class="col-5 mb-5 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <hr>
                    </form>
<!--Modal End -->
</section>


<?php
    include ('../../partials/footer.html');
?>