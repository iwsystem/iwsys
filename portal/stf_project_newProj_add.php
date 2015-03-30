<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    $i_uID = $_SESSION["user_id"]; // This is the id of the user
    //  Retrieving the variables sent by submitting  the update form
    $i_consultant = $_POST['consultant']; // Variable for the first name
    $i_client = $_POST['client']; // Variable for the email
    $s_title = strtolower($_POST['title']); // Variable for the first name
    $s_cost = $_POST['cost']; // Variable for the phone
    $start = $_POST['start']; // Variable for the postcode
    $deadline = $_POST['deadline']; // Variable for the postcode


    //  Code to store the inputed data into the user table
    try {
        // We Will prepare SQL Query
        $str_query = "  INSERT INTO tbl_project (title, user_id, start_date, emp_id, cost, deadline, status )
                        VALUES (:title, :user_id, :start_date, :emp_id, :cost, :deadline, 9);";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':title', $s_title);
        $str_stmt->bindParam(':user_id', $i_client);
        $str_stmt->bindParam(':start_date', $start);
        $str_stmt->bindParam(':emp_id', $i_consultant);
        $str_stmt->bindParam(':cost', $s_cost);
        $str_stmt->bindParam(':deadline', $deadline);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $i_projId = $r_Db->lastInsertId();  // Variable for the id of the previously inserted project
        $beta_page = "pages/client/$i_client/test/$i_projId";

        // We Will prepare SQL Query to update the previously inserted table with the beta page
        $str_query = "  UPDATE tbl_project
                        SET beta_page=:beta_page
                        WHERE proj_id = :proj_id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':proj_id', $i_projId);
        $str_stmt->bindParam(':beta_page', $beta_page);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();

        $status = "success";    // This variable will be sent back to the user profile page to enable the success display
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
        $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
    }
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:stf_project_newProj.php?status=$status"); 
?>
