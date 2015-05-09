<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Unresolved Sales Contacts </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    This is a summarized list of all unresolved sales communications, for contacts via phone / post<br>
                    Click on each message on the table below, to access more details.  
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h3 class="blue_header">List of Unresolved Contacts</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-users">
                            <thead>
                            <?php
                                $int_eID = $_SESSION["emp_id"]; // This is the user id of the logged in sales rep
                                if ($int_eID == 1) { //  If the logged in user is the administrator
                            ?>
                                <tr>
                                    <th>Customer's Name</th>
                                    <th>Staff Name</th>
                                    <th>Date Contacted</th>
                                    <th>Outcome</th>
                                    <th>View Details</th>
                                </tr>
                            <?php
                                } else {
                            ?>
                                <tr>
                                    <th>Customer's Name</th>
                                    <th>Customer Company</th>
                                    <th>Date Contacted</th>
                                    <th>Outcome</th>
                                    <th>View Details</th>
                                </tr>
                            <?php
                                }
                            ?>

                            </thead>
                            <tbody>
                                <?php
                                    try {
                                        if ($int_eID == 1) { //  If the logged in user is the administrator
                                            // We Will prepare SQL Query to retrieve all active users in  the system
                                            $str_query = "  SELECT id, emp_id, sales_name, sales_company, contact_date, sales_outcome
                                                            FROM tbl_sales_contact 
                                                            WHERE status = 8
                                                            ORDER BY id DESC;";
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_resolved_contacts = $str_stmt->fetchAll(PDO::FETCH_ASSOC);                                              
                                        } else {    // For every otehr staff
                                            // We Will prepare SQL Query to retrieve all active users in  the system
                                            $str_query = "  SELECT id, emp_id, sales_name, sales_company, contact_date, sales_outcome
                                                            FROM tbl_sales_contact 
                                                            WHERE status = 8
                                                            AND emp_id = :emp_id
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
                                            $name = ucfirst($oResolved["sales_name"]); // Assigning the variable for hte name
                                            $company = ucfirst($oResolved["sales_company"]); // Assigning the variable for hte name
                                            $date = $oResolved["contact_date"]; // Assignning variable for the creation date
                                            $outcome = $oResolved["sales_outcome"]; // Assigning the variable for the outcome
                                            $employee = $oResolved["emp_id"]; // Assigning the variable for the employee id that stored the record
                                            if ($outcome == 0) {
                                                $outcome_message = "Failed";
                                            } else {
                                                $outcome_message = "Successful";
                                            }

                                            // Query to retrieve details of the employee that stored the information
                                            $str_query= "   SELECT  *
                                                            FROM tbl_employee
                                                            WHERE emp_id = :employee;";
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // bind paramenters, Named paramenters alaways start with colon(:)
                                            $str_stmt->bindParam(':employee', $employee);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_employee = $str_stmt->fetch(PDO::FETCH_ASSOC); 

                                            $emp_user_id = $arr_employee["user_id"];    // User I d of the employee

                                            // Query to retrieve name of the employee that stored the information
                                            $str_query= "   SELECT  firstname, lastname
                                                            FROM tbl_user
                                                            WHERE user_id = :emp_user_id;";
                                            $str_stmt = $r_Db->prepare($str_query);
                                            // bind paramenters, Named paramenters alaways start with colon(:)
                                            $str_stmt->bindParam(':emp_user_id', $emp_user_id);
                                            // For Executing prepared statement we will use below function
                                            $str_stmt->execute();
                                            $arr_employee_names = $str_stmt->fetch(PDO::FETCH_ASSOC); 
                                            $emp_firstname = $arr_employee_names["firstname"];  // Employee Firstname
                                            $emp_lastname = $arr_employee_names["lastname"];  // Employee Last name

                                            // Check to see if the user is an administrator, display the name of staff that uploaded record
                                            if ($int_eID == 1) { //  If the logged in user is the administrator
                                                //  Display staff name as well
                                                echo "<tr>";
                                                echo "<td>" . $name. "</td>"."<td>". ucfirst($emp_firstname). " ".ucfirst($emp_lastname) . "</td>" ."<td>". $date . "</td>"."<td>". $outcome_message . "</td>" . "<td>" . "<a href='stf_sales_contact_unresolved_edit.php?usr=$contact_id'> <i class='fa fa-eye fa-fw'></i> </a>" . "</td>"; 
                                                echo "</tr>";
                                            } else {
                                                echo "<tr>";
                                                echo "<td>" . $name. "</td>"."<td>". $company . "</td>" ."<td>". $date . "</td>"."<td>". $outcome_message . "</td>" . "<td>" . "<a href='stf_sales_contact_unresolved_edit.php?usr=$contact_id'> <i class='fa fa-eye fa-fw'></i> </a>" . "</td>"; 
                                                echo "</tr>";
                                            }
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