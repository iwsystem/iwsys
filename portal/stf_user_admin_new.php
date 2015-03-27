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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/sl-slide.css" rel="stylesheet" >
    <link href="css/animate.css" rel="stylesheet" >
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/strat-analyze.css" rel="stylesheet">
    <link href="css/trade-admin.css" rel="stylesheet">
    <!-- Custom Fonts --> 
    <link href="fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- jQuery validate plugin -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
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
                            user_type: {required: true },
                            first_name: {required: true },
                            last_name: {required: true },
                            email: {required: true, email: true },
                            phone: {required: true, number: true },
                            address1: {required: true },
                            city: {required: true, number: false },
                            postcode: {required: true },
                            country: {required: true, minlength: 2, number: false }
                        },
                        messages: {
                            user_type: {required: "Please add a user type"},
                            first_name: {required: "Please add user's first name"},
                            last_name: {required: "Please add user's last name"},
                            email: {required: "Please add an email", email: "Please add a valid email"},
                            phone: {required: "Please add a contact number", number: "Please add a valid phone #"},
                            address1: {required: "Please add a valid address"},
                            city: {required: "Please add city", number: "Please add a valid city"},
                            postcode: {required: "Please add a postcode"},
                            country: {required: "Please add a country", minlength: "Cannot be less than 2 letters", number: "Please type a valid country"}
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#user_type').on('change',function(){
                if( $(this).val() == 1){
                    $("#job_titleDiv").removeClass("hide");
                    $("#roleDiv").removeClass("hide");
                } else {
                    $("#job_titleDiv").addClass("hide");
                    $("#roleDiv").addClass("hide");
                }
            });
        });
    </script>
</head>
<body>
    <?php 
        //  Refresh the page after  user details update
        if (isset($_GET["status"])) {
            header("refresh:8; url=stf_user_admin_new.php");
        }
    ?>
    <div id="main_wrapper">
        <?php include('tmpl/stf_nav.php');  ?>
        <!-- /.Line breaking -->
        <div><br></div>
        <!--  Page body -->
        <?php include('tmpl/body_wrapper/stf_bdy_user_admin_new.php');  ?>
        <!--  Footer -->
        <?php include('tmpl/footer.php');  ?>
    </div>
    <!-- /#main_wrapper -->
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/trade-admin.js"></script>
    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
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