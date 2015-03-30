<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    //  Retrieving the variables sent by submitting  the user form
    $i_uID = $_POST['usr']; // This is the id of the user
    $cust_name = strtolower($_POST['cust_name']); // Variable for the user's first name
    $cust_email = $_POST['cust_email']; // Variable for the user's email
    $cust_phone = $_POST['cust_phone']; // Variable for the user's phone
    $cust_note = strtolower($_POST['cust_note']); // Variable for the notes by the customer rep staff
    $status = $_POST['status']; // Variable for the user's phone

    if ($status == "") {
        //  Code to store the inputed data into th database table
        try {
            // We Will prepare SQL Query
            $str_query = "  UPDATE tbl_cust_rep_contact
                            SET cust_name=:cust_name, cust_email=:cust_email, cust_phone=:cust_phone, cust_note=:cust_note 
                            WHERE id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':cust_name', $cust_name);
            $str_stmt->bindParam(':cust_email', $cust_email);
            $str_stmt->bindParam(':cust_phone', $cust_phone);
            $str_stmt->bindParam(':cust_note', $cust_note);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $status = "success";    // This variable will be sent back to the user profile page to enable the success display
        }   catch(PDOException $e)  {
            echo "Connection failed: " . $e->getMessage();
            $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
        }        
    } else {
        //  Code to store the inputed data into th database table when status is changed
        try {
            // We Will prepare SQL Query
            $str_query = "  UPDATE tbl_cust_rep_contact
                            SET cust_name=:cust_name, cust_email=:cust_email, cust_phone=:cust_phone, cust_note=:cust_note, status=8 
                            WHERE id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':cust_name', $cust_name);
            $str_stmt->bindParam(':cust_email', $cust_email);
            $str_stmt->bindParam(':cust_phone', $cust_phone);
            $str_stmt->bindParam(':cust_note', $cust_note);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $status = "success";    // This variable will be sent back to the user profile page to enable the success display
        }   catch(PDOException $e)  {
            echo "Connection failed: " . $e->getMessage();
            $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
        }    
    }

   
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:stf_cust_rep_resolved_edit.php?usr=$i_uID&status=$status"); 
?>