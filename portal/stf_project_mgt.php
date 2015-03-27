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
    <meta name="description" content="Result of the analysis of data entered into the form">
    <meta name="author" content="Michael Ifeorah">
    <title>Strategy Analyser - Result</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/strat-analyze.css" rel="stylesheet">
    <link href="css/trade-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="fa/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="main_wrapper">
        <?php include('tmpl/stf_nav.php');  ?>
        <!-- /.Line breaking -->
        <div><br></div>
        <!--  Page body -->
        <?php include('tmpl/body_wrapper/stf_bdy_project_mgt.php');  ?>
        <!--  Footer -->
        <?php include('tmpl/footer.php');  ?>
    </div>
    <!-- /#main_wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/trade-admin.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        var table = $('#dataTables-example').dataTable({
            "iDisplayLength" : 30,   // Setting the initial display size for the table
        });
    });

    </script>
</body>
</html>