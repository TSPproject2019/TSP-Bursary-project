<?php
    session_start();
?>   
    <div class="row">
    <div class="dropdown col-3 ml-4">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-list-ul"></i></a>
                
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
        <li class="list-group-item  border-1">Admin Staff Submissions Page</li>
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
                        
                        <div class="row mt-3 mb-5">
                            <div class="col-6">
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </div>
                            <div class="col-5 mb-5 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                        
                        <div class="row">
                            <div class="col-10">
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
                            <div class="col-10">
                                <label for="textarea2">Tutor comments: (To be filled out by the Tutor)</label>
                                <textarea class="form-control" id="textarea2" rows="5" placeholder="Type here..."></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-5 mb-5">
                                <button type="submit" class="btn btn-danger">Reject</button>
                                
                            </div>
                            <div class="col-5 mb-5 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <hr>
                    </form>
<!--Modal End -->
</section>
