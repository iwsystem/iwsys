<?php
  $i_cID = $_GET['usr'];
try {
      // We Will prepare SQL Query
      $str_query = "  SELECT *
                      FROM tbl_cust_consult_contact
                      WHERE  id = :id;";
      $str_stmt = $r_Db->prepare($str_query);
      // bind paramenters, Named paramenters alaways start with colon(:)
      $str_stmt->bindParam(':id', $i_cID);
      // For Executing prepared statement we will use below function
      $str_stmt->execute();
      $arr_Details = $str_stmt->fetch(PDO::FETCH_ASSOC);

      $i_uID = $arr_Details['user_id'];  // THe customer's ID
      $i_projID = $arr_Details['proj_id'];  // THe project ID
      //  Retrieving the name of the customer
      $str_query = "  SELECT firstname, lastname
                      FROM tbl_user
                      WHERE  user_id = :user_id;";
      $str_stmt = $r_Db->prepare($str_query);
      // bind paramenters, Named paramenters alaways start with colon(:)
      $str_stmt->bindParam(':user_id', $i_uID);
      $str_stmt->execute();   // For Executing prepared statement we will use below function
      $arr_user_name = $str_stmt->fetch();    //  Storing the customer's details in an array.
      $first_name = ucfirst($arr_user_name['firstname']);
      $last_name = ucfirst($arr_user_name['lastname']);

      //  Query to retrieve the project title
      $str_query = "  SELECT title
                      FROM tbl_project
                      WHERE  proj_id = :proj_id;";
      $str_stmt = $r_Db->prepare($str_query);
      // bind paramenters, Named paramenters alaways start with colon(:)
      $str_stmt->bindParam(':proj_id', $i_projID);
      $str_stmt->execute();   // For Executing prepared statement we will use below function
      $arr_proj = $str_stmt->fetch();    //  Storing the customer's details in an array.
      $str_proj = $arr_proj[0];   // Variable of the project title

  }   catch(PDOException $e)  {
          echo "Connection failed: " . $e->getMessage();
  }

  // Closing MySQL database connection   
  $r_Db = null;
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Change Status of Message
                    </h1>
                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Here you can change the status of the issue or message sent by this customer.<br>
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
                                        <h3>Message Details</h3>
                                        <form class="form-horizontal" role="form" method="post" action="stf_cust_consult_contact_pending_edit_update.php">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Customer's Name:</label>
                                            <div class="col-lg-8">
                                              <input name="usr" id="usr" type="hidden" value="<?php echo $arr_Details['id']; ?>">
                                              <input name="name" class="form-control" type="text" value="<?php echo ucfirst($first_name .' ' . $last_name); ?>" disabled>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Message Title:</label>
                                            <div class="col-lg-8">
                                              <input name="company" class="form-control" type="text" value="<?php echo ucfirst($arr_Details['msg_title']); ?>" disabled>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Project:</label>
                                            <div class="col-lg-8">
                                              <input name="project" class="form-control" type="text" value="<?php echo ucfirst($str_proj); ?>" disabled>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Date Sent:</label>
                                            <div class="col-lg-8">
                                              <input name="date" class="form-control" type="text" value="<?php echo ucfirst($arr_Details['time']); ?>" disabled>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv">Change User Status:</label>
                                            <div class="col-lg-6">
                                                <select name="status" class="form-control" id="status" >
                                                    <option value="">-- Change Status --</option>
                                                    <option value="8">InProgress</option>
                                                    <option value="9">Sorted</option>
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