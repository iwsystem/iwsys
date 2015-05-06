<?php
include_once('signon/pdo-connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Michael Ifeorah">
    <title>IW System - Invalid Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/framework/bootstrap.min.css" rel="stylesheet">
    <link href="css/framework/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/sl-slide.css" rel="stylesheet" >
    <link href="css/animate.css" rel="stylesheet" >
    <link href="css/main.css" rel="stylesheet" >
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/portal2.css" rel="stylesheet">
    <link href="css/portal1.css" rel="stylesheet">
    <!-- Custom Fonts --> 
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- jQuery validate plugin -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div id="main_wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">IW System</a>
            </div>
        </nav>
        <!-- /Navigation -->
        <!-- /.Line breaking -->
        <div><br></div>
        <!--  Page body -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Invalid User Details !!</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading col-lg-9">
                        <p>Sorry, Invalid Username or Password! Click the button below to return to home page & re-enter your details.</p>
                        <p>If this error message persists, contact your consultant immediately. Thanks</p>
                        </div>
                        <!-- /.End of Add New -->
                        <div class="row"></div>
                        <!-- Project History -->
                        <div class="panel-body">
                        <br><br><br>
                        <a href="index.php" class="btn btn-success btn-large" title="Click to go to Home page">Return To Home</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
        <!--  Footer -->
        <?php include('tmpl/footer.php');  ?>
    </div>
    <!-- /#main_wrapper -->
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/portal1.js"></script>
</body>
</html>