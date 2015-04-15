<?php
  $i_uID = $_GET['usr'];
    try {
      // We Will prepare SQL Query
      $str_query = "  SELECT *
                      FROM tbl_consult_contact
                      WHERE  id = :id;";
      $str_stmt = $r_Db->prepare($str_query);
      // bind paramenters, Named paramenters alaways start with colon(:)
      $str_stmt->bindParam(':id', $i_uID);
      // For Executing prepared statement we will use below function
      $str_stmt->execute();
      $arr_Details = $str_stmt->fetch(PDO::FETCH_ASSOC);
  }   catch(PDOException $e)  {
          echo "Connection failed: " . $e->getMessage();
  }
  // Closing MySQL database connection   
  $r_Db = null;
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Unresolved Message <i class="fa fa-angle-right"></i> <?php echo ucfirst($arr_Details['consult_name']); ?>
                    </h1>
                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Here you can view and update the communication from this customer.<br>
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
                                        <h3>Customer Information</h3>
                                        <form class="form-horizontal" role="form" method="post" action="stf_cust_consult_unresolved_edit_update.php">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Name:</label>
                                            <div class="col-lg-8">
                                              <input name="usr" id="usr" type="hidden" value="<?php echo $arr_Details['id']; ?>">
                                              <input name="name" class="form-control" type="text" value="<?php echo ucfirst($arr_Details['consult_name']); ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Company:</label>
                                            <div class="col-lg-8">
                                              <input name="company" class="form-control" type="text" value="<?php echo ucfirst($arr_Details['consult_company']); ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Phone:</label>
                                            <div class="col-lg-8">
                                              <input name="phone" class="form-control" type="text" value="<?php echo $arr_Details["consult_phone"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Email:</label>
                                            <div class="col-lg-8">
                                              <input name="email" class="form-control" type="text" value="<?php echo $arr_Details["consult_email"]; ?>">
                                            </div>
                                          </div>  
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer Country:</label>
                                            <div class="col-lg-6">
                                              <input id="country" name="country" class="form-control" type="text" value="<?php echo $arr_Details["consult_country"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Service Interest:</label>
                                            <div class="col-lg-6">
                                              <input id="interest" name="interest" class="form-control" type="text" value="<?php echo $arr_Details["consult_interest"]; ?>" disabled>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label" for="message"> Customer's Message:</label>
                                            <div class="col-lg-6">
                                              <textarea id="message" name="message" class="textarea-large form-control" placeholder="Message Here..." disabled><?php echo $arr_Details["consult_description"]; ?></textarea>
                                            </div>
                                          </div><br>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label" for="note"> Staff Note:</label>
                                            <div class="col-lg-6">
                                              <textarea id="note" name="note" class="textarea-large form-control" placeholder="Type Notes Here..."><?php echo $arr_Details["consult_note"]; ?></textarea>
                                              * Maximum 1500 Characters
                                            </div>
                                          </div><br>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv">Change User Status:</label>
                                            <div class="col-lg-6">
                                                <select name="status" class="form-control" id="status" >
                                                    <option value="">-- Change Status --</option>
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