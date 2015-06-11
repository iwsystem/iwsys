<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");

    $i_uID = $_SESSION["user_id"]; // This is the id of the user
    //  Retrieving the variables sent by submitting  the update form
    $title = strtolower($_POST['title']); // Variable for the project update title
    $update_desc = strtolower($_POST['update_desc']); // Variable for the update description
    $file_name = $_FILES['file']['name']; // Variable for the updated file
    $i_projID = $_POST['project']; // Variable for the updated project id
    $i_usrTyp = $_POST['usr']; // Variable for the user type that updated the page. Whether it came from the customer or a staff
    $i_projStatus = $_POST['proj_status']; // Variable for the updated project id
    //  Set conditions to update the database table. If it has  got a file to upload or not
    if (!($file_name=="")) {

        $target_dir = "pages/client/$i_uID/upload/doc/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if file already exists
        if (file_exists($target_file)) {
            $status = "file_exists";   // When this variable exists, then the page will display notification on the front end that file is already inthe system
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file"]["size"] > 2500000) {
            $status = "file_too_large";    //  If this existas show the user a message: Sorry, your file is too large
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" && $imageFileType != "svg"
            && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "txt" 
            && $imageFileType != "docm" && $imageFileType != "dot" && $imageFileType != "dotx" && $imageFileType != "pages"
            && $imageFileType != "rtf" && $imageFileType != "csv" && $imageFileType != "pps" && $imageFileType != "ppt" && $imageFileType != "pptx"
            && $imageFileType != "pot" && $imageFileType != "3gp" && $imageFileType != "flv" && $imageFileType != "mpeg" && $imageFileType != "swf" && $imageFileType != "wmv") {
            $status = "file_format";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk > 0) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                //  Code to store the inputed data into th database table
                try {
                    // We Will prepare SQL Query
                    $str_query = "  INSERT INTO tbl_project_update (proj_id, update_time, title, description, file_name, user_type)
                                    VALUES (:proj_id, NOW(), :title, :update_desc, :file, :user_type);";
                    $str_stmt = $r_Db->prepare($str_query);
                    // bind paramenters, Named paramenters alaways start with colon(:)
                    $str_stmt->bindParam(':proj_id', $i_projID);
                    $str_stmt->bindParam(':title', $title);
                    $str_stmt->bindParam(':update_desc', $update_desc);
                    $str_stmt->bindParam(':file', $file_name);
                    $str_stmt->bindParam(':user_type', $i_usrTyp);
                    // For Executing prepared statement we will use below function
                    $str_stmt->execute();
                    $status = "success";    // This variable will be sent back to the user profile page to enable the success display
                }   catch(PDOException $e)  {
                    echo "Connection failed: " . $e->getMessage();
                    $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
                }
            } else {
                $status = "file_too_large";    // This variable will be sent back to the user profile page to enable the failure display
            }
        }
    } else {
         //  Code to store the inputed data into the database table except for a file name
        try {
            $str_query = "  INSERT INTO tbl_project_update (proj_id, update_time, title, description, file_name, user_type)
                            VALUES (:proj_id, NOW(), :title, :update_desc, NULL, :user_type);";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':proj_id', $i_projID);
            $str_stmt->bindParam(':title', $title);
            $str_stmt->bindParam(':update_desc', $update_desc);
            $str_stmt->bindParam(':user_type', $i_usrTyp);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();
            $status = "success";    // This variable will be sent back to the user profile page to enable the success display
        }   catch(PDOException $e)  {
            echo "Connection failed: " . $e->getMessage();
            $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
        }
    }

    //  Section to  modify the p[roject table if the project status is changed]
    if (!($i_projStatus=="")) {
        try {
            $str_query = "  UPDATE tbl_project 
                            SET status=:status
                            WHERE proj_id = :id;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':id', $i_projID);
            $str_stmt->bindParam(':status', $i_projStatus);
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
    header("location:stf_payment_mgt_completed_detail.php?proj=$i_projID&status=$status"); 
?>
