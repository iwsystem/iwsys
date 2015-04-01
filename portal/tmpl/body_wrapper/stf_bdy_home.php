<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Hello! <?php 
                    if (isset($_SESSION["firstname"])) {
                        echo ucfirst($_SESSION["firstname"]);   // Return the name of the user with the first letter in Capital
                    } else {
                        echo "User";
                    }?>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">              
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Welcome to the home page of your account. Here you will be able to control and access all your projects, resources and records.<br>
                            You last login was on: <?php echo "<strong class='blue_header'>" . $_SESSION["last_login"]  . "</strong>";?>.
                        </div><br>
                        <div class="panel-body ">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="clock-container col-lg-offset-6 col-md-offset-2 col-sm-offset-1 col-xs-offset-1">
                                        <div class="clock">
                                            <div id="Date"></div>
                                            <ul>
                                                <li id="hours"> </li>
                                                <li id="point">:</li>
                                                <li id="min"> </li>
                                                <li id="point">:</li>
                                                <li id="sec"> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><br><br>
                            <!-- End of clock -->

                            <!-- Other Resources - Will be upgraded as time goes on when there are other resouces for cuustomers -->
                            <h2 class="blue_header">Other Resources</h2>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="treufx">
                                        You do not have any other resources at this time
                                    </div>
                                </div>
                            </div>
                            <!-- End of Other Resources -->
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