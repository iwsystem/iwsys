<?php
include_once('signon/session.php');
include_once('signon/pdo-connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Result of the analysis of data entered into the form">
    <meta name="author" content="Michael Ifeorah">
    <title>Strategy Analyser - Result</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../css/sl-slide.css" rel="stylesheet" >
    <link href="../css/animate.css" rel="stylesheet" >
    <!-- MetisMenu CSS -->
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="../css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/portal2.css" rel="stylesheet">
    <link href="../css/portal1.css" rel="stylesheet">
    <!-- Custom Fonts --> 
    <link href="../fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- jQuery validate plugin -->
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Validation Script -->
    <script type="text/javascript">
        (function($,W,D)
        {
            var VALID = {};
            VALID.UTIL =
            {
                myValid: function()
                {
                    //form validation rules
                    $("#myForm").validate({
                        errorElement: "span",
                        errorClass: "error_msg", 
                        rules: {
                            pass: {required: true, minlength: 6},
                            re_pass: {required: true, minlength: 6}
                        },
                        messages: {
                            user_type: {required: "Please re-type matching password", minlength: "Cannot be less than 6 letters"}
                            country: {required: "Please re-type matching password", minlength: "Cannot be less than 6 letters"}
                        }
                    });
                }
            }

            //when the dom has loaded setup form validation rules
            $(D).ready(function($) {
                VALID.UTIL.myValid();
            });

        })(jQuery, window, document);
    </script>
</head>
<body>
    <div id="main_wrapper">
        <?php include('../tmpl/first_time_login_nav.php');  ?>
        <!-- /.Line breaking -->
        <div><br></div>
        <!--  Page body -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Change Password</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading col-lg-9">
                        <p>To improve your security, please change your password to a more secure one inorder to proceed to your page</p>
                            <h3 class="blue_header">New Password</h3>
                            <div class="row">
                                <div>
                                    <!-- Update content section -->
                                    <div class="col-md-8">
                                        <form id="myForm" class="form-horizontal" role="form" method="post" action="first_time_login_update.php">
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">New Password:</label>
                                            <div class="col-lg-6">
                                              <input id="pass" name="pass" class="form-control" type="text" placeholder="New Password">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-3 control-label">Confirm Password:</label>
                                            <div class="col-lg-6">
                                              <input id="re_pass" name="re_pass" class="form-control" type="text" placeholder="Confirm Password">
                                              <input name="usr" id="usr" type="hidden" value="<?php echo $_SESSION["user_id"]; ?>">
                                              <input name="usr_typ" id="usr_typ" type="hidden" value="<?php echo $_SESSION["user_type"]; ?>">
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
        <!--  Footer -->
        <?php include('../tmpl/footer.php');  ?>
    </div>
    <!-- /#main_wrapper -->
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../js/portal1.js"></script>
    <!-- DataTables JavaScript -->
    <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        var table = $('#dataTables-users').dataTable({
            "iDisplayLength" : 30,   // Setting the initial display size for the table
        });
    });
    </script>
</body>
</html>