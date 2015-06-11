
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Add New Project</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading col-lg-9">
                        <p>On this page, you can add new project to the system</p>
                            <h3 class="blue_header">Add Project</h3>
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
                                                            <strong>Thanks</strong>. The New Project was added <strong>Successfully!</strong>
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
                                        <form id="myForm" class="form-horizontal" role="form" method="post" action="stf_project_newProj_add.php" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Consultant:</label>
                                            <div class="col-lg-6">
                                              <?php
                                                try {
                                                    // We Will prepare SQL Query to retrieve all consultants
                                                    $str_query = "  SELECT *
                                                                    FROM tbl_employee
                                                                    WHERE  role_id = 2
                                                                    ORDER BY user_id DESC;";
                                                    $str_stmt = $r_Db->prepare($str_query);
                                                    // For Executing prepared statement we will use below function
                                                    $str_stmt->execute();
                                                    $arr_Consultant = $str_stmt->fetchAll(PDO::FETCH_ASSOC);
                                              ?>
                                                    <select name="consultant" class="form-control" id="consultant" >
                                                        <option value="">-- Select Consultant --</option>
                                                        <?php
                                                            //  Looping through the array to display details retrieved from database
                                                            foreach ($arr_Consultant as $oConsultant) {
                                                              $int_eID = $oConsultant['emp_id']; // Employee id of the consultant
                                                              $int_usrID = $oConsultant['user_id']; // User id of the consultant
                                                              // We Will prepare SQL Query to retrieve name of each consultant
                                                              $str_query = "  SELECT firstname, lastname
                                                                              FROM tbl_user
                                                                              WHERE  user_id = :user_id
                                                                              AND status = 9;";
                                                              $str_stmt = $r_Db->prepare($str_query);
                                                              // For Executing prepared statement we will use below function
                                                              // bind paramenters, Named paramenters alaways start with colon(:)
                                                              $str_stmt->bindParam(':user_id', $int_usrID);
                                                              $str_stmt->execute();
                                                              $arr_cName = $str_stmt->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                            <option value= <?php echo $int_eID; ?> > <?php echo ucfirst($arr_cName["firstname"]) . " " . ucfirst($arr_cName["lastname"]); ?> </option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                              <?php
                                                  }   catch(PDOException $e)  {
                                                          echo "Connection failed: " . $e->getMessage();
                                                  }
                                              ?> 
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Client Name:</label>
                                            <div class="col-lg-6">
                                            <?php
                                                try {
                                                    // We Will prepare SQL Query to retrieve all consultants
                                                    $str_query = "  SELECT *
                                                                    FROM tbl_user
                                                                    WHERE  user_type = 2
                                                                    AND status = 9
                                                                    ORDER BY user_id DESC;";
                                                    $str_stmt = $r_Db->prepare($str_query);
                                                    // For Executing prepared statement we will use below function
                                                    $str_stmt->execute();
                                                    $arr_client = $str_stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    //  We shall use array_slice() to get the first 10 elements of the array to be displayed
                                                    //  Judging from the fact that for a new client registered, a new project should be created immediateley.
                                                    // the next option will be to use TypeAhead to perform Ajax search while typing the name of the client
                                                    $arr_clients = array_slice($arr_client, 0, 10, true);
                                              ?>
                                                    <select name="client" class="form-control" id="client" >
                                                        <option value="">-- Select Client --</option>
                                                        <?php
                                                            //  Looping through the array to display details retrieved from database
                                                            foreach ($arr_clients as $oClient) {
                                                        ?>
                                                            <option value= <?php echo $oClient['user_id']; ?> > <?php echo ucfirst($oClient['firstname']) . " " . ucfirst($oClient['lastname']); ?> </option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                              <?php
                                                  }   catch(PDOException $e)  {
                                                          echo "Connection failed: " . $e->getMessage();
                                                  }
                                                  // Closing MySQL database connection   
                                                  $r_Db = null;
                                              ?> 
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Project Title:</label>
                                            <div class="col-lg-6">
                                              <input id="title" name="title" class="form-control" type="text" placeholder="Title of Project">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                          <label class="col-lg-3 control-label">Start Date:</label>
                                            <div class=' col-lg-6 input-group date' id='datetimepicker6'>
                                              <input type='text' class="form-control" id="start" name="start" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                          <label class="col-lg-3 control-label">Deadline:</label>
                                            <div class='col-lg-6 input-group date' id='datetimepicker7'>
                                              <input type='text' class="form-control" id="deadline" name="deadline" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Initial Project Cost:</label>
                                            <div class="col-lg-6">
                                              <input id="cost" name="cost" class="form-control" type="text" placeholder="Cost of Project">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv">Payment Plan:</label>
                                            <div class="col-lg-6">
                                                <select name="payment_plan" class="form-control" id="payment_plan" >
                                                    <option value="">-- Select Plan --</option>
                                                    <option value="1">OneTime</option>
                                                    <option value="2">2-Tier</option>
                                                    <option value="3">3-Tier</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_one_first" name="payment_1_1_amount" id="payment_1_1_amount">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Amount:*</label>
                                            <div class="col-lg-6">
                                              <input id="payment_1_1_amount_input" name="payment_1_1_amount_input" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group hide p_one_first" name="payment_1_1_due" id="payment_1_1_due">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Due:*</label>
                                            <div class="col-lg-6 input-group date" id="datetimepicker8">
                                              <input id="payment_1_1_due_input" name="payment_1_1_due_input" class="form-control" type="text" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_one_first" name="payment_1_1_status" id="payment_1_1_status">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Status:*</label>
                                            <div class="col-lg-6">
                                                <select id="payment_1_1_status_input" name="payment_1_1_status_input" class="form-control" >
                                                    <option value="0"> Incompleted </option>
                                                    <option value="1"> Completed</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_one_second" name="payment_1_2_amount" id="payment_1_2_amount">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Amount:*</label>
                                            <div class="col-lg-6">
                                              <input id="payment_1_2_amount_input" name="payment_1_2_amount_input" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group hide p_one_second" name="payment_1_2_due" id="payment_1_2_due">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Due:*</label>
                                            <div class="col-lg-6 input-group date" id="datetimepicker9">
                                              <input id="payment_1_2_due_input" name="payment_1_2_due_input" class="form-control" type="text" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_one_second" name="payment_1_2_status" id="payment_1_2_status">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Status:*</label>
                                            <div class="col-lg-6">
                                                <select id="payment_1_2_status_input" name="payment_1_2_status_input" class="form-control" >
                                                    <option value="0"> Incompleted </option>
                                                    <option value="1"> Completed</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_two_first" name="payment_2_1_amount" id="payment_2_1_amount">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Amount:*</label>
                                            <div class="col-lg-6">
                                              <input id="payment_2_1_amount_input" name="payment_2_1_amount_input" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group hide p_two_first" name="payment_2_1_due" id="payment_2_1_due">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Due:*</label>
                                            <div class="col-lg-6 input-group date" id="datetimepicker10">
                                              <input id="payment_2_1_due_input" name="payment_2_1_due_input" class="form-control" type="text" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_two_first" name="payment_2_1_status" id="payment_2_1_status">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Status:*</label>
                                            <div class="col-lg-6">
                                                <select id="payment_2_1_status_input" name="payment_2_1_status_input" class="form-control" >
                                                    <option value="0"> Incompleted </option>
                                                    <option value="1"> Completed</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_two_second" name="payment_2_2_amount" id="payment_2_2_amount">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Amount:*</label>
                                            <div class="col-lg-6">
                                              <input id="payment_2_2_amount_input" name="payment_2_2_amount_input" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group hide p_two_second" name="payment_2_2_due" id="payment_2_2_due">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Due:*</label>
                                            <div class="col-lg-6 input-group date" id="datetimepicker11">
                                              <input id="payment_2_2_due_input" name="payment_2_2_due_input" class="form-control" type="text" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_two_second" name="payment_2_2_status" id="payment_2_2_status">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Status:*</label>
                                            <div class="col-lg-6">
                                                <select id="payment_2_2_status_input" name="payment_2_2_status_input" class="form-control" >
                                                    <option value="0"> Incompleted </option>
                                                    <option value="1"> Completed</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_first" name="payment_3_1_amount" id="payment_3_1_amount">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Amount:*</label>
                                            <div class="col-lg-6">
                                              <input id="payment_3_1_amount_input" name="payment_3_1_amount_input" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_first" name="payment_3_1_due" id="payment_3_1_due">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Due:*</label>
                                            <div class="col-lg-6 input-group date" id="datetimepicker12">
                                              <input id="payment_3_1_due_input" name="payment_3_1_due_input" class="form-control" type="text" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_first" name="payment_3_1_status" id="payment_3_1_status">
                                            <label class="col-lg-3 control-label empDiv"> First Payment Status:*</label>
                                            <div class="col-lg-6">
                                                <select id="payment_3_1_status_input" name="payment_3_1_status_input" class="form-control" >
                                                    <option value="0"> Incompleted </option>
                                                    <option value="1"> Completed</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_second" name="payment_3_2_amount" id="payment_3_2_amount">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Amount:*</label>
                                            <div class="col-lg-6">
                                              <input id="payment_3_2_amount_input" name="payment_3_2_amount_input" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_second" name="payment_3_2_due" id="payment_3_2_due">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Due:*</label>
                                            <div class="col-lg-6 input-group date" id="datetimepicker13">
                                              <input id="payment_3_2_due_input" name="payment_3_2_due_input" class="form-control" type="text" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_second" name="payment_3_2_status" id="payment_3_2_status">
                                            <label class="col-lg-3 control-label empDiv"> Second Payment Status:*</label>
                                            <div class="col-lg-6">
                                                <select id="payment_3_2_status_input" name="payment_3_2_status_input" class="form-control" >
                                                    <option value="0"> Incompleted </option>
                                                    <option value="1"> Completed</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_third" name="payment_3_3_amount" id="payment_3_3_amount">
                                            <label class="col-lg-3 control-label empDiv"> Third Payment Amount:*</label>
                                            <div class="col-lg-6">
                                              <input id="payment_3_3_amount_input" name="payment_3_3_amount_input" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_third" name="payment_3_3_due" id="payment_3_3_due">
                                            <label class="col-lg-3 control-label empDiv"> Third Payment Due:*</label>
                                            <div class="col-lg-6 input-group date" id="datetimepicker14">
                                              <input id="payment_3_3_due_input" name="payment_3_3_due_input" class="form-control" type="text" />
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="form-group hide p_three_third" name="payment_3_3_status" id="payment_3_3_status">
                                            <label class="col-lg-3 control-label empDiv"> Third Payment Status:*</label>
                                            <div class="col-lg-6">
                                                <select id="payment_3_3_status_input" name="payment_3_3_status_input" class="form-control" >
                                                    <option value="0"> Incompleted </option>
                                                    <option value="1"> Completed</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv"> Discount: %</label>
                                            <div class="col-lg-6">
                                              <input id="discount" name="discount" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv"> VAT: %</label>
                                            <div class="col-lg-6">
                                              <input id="vat" name="vat" class="form-control" type="text" value="0">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label"> Final Project Cost:</label>
                                            <div class="col-lg-6">
                                              <input id="final_cost" name="final_cost" class="form-control" type="text" value="0">
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