<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    //  Retrieving the variables sent by submitting  the user form
    $i_uID = $_POST['usr']; // This is the id of the user
    $firstname = strtolower($_POST['first_name']); // Variable for the user's first name
    $lastname = strtolower($_POST['last_name']); // Variable for the user's last name
    $email = strtolower($_POST['email']); // Variable for the user's email
    $phone = strtolower($_POST['phone']); // Variable for the user's phone
    $email = strtolower($_POST['email']); // Variable for the user's email
    $address1 = strtolower($_POST['address1']); // Variable for the user's email
    $address2 = strtolower($_POST['address2']); // Variable for the user's email
    $city = strtolower($_POST['city']); // Variable for the user's email
    $state_county = strtolower($_POST['state_county']); // Variable for the user's email
    $postcode = strtolower($_POST['postcode']); // Variable for the user's email
    $country = strtolower($_POST['country']); // Variable for the user's email    $country = strtolower($_POST['country']); // Variable for the user's email
    $status = strtolower($_POST['status']); // Variable for the user's email
    $password = strtolower($_POST['password']); // Variable for the user's password
    $confirm_password = strtolower($_POST['confirm_password']); // Variable for the user's password confirmation field
    //  Set conditions to update the table. If there is no password entered, update other fields except the password
    if ($password == "") {  // If password exists
        if ($status == "") {    // check if ther is a change of status
            //  Code to store the inputed data into th database table
            try {
                // We Will prepare SQL Query
                $str_query = "  UPDATE tbl_user 
                                SET firstname=:firstname, lastname=:lastname, email=:email, phone=:phone, address1=:address1, address2=:address2, city=:city, state_county=:state_county, postcode=:postcode, country=:country
                                WHERE user_id = :id;";
                $str_stmt = $r_Db->prepare($str_query);
                // bind paramenters, Named paramenters alaways start with colon(:)
                $str_stmt->bindParam(':id', $i_uID);
                $str_stmt->bindParam(':firstname', $firstname);
                $str_stmt->bindParam(':lastname', $lastname);
                $str_stmt->bindParam(':email', $email);
                $str_stmt->bindParam(':phone', $phone);
                $str_stmt->bindParam(':address1', $address1);
                $str_stmt->bindParam(':address2', $address2);
                $str_stmt->bindParam(':city', $city);
                $str_stmt->bindParam(':state_county', $state_county);
                $str_stmt->bindParam(':postcode', $postcode);
                $str_stmt->bindParam(':country', $country);
                // For Executing prepared statement we will use below function
                $str_stmt->execute();
                $status = "success";    // This variable will be sent back to the user profile page to enable the success display
            }   catch(PDOException $e)  {
                echo "Connection failed: " . $e->getMessage();
                $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
            }       
        } else {
            //  Code to store the inputed data into th database table
            try {
                // We Will prepare SQL Query
                $str_query = "  UPDATE tbl_user 
                                SET firstname=:firstname, lastname=:lastname, email=:email, phone=:phone, address1=:address1, address2=:address2, city=:city, state_county=:state_county, postcode=:postcode, country=:country, status=:status
                                WHERE user_id = :id;";
                $str_stmt = $r_Db->prepare($str_query);
                // bind paramenters, Named paramenters alaways start with colon(:)
                $str_stmt->bindParam(':id', $i_uID);
                $str_stmt->bindParam(':firstname', $firstname);
                $str_stmt->bindParam(':lastname', $lastname);
                $str_stmt->bindParam(':email', $email);
                $str_stmt->bindParam(':phone', $phone);
                $str_stmt->bindParam(':address1', $address1);
                $str_stmt->bindParam(':address2', $address2);
                $str_stmt->bindParam(':city', $city);
                $str_stmt->bindParam(':state_county', $state_county);
                $str_stmt->bindParam(':postcode', $postcode);
                $str_stmt->bindParam(':country', $country);
                $str_stmt->bindParam(':status', $status);
                // For Executing prepared statement we will use below function
                $str_stmt->execute();
                $status = "success";    // This variable will be sent back to the user profile page to enable the success display
            }   catch(PDOException $e)  {
                echo "Connection failed: " . $e->getMessage();
                $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
            }
        }

    } else {    // If no password
        if ($status == "") {    //  Check if there is a change of status
            //  Code to store the inputed data into th database table
            try {
                // We Will prepare SQL Query
                $str_query = "  UPDATE tbl_user 
                                SET firstname=:firstname, lastname=:lastname, email=:email, phone=:phone, address1=:address1, address2=:address2, city=:city, state_county=:state_county, postcode=:postcode, country=:country, password=:password
                                WHERE user_id = :id;";
                $str_stmt = $r_Db->prepare($str_query);
                // bind paramenters, Named paramenters alaways start with colon(:)
                $str_stmt->bindParam(':id', $i_uID);
                $str_stmt->bindParam(':firstname', $firstname);
                $str_stmt->bindParam(':lastname', $lastname);
                $str_stmt->bindParam(':email', $email);
                $str_stmt->bindParam(':phone', $phone);
                $str_stmt->bindParam(':address1', $address1);
                $str_stmt->bindParam(':address2', $address2);
                $str_stmt->bindParam(':city', $city);
                $str_stmt->bindParam(':state_county', $state_county);
                $str_stmt->bindParam(':postcode', $postcode);
                $str_stmt->bindParam(':country', $country);
                $str_stmt->bindParam(':password', $password);
                // For Executing prepared statement we will use below function
                $str_stmt->execute();
                $status = "success";    // This variable will be sent tback to the user profile page to enable the success display
            }   catch(PDOException $e)  {
                echo "Connection failed: " . $e->getMessage();
                $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
            }
        } else {
            //  Code to store the inputed data into th database table
            try {
                // We Will prepare SQL Query
                $str_query = "  UPDATE tbl_user 
                                SET firstname=:firstname, lastname=:lastname, email=:email, phone=:phone, address1=:address1, address2=:address2, city=:city, state_county=:state_county, postcode=:postcode, country=:country, password=:password, status=:status
                                WHERE user_id = :id;";
                $str_stmt = $r_Db->prepare($str_query);
                // bind paramenters, Named paramenters alaways start with colon(:)
                $str_stmt->bindParam(':id', $i_uID);
                $str_stmt->bindParam(':firstname', $firstname);
                $str_stmt->bindParam(':lastname', $lastname);
                $str_stmt->bindParam(':email', $email);
                $str_stmt->bindParam(':phone', $phone);
                $str_stmt->bindParam(':address1', $address1);
                $str_stmt->bindParam(':address2', $address2);
                $str_stmt->bindParam(':city', $city);
                $str_stmt->bindParam(':state_county', $state_county);
                $str_stmt->bindParam(':postcode', $postcode);
                $str_stmt->bindParam(':country', $country);
                $str_stmt->bindParam(':password', $password);
                $str_stmt->bindParam(':status', $status);
                // For Executing prepared statement we will use below function
                $str_stmt->execute();
                $status = "success";    // This variable will be sent tback to the user profile page to enable the success display
            }   catch(PDOException $e)  {
                echo "Connection failed: " . $e->getMessage();
                $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
            }
        }
    }
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:stf_cust_admin_inactive_edit.php?usr=$i_uID&status=$status"); 
?>