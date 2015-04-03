
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Add User</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading col-lg-9">
                        <p>On this page, you can add new user to the system</p>
                            <h3 class="blue_header">Add New User</h3>
                            <div class="row">
                                <div>
                                    <!-- Update content section -->
                                    <div class="col-md-8">
                                        <?php 
                                          //    CHceking if there is a success variable passed from the previous page. That means that it was sent after user details update
                                          if (isset($_GET["status"])) {
                                            if ($_GET["status"] == "success") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-thumbs-up"></i>
                                                            <strong>Thanks</strong>. The New User was added <strong>Successfully!</strong>
                                                        </div>';
                                            } else if ($_GET["status"]== "fail") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-thumbs-down"></i>
                                                            <strong>Sorry</strong>. That was <strong>Unsuccessfully!</strong>. Please retry.
                                                        </div>';
                                            }
                                          } 
                                        ?>
                                        <form id="myForm" class="form-horizontal" role="form" method="post" action="stf_user_admin_newUser_add.php" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">User Type:</label>
                                            <div class="col-lg-6">
                                                <select name="user_type" class="form-control" id="user_type" >
                                                    <option value="">-- Select User Type --</option>
                                                    <option value="2">Customer</option>
                                                    <option value="1">Employee</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group hide" name="job_titleDiv" id="job_titleDiv">
                                            <label class="col-lg-3 control-label empDiv"> Job Title:*</label>
                                            <div class="col-lg-6">
                                              <input id="job_title" name="job_title" class="form-control" type="text" placeholder="Job Position of the staff">
                                            </div>
                                          </div>
                                          <div class="form-group hide" name="roleDiv" id="roleDiv">
                                            <label class="col-lg-3 control-label empDiv">Role:*</label>
                                            <div class="col-lg-6">
                                                <select name="role" class="form-control" id="role" >
                                                    <option value="">-- Select Role --</option>
                                                    <option value="1">Administrator</option>
                                                    <option value="2" >Consultant</option>
                                                    <option value="3">Developer</option>
                                                    <option value="4">Sales</option>
                                                    <option value="5">Customer Rep</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">First Name:</label>
                                            <div class="col-lg-6">
                                              <input id="first_name" name="first_name" class="form-control" type="text" placeholder="First Name of User">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Last Name:</label>
                                            <div class="col-lg-6">
                                              <input id="last_name" name="last_name" class="form-control" type="text" placeholder="Last Name of User">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Email:</label>
                                            <div class="col-lg-6">
                                              <input id="email" name="email" class="form-control" type="text" placeholder="Email of User">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Confirm Email:</label>
                                            <div class="col-lg-6">
                                              <input id="confirm_email" name="confirm_email" class="form-control required email" equalTo='#email' type="text" placeholder="Confirm Email">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Phone:</label>
                                            <div class="col-lg-6">
                                              <input id="phone" name="phone" class="form-control" type="text" placeholder="Contact # of User">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Address Line 1:</label>
                                            <div class="col-lg-6">
                                              <input id="address1" name="address1" class="form-control" type="text" placeholder="Address Line 1">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Address Line 2:</label>
                                            <div class="col-lg-6">
                                              <input id="address2" name="address2" class="form-control" type="text" placeholder="Address Line 2">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">City:</label>
                                            <div class="col-lg-6">
                                              <input id="city" name="city" class="form-control" type="text" placeholder="city">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">State OR County:</label>
                                            <div class="col-lg-6">
                                              <input id="state_county" name="state_county" class="form-control" type="text" placeholder="County">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Postcode:</label>
                                            <div class="col-lg-6">
                                              <input id="postcode" name="postcode" class="form-control" type="text" placeholder="Postcode">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Country:</label>
                                            <div class="col-lg-6">
                                              <input id="country" name="country" class="form-control" type="text" placeholder="Country">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-8">
                                              <input type="submit" name="submit" class="btn btn-primary" value="Add">
                                              <span class="gap"></span>
                                              <input type="reset" class="btn btn-default" value="Reset">
                                            </div>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.End of Add New -->
                        <div class="row"></div>
                        <!-- Project History -->
                        <div class="panel-body">
                        <br><br>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->