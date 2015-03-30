<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Inactive Projects </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    This is a summarized list of all concluded client projects you handled <br>
                    Click on each of the projects on the table below, to access more details about the project. 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Project Title</th>
                                    <th>Project beta</th>
                                    <th>Project History</th>
                                    <th>Start</th>
                                    <th>Deadline</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $int_eID = $_SESSION["user_id"]; // This is the user id of the logged in user / consultant handling the project
                                    try {
                                        if ($int_eID == 1) { //  If the logged in user is the administrator
                                            // We Will prepare SQL Query to retrieve all projects in the system
                                            $str_query = "  SELECT *
                                                            FROM tbl_project
                                                            WHERE  status = 8;";      
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_Project = $str_stmt->fetchAll(PDO::FETCH_ASSOC);                              
                                        } else {    //  For all other consultants
                                            // We Will prepare SQL Query to retrieve projects handled by a staff
                                            $str_query = "  SELECT *
                                                            FROM tbl_project
                                                            WHERE  emp_id = :emp_id
                                                            AND status = 8;";      
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // bind paramenters, Named paramenters alaways start with colon(:)
                                            $str_stmt->bindParam(':emp_id', $int_eID);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_Project = $str_stmt->fetchAll(PDO::FETCH_ASSOC);
                                        }

                                        //  Looping through the array to display details retrieved from database
                                        foreach ($arr_Project as $oProject) {
                                            $i_projectID = $oProject["proj_id"]; // Assigning the id that will be passed to the detail script
                                            $i_custID = $oProject["user_id"];    // Assigning a variable for the customer ID used for retrieving their name

                                            // We Will prepare SQL Query
                                            $str_query = "  SELECT firstname, lastname
                                                            FROM tbl_user
                                                            WHERE  user_id = :user_id;";
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // bind paramenters, Named paramenters alaways start with colon(:)
                                            $str_stmt->bindParam(':user_id', $i_custID);
                                            $str_stmt->execute();   // For Executing prepared statement we will use below function
                                            $arr_user_name = $str_stmt->fetch();    //  Storing the customer's details in an array.

                                            $first_name = ucfirst($arr_user_name['firstname']);
                                            $last_name = ucfirst($arr_user_name['lastname']);

                                            echo "<tr>";
                                            echo "<td>" . $first_name." ". $last_name . "</td>"."<td>". $oProject["title"] . "</td>"."<td>" . "<a href='pages/client/$i_custID/test/$i_projectID'>Project Page</a>" . "</td>" . "<td>" . "<a href='stf_project_inactive_detail.php?proj=$i_projectID'> Project History </a>" . "</td>"."<td>". $oProject["start_date"] . "</td>"."<td>". $oProject["deadline"] . "</td>"; 
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
    <div></div><br>
</div>
<!-- /#page-wrapper -->