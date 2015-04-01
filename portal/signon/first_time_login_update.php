<?php 
include_once('session.php');
include_once("pdo-connect.php");

    $i_uID = $_SESSION["user_id"]; // This is the id of the user
    //  Retrieving the variables sent by submitting  the update form
    $password = $_POST['password']; // Variable for the password
    $usr_type = $_POST['usr_typ']; // Variable for the user type either client or employee
    //  Code to store the inputed data into the user table
    try {
        // We Will prepare SQL Query
                $str_query = "  UPDATE tbl_user 
                                SET password=:password, status = 9
                                WHERE user_id = :id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':password', $password);
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
