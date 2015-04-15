<?php 
include_once('session.php');
include_once("pdo-connect.php");

    $i_uID = $_SESSION["user_id"]; // This is the id of the user
    //  Retrieving the variables sent by submitting  the update form
    $password = $_POST['password']; // Variable for the password
    $usr_type = $_POST['usr_typ']; // Variable for the user type either client or employee
    //  Code to store the inputed data into the user table
    try {

        // Section to create a secure password to be stored in the table
        $cost = 10;

        // Create a random salt
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

        // Prefix information about the hash so PHP knows how to verify it later.
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        // Hash the password with the salt
        $hash_password = crypt($password, $salt);   //  Password to be stored in database
        // We Will prepare SQL Query
        $str_query = "  UPDATE tbl_user 
                        SET password=:password, status = 9
                        WHERE user_id = :id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':password', $hash_password);
        $str_stmt->bindParam(':id', $i_uID);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        //  Condition to check if the user is a staff or client, for redirection
        if ($usr_type == 1) {
            //  Redirect to the staff home page
            header("location:../stf_home.php"); 
        } else {
            //  Redirect to the client home page
            header("location:../cli_home.php"); 
        }

    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
    }
    // Closing MySQL database connection   
    $r_Db = null;
?>
