<?php
$page_title = "Review Student Submissions";
include('../../partials/header.html');
?>

<section class="container-fluid mt-5">
    
    <section class="row">
        
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
                 <h6>ITEM 1</h6>
                 <div>
                     <input type="text" class="form-control" placeholder="Item description:">
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
                         <hr>
                
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
            <!--Put Price, Postage and Additional fees label above input field -->
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
                <hr>
                
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
        <section class="col-6">
            <div class="row justify-content-between">
                <select class="custom-select col-3">
                    <option selected>Group</option>
                    <option value="1">BTEC IT</option>
                    <option value="2">BSc Computer Sciene</option>
                    <option value="3">Egineering</option>
                </select>
           
            
                <select class="custom-select col-3">
                    <option selected>Select Year</option>
                    <option value="1">19/20</option>
                    <option value="2">20/21</option>
                    <option value="3">21/22</option>
                </select>
                
                <select class="custom-select col-3">
                    <option selected>Level</option>
                    <option value="1">Level 4</option>
                    <option value="2">Level 5</option>
                    <option value="3">Level 5</option>
                </select>
                
                <select class="custom-select col-3">
                    <option selected>Sort By</option>
                    <option value="1">Pending</option>
                    <option value="2">Accepted</option>
                    <option value="3">Delivered</option>
                    <option value="4">All</option>
                </select>
            
            </div>
            
            <section>
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
            
        </section>
    </section>
        
        
    </section>
</section>

<?php
    include ('../../partials/footer.html');
?>