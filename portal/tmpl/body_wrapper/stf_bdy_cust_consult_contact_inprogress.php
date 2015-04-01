<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Customer Issues - InProgress</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    This is a summarized list of all messages / issues sent by customer which are currently being worked on<br>
                    Click on each message on the table below, to access more details.  
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h3 class="blue_header">List of Issues - InProgress</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                            <thead>
                                <tr>
                                    <th>Customer's Name</th>
                                    <th>Message Title</th>
                                    <th>Project</th>
                                    <th>Date Contacted</th>
                                    <th>Change Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $int_eID = $_SESSION["emp_id"]; // This is the user id of the logged in user / consultant handling the project
                                    try {
                                        if ($int_eID == 1) { //  If the logged in user is the administrator
                                            // We Will prepare SQL Query to retrieve all projects in the system
                                            $str_query = "  SELECT *
                                                            FROM tbl_cust_consult_contact
                                                            WHERE  status = 8
                                                            ORDER BY id DESC;";      
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_resolved_contacts = $str_stmt->fetchAll(PDO::FETCH_ASSOC);                              
                                        } else {    //  For all other consultants
                                            // We Will prepare SQL Query to retrieve projects handled by a staff
                                            $str_query = "  SELECT *
                                                            FROM tbl_cust_consult_contact
                                                            WHERE  emp_id = :emp_id
                                                            AND status = 8
                                                            ORDER BY id DESC;";      
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // bind paramenters, Named paramenters alaways start with colon(:)
                                            $str_stmt->bindParam(':emp_id', $int_eID);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_resolved_contacts = $str_stmt->fetchAll(PDO::FETCH_ASSOC);
                                        }

                                        //  Looping through the array to display details retrieved from database
                                        foreach ($arr_resolved_contacts as $oResolved) {
                                            $contact_id = $oResolved["id"]; // Assigning the variable for the message id
                                            $i_custID = $oResolved["user_id"];    // Assigning a variable for the customer ID used for retrieving their name
                                            $project_id = $oResolved["proj_id"]; // Assigning the variable for the project id
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

                                            //  Query to retrieve the project title
                                            $str_query = "  SELECT title
                                                            FROM tbl_project
                                                            WHERE  proj_id = :proj_id;";
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // bind paramenters, Named paramenters alaways start with colon(:)
                                            $str_stmt->bindParam(':proj_id', $project_id);
                                            $str_stmt->execute();   // For Executing prepared statement we will use below function
                                            $arr_proj = $str_stmt->fetch();    //  Storing the customer's details in an array.
                                            $str_proj = $arr_proj[0];   // Variable of the project title

                                            echo "<tr>";
                                            echo "<td>" . $first_name." ". $last_name . "</td>"."<td>". $oResolved["msg_title"] . "</td>"."<td>". $str_proj . "</td>" ."<td>". $oResolved["time"] . "</td>"."<td>" . "<a href='stf_cust_consult_contact_inprogress_edit.php?usr=$contact_id'> <i class='fa fa-adjust fa-fw'></i> </a>" . "</td>"; 
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