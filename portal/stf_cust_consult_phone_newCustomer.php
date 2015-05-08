<?php
include_once('signon/session.php');
include_once("signon/pdo-connect.php");
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Michael Ifeorah">
    <title>IW System Portal - Consultant Add New </title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/portal2.css" rel="stylesheet">
    <link href="css/portal1.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/portal1.js"></script>
    <!-- jQuery validate plugin -->
    <script src="js/jquery.validate.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
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
                            consult_name: {required: true },
                            consult_phone: {required: false, number: true},
                            consult_email: {required: false, email: true},
                            consult_outcome: {required: true},
                            status: {required: true}
                        },
                        messages: {
                            consult_name: {required: "Please add the customers name"},
                            consult_phone: {number: "Please include only numbers without space"},
                            consult_email: {email: "Please add a valid email"},
                            consult_outcome: {required: "Please  select status"},
                            status: {required: "Please  select status"}
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
<?php
    //  Refresh the page after  user details update
    if (isset($_GET["status"])) {
        header('refresh:8; url=stf_cust_consult_phone_newCustomer.php');
    }
?>
    <div id="main_wrapper">
        <!--  Navigation -->
        <?php include('tmpl/stf_nav.php');  ?>
        <!-- /.Line breaking -->
        <div><br></div>
        <!--  Page body -->
        <?php include('tmpl/body_wrapper/stf_bdy_cust_consult_phone_newCustomer.php');  ?>
        <!--  Footer -->
        <?php include('tmpl/footer.php');  ?>
    </div>
    <!-- /main_wrapper -->
</body>
</html>