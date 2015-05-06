
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
                            Here you can add new custoemrs that called in by phone.<br>
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
                                        <form id="myForm" class="form-horizontal" role="form" method="post" action="stf_cust_rep_phone_newCustomer_add.php">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Name:</label>
                                            <div class="col-lg-8">
                                              <input name="cust_name" class="form-control" type="text" placeholder="Type name="" ">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Country:</label>
                                            <div class="col-lg-8">
                                              <input name="cust_country" class="form-control" type="text" placeholder= "Type Country">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Phone:</label>
                                            <div class="col-lg-8">
                                              <input name="cust_phone" class="form-control" type="text" placeholder="Type Phone">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Email:</label>
                                            <div class="col-lg-8">
                                              <input id="cust_email" name="cust_email" class="form-control" type="text" placeholder="Type Email">
                                            </div>
                                          </div>  
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Confirm Email:</label>
                                            <div class="col-lg-6">
                                              <input id="confirm_email" name="confirm_email" class="form-control cust_email" equalTo='#cust_email' type="text" placeholder="Confirm Email">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Message Subject:</label>
                                            <div class="col-lg-6">
                                              <input id="cust_subject" name="cust_subject" class="form-control" type="text" placeholder= "Type Subject">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label" for="cust_message"> Customer's Message:</label>
                                            <div class="col-lg-6">
                                              <textarea id="cust_message" name="cust_message" class="textarea-large form-control" placeholder="Message Here..."></textarea>
                                            </div>
                                          </div><br>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label" for="cust_note"> Staff Note:</label>
                                            <div class="col-lg-6">
                                              <textarea id="cust_note" name="cust_note" class="textarea-large form-control" placeholder="Type Notes Here..."></textarea>
                                              * Maximum 1500 Characters
                                            </div>
                                          </div><br>
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