<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Profile
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Welcome to the user profile of your account. Here you can view and edit your registered details..<br>
                        </div>
                        <div class="panel-body ">
                            <div class="row">
                                <div class="col-lg-12"><br>
                                    <div class="row">
                                        <!-- left column -->
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <div class="image-section">
                                                <?php
                                                  if (isset($arr_Details["photo"])) {
                                                ?>
                                                    <img src="img/user-avatar.png" class="avatar img-circle user-photo" alt="avatar">
                                                <?php
                                                  } else  {
                                                ?>
                                                    <img src="img/user-avatar.png" class="avatar img-circle user-photo" alt="avatar">
                                                <?php
                                                  }
                                                ?>
                                                    
                                                </div>
                                                <!-- <h6>Upload a different photo...</h6>
                                                <input  name="image" type="file" class="form-control upload-width"> -->
                                            </div>
                                        </div>
                                      <!-- edit form column -->
                                      <div class="col-md-8 personal-info">
                                        <?php 
                                          //    CHceking if there is a success variable passed from the previous page. That means that it was sent after user details update
                                          if (isset($_GET["status"])) {
                                            if ($_GET["status"] == "success") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-coffee"></i>
                                                            <strong>Thanks</strong>. Your details were updated <strong>Successfully!</strong>
                                                        </div>';
                                            } else if ($_GET["status"]== "fail") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-coffee"></i>
                                                            <strong>Sorry</strong>. Your update was <strong>Unsuccessfully!</strong>. Please retry or contact admin.
                                                        </div>';
                                            }
                                          } 
                                        ?>
                                        <h3>Personal Info</h3>
                                        <form class="form-horizontal" role="form" method="post" action="cli_user_profile_update.php">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">First name:</label>
                                            <div class="col-lg-8">
                                              <input name="first_name" class="form-control" type="text" value="<?php echo ucfirst($arr_Details['firstname']); ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Last name:</label>
                                            <div class="col-lg-8">
                                              <input name="last_name" class="form-control" type="text" value="<?php echo ucfirst($arr_Details["lastname"]); ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Company:</label>
                                            <div class="col-lg-8">
                                              <input name="company" class="form-control" type="text" value="<?php echo ucfirst($arr_Details["company"]); ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Phone:</label>
                                            <div class="col-lg-8">
                                              <input name="phone" class="form-control" type="text" value="<?php echo $arr_Details["phone"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Email:</label>
                                            <div class="col-lg-8">
                                              <input name="email" class="form-control" type="text" value="<?php echo $arr_Details["email"]; ?>">
                                            </div>
                                          </div>  
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Address Line 1:</label>
                                            <div class="col-lg-6">
                                              <input id="address1" name="address1" class="form-control" type="text" value="<?php echo $arr_Details["address1"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Address Line 2:</label>
                                            <div class="col-lg-6">
                                              <input id="address2" name="address2" class="form-control" type="text" value="<?php echo $arr_Details["address2"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">City:</label>
                                            <div class="col-lg-6">
                                              <input id="city" name="city" class="form-control" type="text" value="<?php echo $arr_Details["city"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">State OR County:</label>
                                            <div class="col-lg-6">
                                              <input id="state_county" name="state_county" class="form-control" type="text" value="<?php echo $arr_Details["state_county"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Postcode:</label>
                                            <div class="col-lg-6">
                                              <input id="postcode" name="postcode" class="form-control" type="text" value="<?php echo $arr_Details["postcode"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Country:</label>
                                            <div class="col-lg-6">
                                              <input id="country" name="country" class="form-control" type="text" value="<?php echo $arr_Details["country"]; ?>">
                                            </div>
                                          </div>                                          
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Date of Account Creation:</label>
                                            <div class="col-lg-8">
                                              <input name="created" class="form-control" type="text" value="<?php echo $arr_Details["created"]; ?>" disabled>
                                            </div>
                                          </div>
                                          <div class="form-group">  
                                            <label class="col-md-3 control-label">Username:</label>
                                            <div class="col-md-8">
                                              <input name="username" class="form-control" type="text" value="<?php echo $arr_Details["username"]; ?>" disabled>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Password:</label>
                                            <div class="col-md-8">
                                              <input id="password" name="password" class="form-control" type="password">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Confirm password:</label>
                                            <div class="col-md-8">
                                              <input id="confirm_password" name="confirm_password" class="form-control" type="password">
                                              <span id='pass_message'></span>
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