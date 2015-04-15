<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Contact your Consultant</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Use the form below to send a message to your consultant with any comments or suggestions for improvement in your project<br>
                    Your consultant will reply to you as soon as possible.<br>
                    <h6>Please fill in all sections so we can provide you with a more prompt response</h6>
                </div><br>
                <div class="panel-body ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-7">
                                <?php 
                                  //    CHceking if there is a success variable passed from the previous page. That means that it was sent after user details update
                                  if (isset($_GET["status"])) {
                                    if ($_GET["status"] == "success") {
                                        echo '  <div class="alert alert-info alert-dismissable">
                                                    <a class="panel-close close" data-dismiss="alert">×</a> 
                                                    <i class="fa fa-thumbs-up"></i>
                                                    <strong>Message Sent!</strong><br> Your Consultant will get in touch with you shortly.
                                                </div><br>';
                                    } else if ($_GET["status"]== "fail") {
                                        echo '  <div class="alert alert-info alert-dismissable">
                                                    <a class="panel-close close" data-dismiss="alert">×</a> 
                                                    <i class="fa fa-thumbs-down"></i>
                                                    <strong>Sorry!</strong> Something went wrong.<br> Please Try again or contact admin.
                                                </div><br>';
                                    }
                                  } 
                                ?>
                                <form id="cust_contact-consult" class="cust_contact-consult" role="form" name ="cust_contact-consult" method="post" action="cli_send_cust_consultant.php">
                                  <div class="form-group">
                                    <label class="col-lg-3 control-label" for="title">Message Title:</label>
                                    <div class="col-lg-6">
                                      <input id="title" name="title" class="form-control" type="text" placeholder=" Message Title"><br>
                                    </div><br>
                                  </div><br>
                                  <div class="form-group">
                                    <label class="col-lg-3 control-label" for="project"> Project:</label>
                                    <div class="col-lg-8">
                                        <?php
                                            if (isset($_SESSION["user_id"])) {
                                                $int_uID = $_SESSION["user_id"]; // This is the user id of the logged in user                                                
                                            }
                                            try {
                                                // We Will prepare SQL Query
                                                $str_query = "  SELECT *
                                                                FROM tbl_project
                                                                WHERE  user_id = :user_id
                                                                ORDER BY proj_id DESC;";
                                                $str_stmt = $r_Db->prepare($str_query);
                                                // bind paramenters, Named paramenters alaways start with colon(:)
                                                $str_stmt->bindParam(':user_id', $int_uID);
                                                // For Executing prepared statement we will use below function
                                                $str_stmt->execute();
                                                $arr_Project = $str_stmt->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                                <select name="project" class="form-control" id="project" >
                                                    <option value="">-- Select Project --</option>
                                                    <?php
                                                        //  Looping through the array to display details retrieved from database
                                                        foreach ($arr_Project as $oProject) {
                                                    ?>
                                                        <option value= <?php echo $oProject["proj_id"]; ?> > <?php echo $oProject["title"]; ?> </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select><br>
                                        <?php
                                            }   catch(PDOException $e)  {
                                                    echo "Connection failed: " . $e->getMessage();
                                            }
                                            // Closing MySQL database connection   
                                            $r_Db = null;
                                        ?>            
                                    </div><br>
                                  </div><br>
                                  <div></div>
                                  <div class="form-group">
                                    <label class="col-lg-3 control-label" for="message_description"> Type Message:</label>
                                    <div class="col-lg-6">
                                      <textarea id="message_description" name="message_description" class="textarea-large form-control" placeholder="Type Message Here..."></textarea><br>
                                      <input id="us" name="us" type="hidden" value=<?php echo $int_uID; ?> >
                                    </div><br>
                                  </div><br>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-7">
                                      <button type="submit" class="btn btn-primary pull-right" id="submitButton">Send Message</button>
                                    </div>
                                  </div>
                                </form>
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
</div>