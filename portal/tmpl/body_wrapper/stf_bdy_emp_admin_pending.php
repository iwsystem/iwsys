<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Pending Employees </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    This is a summarized list of all pending employees<br>
                    Click on each employee on the table below, to access more details. 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h3 class="blue_header">List of Pending Employees</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                            <thead>
                                <tr>
                                    <th>Employee's Name</th>
                                    <th>Date Created</th>
                                    <th>Company</th>
                                    <th>Job Position</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    try {
                                        
                                        // We Will prepare SQL Query to retrieve all active users in  the system
                                        $str_query = "  SELECT user_id, firstname, lastname, company, created, user_type
                                                        FROM tbl_user 
                                                        WHERE status = 7
                                                        AND user_type = 1
                                                        ORDER BY user_id DESC;";
                                        $str_stmt = $r_Db->prepare($str_query);
                                        // For Executing prepared statement we will use below function
                                        $str_stmt->execute();
                                        $arr_active_user = $str_stmt->fetchAll(PDO::FETCH_ASSOC);  

                                        //  Looping through the array to display details retrieved from database
                                        foreach ($arr_active_user as $oActiveUser) {
                                            $usr_id = $oActiveUser["user_id"]; // Assigning the variable for hte firstname
                                            $first_name = ucfirst($oActiveUser["firstname"]); // Assigning the variable for hte firstname
                                            $last_name = ucfirst($oActiveUser["lastname"]);    // Assigning the variable for hte lastname
                                            $company = $oActiveUser["company"]; // Assignning variable for the company
                                            $created = $oActiveUser["created"]; // Assignning variable for the creation date
                                            // We Will prepare SQL Query to retrieve all active users in  the system
                                            $str_query = "  SELECT *
                                                            FROM tbl_employee
                                                            WHERE user_id = :user_id;";
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // bind paramenters, Named paramenters alaways start with colon(:)
                                            $str_stmt->bindParam(':user_id', $usr_id);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_active_emp = $str_stmt->fetch(PDO::FETCH_ASSOC);  
                                            echo "<tr>";
                                            echo "<td>" . $first_name." ". $last_name . "</td>"."<td>". $created . "</td>" . "<td>". $company . "</td>" ."<td>". $arr_active_emp['job_position'] . "</td>" ."<td>" . "<a href='stf_emp_admin_pending_edit.php?usr=$usr_id'> <i class='fa fa-edit fa-fw'></i> </a>" . "</td>"; 
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