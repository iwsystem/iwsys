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
                                    <div class="clock-container">
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
                            <h2 class="blue_header">Projects</h2>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            This is a summarized list of all open projects that you have. <br>
                                            Click on the <b>Project Title </b> to see more details about your ongoing project.
                                            Alternatively, if you wish to quickly visit the test deployment of your project, click on <b>beta</b> on the table below. 
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="project-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Project Title</th>
                                                            <th>Start Date</th>
                                                            <th>Deadline</th>
                                                            <th>beta</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $int_uID = $_SESSION["user_id"]; // This is the user id of the logged in user
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
                                                            //  Looping through the array to display details retrieved from database
                                                            foreach ($arr_Project as $oProject) {
                                                                $i_projectID = $oProject["proj_id"]; // Assigning the id that will be passed to the detail script
                                                                echo "<tr>";
                                                                echo "<td>" . "<a href='cli_project-detail.php?proj=$i_projectID'>". $oProject["title"] . "</a>" . "</td>"."<td>". $oProject["start_date"] . "</td>"."<td>" . $oProject["deadline"] ."</td>"."<td>" . "<a href='pages/client/test/$int_uID/$i_projectID'>Project Page</a>" . "</td>"; 
                                                                echo "</tr>";
                                                            }
                                                        }   catch(PDOException $e)  {
                                                                echo "Connection failed: " . $e->getMessage();
                                                        }
                                                        // Closing MySQL database connection   
                                                        $r_Db = null;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                            <div class="well">
                                                <br>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /. End of Projects -->
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