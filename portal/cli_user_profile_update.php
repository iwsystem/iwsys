<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    $i_uID = $_SESSION["user_id"]; // This is the id of the user
    //  Retrieving the variables sent by submitting  the user form
    $firstname = strtolower($_POST['first_name']); // Variable for the user's first name
    $lastname = strtolower($_POST['last_name']); // Variable for the user's last name
    $email = strtolower($_POST['email']); // Variable for the user's email
    $phone = strtolower($_POST['phone']); // Variable for the user's phone
    $password = strtolower($_POST['password']); // Variable for the user's password
    //  Set conditions to update the table. If there is no password entered, update other fields except the password
    if ($password == "") {
        //  Code to store the inputed data into th database table
        try {
            // We Will prepare SQL Query
            $str_query = "  UPDATE tbl_user 
                            SET firstname=:firstname, lastname=:lastname, email=:email, phone=:phone
                            WHERE user_id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':firstname', $firstname);
            $str_stmt->bindParam(':lastname', $lastname);
            $str_stmt->bindParam(':email', $email);
            $str_stmt->bindParam(':phone', $phone);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $status = "success";    // This variable will be sent back to the user profile page to enable the success display
        }   catch(PDOException $e)  {
            echo "Connection failed: " . $e->getMessage();
            $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
        }
    } else {
        
        // Section to create a secure password to be stored in the table
        $cost = 10;

        // Create a random salt
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

        // Prefix information about the hash so PHP knows how to verify it later.
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        // Hash the password with the salt
        $hash_password = crypt($password, $salt);   //  Password to be stored in database
         //  Code to store the inputed data into th database table
        try {
            // We Will prepare SQL Query
            $str_query = "  UPDATE tbl_user 
                            SET firstname=:firstname, lastname=:lastname, email=:email, phone=:phone, password=:password
                            WHERE user_id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_uID);
            $str_stmt->bindParam(':firstname', $firstname);
            $str_stmt->bindParam(':lastname', $lastname);
            $str_stmt->bindParam(':email', $email);
            $str_stmt->bindParam(':phone', $phone);
            $str_stmt->bindParam(':password', $hash_password);   // Password is saved here
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $status = "success";    // This variable will be sent tback to the user profile page to enable the success display
        }   catch(PDOException $e)  {
            echo "Connection failed: " . $e->getMessage();
            $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
        }
    }
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:cli_user_profile.php?status=$status"); 
?>