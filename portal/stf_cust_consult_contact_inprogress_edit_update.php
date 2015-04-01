<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    //  Retrieving the variables sent by submitting  the user form
    $i_uID = $_POST['usr']; // This is the id of the user
    $i_status = $_POST['status']; // Variable for the user's phone
    $status;    // Creating a variable for the  status message

    if ($i_status == "") {
        //  Redirect to the user profile page
        header("location:stf_cust_consult_contact_inprogress_edit.php?usr=$i_uID"); 
    } else {
        //  Code to store the inputed data into th database table
        try {
            // We Will prepare SQL Query
            $str_query = "  UPDATE tbl_cust_consult_contact
                            SET status=:status 
                            WHERE id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':status', $i_status);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $status = "success";    // This variable will be sent back to the user profile page to enable the success display
        }   catch(PDOException $e)  {
            echo "Connection failed: " . $e->getMessage();
            $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
        }        
        //  Redirect to the user profile page
        header("location:stf_cust_consult_contact_inprogress_edit.php?usr=$i_uID&status=$status"); 
    }
    // Closing MySQL database connection   
    $r_Db = null;
?>