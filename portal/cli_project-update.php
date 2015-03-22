<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    $i_uID = $_SESSION["user_id"]; // This is the id of the user
    //  Retrieving the variables sent by submitting  the update form
    $title = strtolower($_POST['title']); // Variable for the project update title
    $update_desc = strtolower($_POST['update_desc']); // Variable for the update description
    $file = $_POST['file']; // Variable for the updated file
    $i_projID = $_POST['project']; // Variable for the updated project id

    //  Set conditions to update the database table. If it has  got a file to upload or not
    if (isset($file)) {
        //  Code to store the inputed data into th database table
        try {
            // We Will prepare SQL Query
            $str_query = "  INSERT INTO tbl_project_update (proj_id, update_time, title, description, file_name)
                            VALUES (:proj_id, NOW(), :title, :update_desc, :file);";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':proj_id', $i_projID);
            $str_stmt->bindParam(':title', $title);
            $str_stmt->bindParam(':update_desc', $update_desc);
            $str_stmt->bindParam(':file', $file);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $status = "success";    // This variable will be sent back to the user profile page to enable the success display
        }   catch(PDOException $e)  {
            echo "Connection failed: " . $e->getMessage();
            $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
        }
    } else {
         //  Code to store the inputed data into the database table except for a file name
        try {
            $str_query = "  INSERT INTO tbl_project_update (proj_id, update_time, title, description, file_name)
                            VALUES (:proj_id, NOW(), :title, :update_desc, NULL);";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':proj_id', $i_projID);
            $str_stmt->bindParam(':title', $title);
            $str_stmt->bindParam(':update_desc', $update_desc);
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
    header("location:cli_project-detail.php?proj=$i_projID&status=$status"); 
?>