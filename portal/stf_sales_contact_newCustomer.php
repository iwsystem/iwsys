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
    <title>IW System Portal - Sales Add New </title>
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
                            sales_name: {required: true },
                            sales_phone: {required: false, number: true},
                            sales_email: {required: false, email: true},
                            sales_outcome: {required: true},
                            status: {required: true},
                            sales_country: {required: true, minlength: 2, number: false }
                        },
                        messages: {
                            sales_name: {required: "Please add the customers name"},
                            sales_phone: {number: "Please include only numbers without space"},
                            sales_email: {email: "Please add a valid email"},
                            sales_outcome: {required: "Please  select status"},
                            status: {required: "Please  select status"},
                            sales_country: {required: "Please add a country", minlength: "Cannot be less than 2 letters", number: "Please type a valid country"}
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
        header('refresh:8; url=stf_sales_contact_newCustomer.php');
    }
?>
    <div id="main_wrapper">
        <!--  Navigation -->
        <?php include('tmpl/stf_nav.php');  ?>
        <!-- /.Line breaking -->
        <div><br></div>
        <!--  Page body -->
        <?php include('tmpl/body_wrapper/stf_bdy_sales_contact_newCustomer.php');  ?>
        <!--  Footer -->
        <?php include('tmpl/footer.php');  ?>
    </div>
    <!-- /main_wrapper -->
</body>
</html>