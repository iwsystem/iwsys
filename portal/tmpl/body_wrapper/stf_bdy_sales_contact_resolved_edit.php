<?php
  $i_uID = $_GET['usr'];
    try {
      // We Will prepare SQL Query
      $str_query = "  SELECT *
                      FROM tbl_sales_contact
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
                    <h1 class="page-header">View Resolved Message <i class="fa fa-angle-right"></i> <?php echo ucfirst($arr_Details['sales_name']); ?>
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
                                        <form class="form-horizontal" role="form" method="post" action="stf_sales_contact_resolved_edit_update.php">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Name:</label>
                                            <div class="col-lg-6">
                                              <input name="usr" id="usr" type="hidden" value="<?php echo $arr_Details['id']; ?>">
                                              <input name="sales_name" class="form-control" type="text" value="<?php echo ucfirst($arr_Details['sales_name']); ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Company:</label>
                                            <div class="col-lg-6">
                                              <input name="sales_company" class="form-control" type="text" value="<?php echo ucfirst($arr_Details['sales_company']); ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Phone:</label>
                                            <div class="col-lg-6">
                                              <input name="sales_phone" class="form-control" type="text" value="<?php echo $arr_Details["sales_phone"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Email:</label>
                                            <div class="col-lg-6">
                                              <input name="sales_email" class="form-control" type="text" value="<?php echo $arr_Details["sales_email"]; ?>">
                                            </div>
                                          </div>  
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Address Line 1:</label>
                                            <div class="col-lg-6">
                                              <input id="sales_address1" name="sales_address1" class="form-control" type="text" placeholder="Address Line 1" value="<?php echo $arr_Details["sales_address1"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Address Line 2:</label>
                                            <div class="col-lg-6">
                                              <input id="sales_address2" name="sales_address2" class="form-control" type="text" placeholder="Address Line 2" value="<?php echo $arr_Details["sales_address2"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">City:</label>
                                            <div class="col-lg-6">
                                              <input id="sales_city" name="sales_city" class="form-control" type="text" placeholder="city" value="<?php echo $arr_Details["sales_city"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">State OR County:</label>
                                            <div class="col-lg-6">
                                              <input id="sales_state_county" name="sales_state_county" class="form-control" type="text" placeholder="County" value="<?php echo $arr_Details["sales_state_county"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Postcode:</label>
                                            <div class="col-lg-6">
                                              <input id="sales_postcode" name="sales_postcode" class="form-control" type="text" placeholder="Postcode" value="<?php echo $arr_Details["sales_postcode"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Country:</label>
                                            <div class="col-lg-6">
                                              <input id="sales_country" name="sales_country" class="form-control" type="text" placeholder="Country" value="<?php echo $arr_Details["sales_country"]; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Service Interest:</label>
                                            <div class="col-lg-6">
                                              <input id="sales_interest" name="sales_interest" class="form-control" type="text" value="<?php echo $arr_Details["sales_interest"]; ?>" disabled>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label" for="note"> Staff Note:</label>
                                            <div class="col-lg-6">
                                              <textarea id="sales_note" name="sales_note" class="textarea-large form-control" placeholder="Type Notes Here..."><?php echo $arr_Details["sales_note"]; ?></textarea>
                                              * Maximum 1500 Characters
                                            </div>
                                          </div><br>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Contact Outcome:</label>
                                            <div class="col-lg-6">
                                              <input id="outcome" name="outcome" class="form-control" type="text" value="<?php if ($arr_Details["sales_outcome"] == 0) {echo 'Failed';} else {echo 'Successful';} ?>" disabled>
                                              <input name="old_outcome" id="old_outcome" type="hidden" value="<?php echo $arr_Details['sales_outcome']; ?>">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv">Change Outcome:</label>
                                            <div class="col-lg-6">
                                                <select name="new_outcome" class="form-control" id="new_outcome" >
                                                    <option value="">-- Select Contact Outcome --</option>
                                                    <option value="0">Failed</option>
                                                    <option value="1">Successful</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv">Change User Status:</label>
                                            <div class="col-lg-6">
                                                <select name="status" class="form-control" id="status" >
                                                    <option value="">-- Change Status --</option>
                                                    <option value="8">Unresolved</option>
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