
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Customer - PHONE</h1>
                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Here you can add new customers that called in by phone.<br>
                        </div>
                        <div class="panel-body ">
                            <div class="row">
                                <div class="col-lg-12"><br>
                                    <div class="row">
                                      <!-- edit form column -->
                                      <div class="col-md-8 personal-info">
                                        <?php 
                                          //    CHceking if there is a success variable passed from the previous page. That means that it was sent after user details update
                                          if (isset($_GET["status"])) {
                                            if ($_GET["status"] == "success") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-coffee"></i>
                                                            <strong>Thanks</strong>. The customer was added <strong>Successfully!</strong>
                                                        </div>';
                                            } else if ($_GET["status"]== "fail") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-coffee"></i>
                                                            <strong>Sorry</strong>. Your entry was <strong>Unsuccessfully!</strong>. Please retry or contact admin.
                                                        </div>';
                                            }
                                          } 
                                        ?>
                                        <h3>New Customer Information</h3>
                                        <form id="myForm" class="form-horizontal" role="form" method="post" action="stf_cust_consult_phone_newCustomer_add.php">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Name:</label>
                                            <div class="col-lg-8">
                                              <input name="consult_name" class="form-control" type="text" placeholder="Type name">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Company:</label>
                                            <div class="col-lg-8">
                                              <input name="consult_company" class="form-control" type="text" placeholder="Type company">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Country:</label>
                                            <div class="col-lg-8">
                                              <input name="consult_country" class="form-control" type="text" placeholder= "Type Country">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Phone:</label>
                                            <div class="col-lg-8">
                                              <input name="consult_phone" class="form-control" type="text" placeholder="Type Phone">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Email:</label>
                                            <div class="col-lg-8">
                                              <input id="consult_email" name="consult_email" class="form-control" type="text" placeholder="Type Email">
                                            </div>
                                          </div>  
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Confirm Email:</label>
                                            <div class="col-lg-6">
                                              <input id="confirm_email" name="confirm_email" class="form-control consult_email" equalTo='#consult_email' type="text" placeholder="Confirm Email">
                                            </div>
                                          </div>                            
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Service Interest:</label>
                                            <div class="col-lg-6">
                                              <select name="consult_interest" class="form-control" id="consult_interest" >
                                                  <option value="None">-- Select Services --</option>
                                                  <option value="WebDesign">Website Design & Development</option>
                                                  <option value="Web_App_AND_Sys_Dev">Web System / App Development </option>
                                                  <option value="Ecommerce">E-commerce / Web Shop </option>
                                                  <option value="CMS">Content Management System </option>
                                                  <option value="Digital_Marketing">Online / Digital Marketing </option>
                                              </select><br>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label" for="consult_description"> Customer's Message:</label>
                                            <div class="col-lg-6">
                                              <textarea id="consult_description" name="consult_description" class="textarea-large form-control" placeholder="Message Here..."></textarea>
                                            </div>
                                          </div><br>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label" for="consult_note"> Staff Note:</label>
                                            <div class="col-lg-6">
                                              <textarea id="consult_note" name="consult_note" class="textarea-large form-control" placeholder="Type Notes Here..."></textarea>
                                              * Maximum 1500 Characters
                                            </div>
                                          </div><br>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv">Contact Outcome:</label>
                                            <div class="col-lg-6">
                                                <select name="consult_outcome" class="form-control" id="consult_outcome" >
                                                    <option value="">-- Select Contact Outcome --</option>
                                                    <option value="0">Failed</option>
                                                    <option value="1">Successful</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv">Contact Status:</label>
                                            <div class="col-lg-6">
                                                <select name="status" class="form-control" id="status" >
                                                    <option value="">-- Select Contact Status --</option>
                                                    <option value="8">Unresolved</option>
                                                    <option value="9">Resolved</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-8">
                                              <input type="submit" class="btn btn-primary" value="Save Changes">
                                              <span></span>
                                              <input type="reset" class="btn btn-default" value="Cancel">
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
