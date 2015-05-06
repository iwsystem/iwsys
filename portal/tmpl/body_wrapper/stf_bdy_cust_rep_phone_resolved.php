<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Resolved Customer Contacts - PHONE</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    This is a summarized list of all resolved customer rep communications, for contacts via phone / email<br>
                    Click on each message on the table below, to access more details.  
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h3 class="blue_header">List of Resolved Contacts</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                            <thead>
                                <tr>
                                    <th>Customer's Name</th>
                                    <th>Message Title</th>
                                    <th>Date Contacted</th>
                                    <th>View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    try {
                                        
                                        // We Will prepare SQL Query to retrieve all active users in  the system
                                        $str_query = "  SELECT id, cust_name, cust_subject, contact_date
                                                        FROM tbl_cust_rep_contact 
                                                        WHERE status = 9
                                                        AND cust_medium = 1
                                                        ORDER BY id DESC;";
                                        $str_stmt = $r_Db->prepare($str_query);
                                        // For Executing prepared statement we will use below function
                                        $str_stmt->execute();
                                        $arr_resolved_contacts = $str_stmt->fetchAll(PDO::FETCH_ASSOC);  

                                        //  Looping through the array to display details retrieved from database
                                        foreach ($arr_resolved_contacts as $oResolved) {
                                            $contact_id = $oResolved["id"]; // Assigning the variable for the message id
                                            $name = ucfirst($oResolved["cust_name"]); // Assigning the variable for hte name
                                            $subject = ucfirst($oResolved["cust_subject"]); // Assigning the variable for hte name
                                            $date = $oResolved["contact_date"]; // Assignning variable for the creation date
                                            echo "<tr>";
                                            echo "<td>" . $name. "</td>"."<td>". $subject . "</td>" ."<td>". $date . "</td>"."<td>" . "<a href='stf_cust_rep_phone_resolved_edit.php?usr=$contact_id'> <i class='fa fa-eye fa-fw'></i> </a>" . "</td>"; 
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