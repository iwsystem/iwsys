<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Pending Payments </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    This is a summarized list of all pending payments for projects you handled <br>
                    Click on each of the payments on the table below, to access more details about it. 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Project Title</th>
                                    <th>Project Cost</th>
                                    <th>Payment Plan</th>
                                    <th>Project History</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $int_eID = $_SESSION["emp_id"]; // This is the user id of the logged in user / consultant handling the project
                                    try {
                                        if ($int_eID == 1) { //  If the logged in user is the administrator
                                            // We Will prepare SQL Query to retrieve all projects in the system
                                            $str_query = "  SELECT *
                                                            FROM tbl_project
                                                            WHERE  status = 8
                                                            ORDER BY proj_id DESC;";      
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_Project = $str_stmt->fetchAll(PDO::FETCH_ASSOC);                              
                                        } else {    //  For all other consultants
                                            // We Will prepare SQL Query to retrieve projects handled by a staff
                                            $str_query = "  SELECT *
                                                            FROM tbl_project
                                                            WHERE  emp_id = :emp_id
                                                            AND status = 8
                                                            ORDER BY proj_id DESC;";      
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
                                            $i_consultID = $oProject["emp_id"];     // Consultant responsible for the project
                                            // We Will prepare SQL Query to determine the name of customer
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

                                            // We Will prepare SQL Query to determine name of consultant
                                            $str_query = "  SELECT firstname, lastname
                                                            FROM tbl_user
                                                            WHERE  user_id = :user_id;";
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // bind paramenters, Named paramenters alaways start with colon(:)
                                            $str_stmt->bindParam(':user_id', $i_consultID);
                                            $str_stmt->execute();   // For Executing prepared statement we will use below function
                                            $arr_consult_name = $str_stmt->fetch();    //  Storing the customer's details in an array.

                                            $consult_first_name = ucfirst($arr_consult_name['firstname']);
                                            $consult_last_name = ucfirst($arr_consult_name['lastname']);

                                            echo "<tr>";
                                            echo "<td>" . $first_name." ". $last_name . "</td>"."<td>". $oProject["title"] . "</td>"."<td>". $oProject["cost"] . "</td>" . "<td>". $oProject["deadline"] . "</td>" . "<td>" . "<a href='stf_payment_mgt_pending_detail.php?proj=$i_projectID'> Payment Details </a>" . "</td>"; 
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