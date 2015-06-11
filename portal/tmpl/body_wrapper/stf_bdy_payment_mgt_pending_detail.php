<?php
        $i_projID = $_GET["proj"]; // This is the id of the Project being viewed
        try {
            // We Will prepare SQL Query to retrieve project so we extract project title
            $str_query = "  SELECT * 
                            FROM tbl_project 
                            WHERE  proj_id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_projID);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $arr_project = $str_stmt->fetch(PDO::FETCH_ASSOC);
        }   catch(PDOException $e)  {
                echo "Connection failed: " . $e->getMessage();
        }
        //  SQL to retrieve all project updates
        try {
            // We Will prepare SQL Query
            $str_query = "  SELECT *
                            FROM tbl_project_update 
                            WHERE  proj_id = :id
                            ORDER BY id DESC;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_projID);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $arr_project_update = $str_stmt->fetchAll(PDO::FETCH_ASSOC);
        }   catch(PDOException $e)  {
                echo "Connection failed: " . $e->getMessage();
        }
        // Closing MySQL database connection   
        $r_Db = null;

        $proj_title = $arr_project["title"]; // Variable for the project title as retrieved from database 
        ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><?php echo $proj_title; ?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <p>On this page, you can upload new documents, update information about this project and also view the progress of this project.</p>
                        <div class="panel-heading col-lg-9">
                            <h3 class="blue_header">Send an Update</h3>
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
                                                            <strong>Thanks</strong>. Your details were updated <strong>Successfully!</strong>
                                                        </div>';
                                            } else if ($_GET["status"]== "fail") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-thumbs-down"></i>
                                                            <strong>Sorry</strong>. Your update was <strong>Unsuccessfully!</strong>. Please retry or contact your consultant.
                                                        </div>';
                                            } else if ($_GET["status"]== "file_exists") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-thumbs-down"></i>
                                                            <strong>Sorry</strong>. File already exists. <strong>Please</strong> change file name and retry.
                                                        </div>';
                                            } else if ($_GET["status"]== "file_too_large") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-thumbs-down"></i>
                                                            <strong>Sorry</strong>. File too large. Maximum size should be 2.5MB
                                                        </div>';
                                            } else if ($_GET["status"]== "file_format") {
                                                echo '  <div class="alert alert-info alert-dismissable">
                                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                                            <i class="fa fa-thumbs-down"></i>
                                                            <strong>Sorry</strong>. This file type is not allowed. <strong>Please</strong> contact your consultant.
                                                        </div>';
                                            } 
                                          } 
                                        ?>
                                        <form id="myForm" class="form-horizontal" role="form" method="post" action="stf_payment_mgt_pending_update.php" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">Title:</label>
                                            <div class="col-lg-6">
                                              <input id="title" name="title" class="form-control" type="text" placeholder="Title of update">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">Description:</label>
                                            <div class="col-lg-8">
                                                <textarea id="update_desc" name="update_desc" class="textarea-large form-control" placeholder="Describe your update..."></textarea>
                                                <p>Maximum 500 characters</p>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">Upload File:</label>
                                            <div class="col-lg-6">
                                              <input type="file" name="file" id="file">
                                              <input name="project" type="hidden" value=<?php echo $i_projID; ?> >
                                              <input name="usr" type="hidden" value=<?php echo $_SESSION["user_type"]; ?> >
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label empDiv">Change Project Status:</label>
                                            <div class="col-lg-6">
                                                <select name="proj_status" class="form-control" id="proj_status" >
                                                    <option value="">-- Change Status --</option>
                                                    <option value="9">Active</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-8">
                                              <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                              <span></span>
                                              <input type="reset" class="btn btn-default" value="Reset">
                                            </div>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.End of Send Update -->
                        <div class="row"></div>
                        <!-- Project History -->
                        <div class="panel-body">
                            <h3 class="blue_header">Project History</h3><br>
                            <div class="row">
                                <?php
                                    //  Checking if the array of project updates are empty
                                    if (count($arr_project_update)==0)  {
                                ?>
                                            <div class="panel panel-info pull-left history_width">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"> <span class="pull-right"> </span></h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="project_history_body">
                                                        No Update Yet!
                                                    </div>  
                                                </div>
                                                <div class="panel-footer">
                                                    <h6>Attachment: None </h6>
                                                </div>
                                            </div> 
                                <?php
                                    } else {
                                        //  If the array is not empty, that means that there has been some project updates
                                        //  Looping through the array to display details retrieved from database
                                        foreach ($arr_project_update as $oProject_update) {

                                            if($oProject_update['user_type'] == 1)  {   // If the user that made update is a staff
                                ?>
                                            <!-- Display each panel containing the update information-->
                                            <div class="panel panel-info pull-right history_width">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><i class="fa fa-eye fa-fw"></i> <?php echo $oProject_update["title"]; ?> <span class="pull-right"><i class="fa fa-clock-o fa-fw"></i>  <?php echo $oProject_update["update_time"]; ?> </span></h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="project_history_body">
                                                        <?php echo $oProject_update["description"]; ?>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <h6><i class="fa fa-folder fa-fw"></i>Attachment: 
                                                        <?php 
                                                            if (isset($oProject_update["file_name"])) {   // Checking if the file name is set and / or Not NULL
                                                                echo  $oProject_update["file_name"];
                                                            } else {
                                                                echo "No Attachment";
                                                            } 
                                                        ?> 
                                                    </h6>
                                                </div>
                                            </div>  
                                            <div class="row"></div>      
                                <?php   
                                            } elseif ($oProject_update['user_type'] == 2) {     //  If the user that made update is a customer
                                ?>
                                            <!-- Display each panel containing the update information -->
                                            <div class="panel panel-info pull-left history_width">
                                                <div class="panel-heading empHead">
                                                    <h3 class="panel-title"><i class="fa fa-eye fa-fw"></i> <?php echo $oProject_update["title"]; ?> <span class="pull-right"><i class="fa fa-clock-o fa-fw"></i> <?php echo $oProject_update["update_time"]; ?> </span></h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="project_history_body">
                                                        <?php echo $oProject_update["description"]; ?>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <h6><i class="fa fa-folder fa-fw"></i>Attachment: 
                                                        <?php 
                                                            if (isset($oProject_update["file_name"])) {   // Checking if the file name is set and / or Not NULL
                                                                echo  $oProject_update["file_name"];
                                                            } else {
                                                                echo "No Attachment";
                                                            } 
                                                        ?> 
                                                    </h6>
                                                </div>
                                            </div>  
                                            <div class="row"></div>
                                <?php
                                            } 
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->