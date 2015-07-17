<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Inactive Clients </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    This is a summarized list of all inactive clients<br>
                    Click on each client on the table below, to access more details. 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h3 class="blue_header">List of Inactive Clients</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                            <thead>
                                <tr>
                                    <th>Client's Name</th>
                                    <th>Client's Email</th>
                                    <th>Date Created</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    try {
                                        
                                        // We Will prepare SQL Query to retrieve all active users in  the system
                                        $str_query = "  SELECT user_id, firstname, lastname, email, created, user_type
                                                        FROM tbl_user 
                                                        WHERE status = 8
                                                        AND user_type = 2
                                                        ORDER BY user_id DESC;";
                                        $str_stmt = $r_Db->prepare($str_query);
                                        // For Executing prepared statement we will use below function
                                        $str_stmt->execute();
                                        $arr_active_user = $str_stmt->fetchAll(PDO::FETCH_ASSOC);  

                                        //  Looping through the array to display details retrieved from database
                                        foreach ($arr_active_user as $oActiveUser) {
                                            $usr_id = $oActiveUser["user_id"]; // Assigning the variable for the user id
                                            $first_name = ucfirst($oActiveUser["firstname"]); // Assigning the variable for hte firstname
                                            $last_name = ucfirst($oActiveUser["lastname"]);    // Assigning the variable for hte lastname
                                            $email = $oActiveUser["email"]; // Assignning variable for the email 
                                            $created = $oActiveUser["created"]; // Assignning variable for the creation date
                                            echo "<tr>";
                                            echo "<td>" . $first_name." ". $last_name . "</td>". "<td>". $email . "</td>" ."<td>". $created . "</td>"."<td>" . "<a href='stf_cust_admin_inactive_edit.php?usr=$usr_id'> <i class='fa fa-edit fa-fw'></i> </a>" . "</td>"; 
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