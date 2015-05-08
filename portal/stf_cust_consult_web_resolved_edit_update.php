<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    //  Retrieving the variables sent by submitting  the user form
    $i_uID = $_POST['usr']; // This is the id of the user
    $consult_name = strtolower($_POST['name']); // Variable for the user's  name
    $consult_company = strtolower($_POST['company']); // Variable for the user's company
    $consult_country = $_POST['country']; // Variable for the user's fcountry
    $consult_email = $_POST['email']; // Variable for the user's email
    $consult_phone = $_POST['phone']; // Variable for the user's phone
    $consult_note = strtolower($_POST['note']); // Variable for the notes by the customer rep staff
    $status = $_POST['status']; // Variable for the user's phone
    if ($_POST['new_outcome'] == "") {
        $consult_outcome = $_POST['old_outcome']; // Variable for the contact outcome
    } else {
        $consult_outcome = $_POST['new_outcome']; // Variable for the contact outcome
    }
   
    if ($status == "") {
        //  Code to store the inputed data into th database table
        try {
            // We Will prepare SQL Query
            $str_query = "  UPDATE tbl_consult_contact
                            SET consult_name=:consult_name, consult_company=:consult_company, consult_country=:consult_country, consult_email=:consult_email, consult_phone=:consult_phone, consult_note=:consult_note, consult_outcome=:consult_outcome 
                            WHERE id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':consult_name', $consult_name);
            $str_stmt->bindParam(':consult_company', $consult_company);
            $str_stmt->bindParam(':consult_country', $consult_country);
            $str_stmt->bindParam(':consult_email', $consult_email);
            $str_stmt->bindParam(':consult_phone', $consult_phone);
            $str_stmt->bindParam(':consult_note', $consult_note);
            $str_stmt->bindParam(':consult_outcome', $consult_outcome);
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
            $str_query = "  UPDATE tbl_consult_contact
                            SET consult_name=:consult_name, consult_company=:consult_company, consult_country=:consult_country, consult_email=:consult_email, consult_phone=:consult_phone, consult_note=:consult_note, consult_outcome=:consult_outcome , status=8 
                            WHERE id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':consult_name', $consult_name);
            $str_stmt->bindParam(':consult_company', $consult_company);
            $str_stmt->bindParam(':consult_country', $consult_country);
            $str_stmt->bindParam(':consult_email', $consult_email);
            $str_stmt->bindParam(':consult_phone', $consult_phone);
            $str_stmt->bindParam(':consult_note', $consult_note);
            $str_stmt->bindParam(':consult_outcome', $consult_outcome);
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
    header("location:stf_cust_consult_web_resolved_edit.php?usr=$i_uID&status=$status"); 
?>