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
    <meta name="description" content="Trading Strategy Analysis Tool Data Entry Page, to fill out form to be analysed">
    <meta name="author" content="Michael Ifeorah">
    <title>Strategy Analyser - Data Entry</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/strat-analyze.css" rel="stylesheet">
    <link href="css/trade-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/trade-admin.js"></script>
    <!-- jQuery validate plugin -->
    <script src="js/jquery.validate.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
     <!-- Validation And Ajax sending -->
    <script type="text/javascript">
        (function($,W,D)
        {
            var VALID = {};
            VALID.UTIL =
            {
                myValid: function()
                {
                    //form validation rules
                    $("#cust_contact-consult").validate({
                        errorElement: "span",
                        errorClass: "error_msg",    //  Define the class for the error message
                        rules: {
                            title: {required: true, minlength: 2},
                            project: {required: true},
                            message_description: {required: true, minlength: 5}
                        },
                        messages: {
                            title: {required: " Please give a title", minlength: "Atleast 2 letters"},
                            project: {required: " Please select the Project"},
                            message_description: {required: ' Please type your message', minlength: 'Atleast 5 letters'}
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
            header("refresh:8; url=cli_cust_contact_consult.php");
        }
    ?>
    <div id="main_wrapper">
        <?php include('tmpl/cli_nav.php');  ?>
        <!-- /.Line breaking -->
        <div><br></div>
        <!--  Page body -->
        <?php include('tmpl/body_wrapper/bdy_cli_cust_contact_consult.php');  ?>
        <!--  Footer -->
        <?php include('tmpl/footer.php');  ?>
    </div>
    <!-- /#main_wrapper -->
</body>
</html>