<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    //  Retrieving the variables sent by submitting  the user form
    $i_uID = $_POST['usr']; // This is the id of the user
    $sales_name = strtolower($_POST['sales_name']); // Variable for the customer's name
    $sales_company = $_POST['sales_company']; // Variable for the customer's company
    $sales_phone = $_POST['sales_phone']; // Variable for the customer's phone
    $sales_email = $_POST['sales_email']; // Variable for the customer's email
    $sales_address1 = strtolower($_POST['sales_address1']); // Variable for asddress line 1
    $sales_address2 = strtolower($_POST['sales_address2']); // Variable for the address line 2
    $sales_city = strtolower($_POST['sales_city']); // Variable for the city
    $sales_state_county = strtolower($_POST['sales_state_county']); // Variable for the state / county
    $sales_postcode = $_POST['sales_postcode']; // Variable for the postcode
    $sales_country = strtolower($_POST['sales_country']); // Variable for the country
    $sales_note = strtolower($_POST['sales_note']); // Variable for the notes by the customer rep staff
    $status = $_POST['status']; // Variable for the user's phone
    if ($_POST['new_outcome'] == "") {
        $sales_outcome = $_POST['old_outcome']; // Variable for the contact outcome
    } else {
        $sales_outcome = $_POST['new_outcome']; // Variable for the contact outcome
    }
   
    if ($status == "") {
        //  Code to store the inputed data into th database table
        try {
            // We Will prepare SQL Query
            $str_query = "  UPDATE tbl_sales_contact
                            SET sales_name=:sales_name, sales_company=:sales_company, sales_phone=:sales_phone, sales_email=:sales_email, sales_address1=:sales_address1, sales_address2=:sales_address2, sales_city=:sales_city, sales_state_county=:sales_state_county, sales_postcode=:sales_postcode, sales_country=:sales_country, sales_note=:sales_note, sales_outcome=:sales_outcome 
                            WHERE id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':sales_name', $sales_name);
            $str_stmt->bindParam(':sales_company', $sales_company);
            $str_stmt->bindParam(':sales_phone', $sales_phone);
            $str_stmt->bindParam(':sales_email', $sales_email);
            $str_stmt->bindParam(':sales_address1', $sales_address1);
            $str_stmt->bindParam(':sales_address2', $sales_address2);
            $str_stmt->bindParam(':sales_city', $sales_city);
            $str_stmt->bindParam(':sales_state_county', $sales_state_county);
            $str_stmt->bindParam(':sales_postcode', $sales_postcode);
            $str_stmt->bindParam(':sales_country', $sales_country);
            $str_stmt->bindParam(':sales_note', $sales_note);
            $str_stmt->bindParam(':sales_outcome', $sales_outcome);
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
            $str_query = "  UPDATE tbl_sales_contact
                            SET sales_name=:sales_name, sales_company=:sales_company, sales_phone=:sales_phone, sales_email=:sales_email, sales_address1=:sales_address1, sales_address2=:sales_address2, sales_city=:sales_city, sales_state_county=:sales_state_county, sales_postcode=:sales_postcode, sales_country=:sales_country, sales_note=:sales_note, sales_outcome=:sales_outcome, status=9 
                            WHERE id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':sales_name', $sales_name);
            $str_stmt->bindParam(':sales_company', $sales_company);
            $str_stmt->bindParam(':sales_phone', $sales_phone);
            $str_stmt->bindParam(':sales_email', $sales_email);
            $str_stmt->bindParam(':sales_address1', $sales_address1);
            $str_stmt->bindParam(':sales_address2', $sales_address2);
            $str_stmt->bindParam(':sales_city', $sales_city);
            $str_stmt->bindParam(':sales_state_county', $sales_state_county);
            $str_stmt->bindParam(':sales_postcode', $sales_postcode);
            $str_stmt->bindParam(':sales_country', $sales_country);
            $str_stmt->bindParam(':sales_note', $sales_note);
            $str_stmt->bindParam(':sales_outcome', $sales_outcome);
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
    header("location:stf_sales_contact_unresolved_edit.php?usr=$i_uID&status=$status"); 
?>