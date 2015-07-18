<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");
include_once("mailer/class.phpmailer.php");
include_once("mailer/class.smtp.php");

    $i_uID = $_SESSION["user_id"]; // This is the id of the user
    //  Retrieving the variables sent by submitting  the update form
    $title = strtolower($_POST['title']); // Variable for the project update title
    $update_desc = strtolower($_POST['update_desc']); // Variable for the update description
    $file_name = $_FILES['file']['name']; // Variable for the updated file
    $i_projID = $_POST['project']; // Variable for the updated project id
    $i_usrTyp = $_POST['usr']; // Variable for the user type that updated the page. Whether it came from the customer or a staff

    // We Will prepare SQL Query to retrieve project detail 
    $str_query = "  SELECT user_id, title, emp_id
                    FROM tbl_project
                    WHERE  proj_id = :proj_id;";      
    $str_stmt = $r_Db->prepare($str_query);
    // bind paramenters, Named paramenters alaways start with colon(:)
    $str_stmt->bindParam(':proj_id', $i_projID);
    // For Executing prepared statement we will use below function
    $str_stmt->execute();
    $arr_project_user = $str_stmt->fetch();
    $int_project_user = $arr_project_user['user_id'];
    $str_project_title = $arr_project_user['title'];
    $int_project_consult = $arr_project_user['emp_id'];


/*    // We Will prepare SQL Query to determine the name of customer
    $str_query = "  SELECT firstname, lastname, email
                    FROM tbl_user
                    WHERE  user_id = :user_id;";
    $str_stmt = $r_Db->prepare($str_query);
    // bind paramenters, Named paramenters alaways start with colon(:)
    $str_stmt->bindParam(':user_id', $int_project_user);
    $str_stmt->execute();   // For Executing prepared statement we will use below function
    $arr_user_name = $str_stmt->fetch();    //  Storing the customer's details in an array.

    $first_name = $arr_user_name['firstname'];
    $last_name = $arr_user_name['lastname'];
    $cust_email = $arr_user_name['email'];*/

    // We Will prepare SQL Query to determine the details of consultant
    $str_query = "  SELECT firstname, lastname, email
                    FROM tbl_user
                    WHERE  user_id = :user_id;";
    $str_stmt = $r_Db->prepare($str_query);
    // bind paramenters, Named paramenters alaways start with colon(:)
    $str_stmt->bindParam(':user_id', $int_project_consult);
    $str_stmt->execute();   // For Executing prepared statement we will use below function
    $arr_consult_name = $str_stmt->fetch();    //  Storing the customer's details in an array.

    $consult_first_name = $arr_consult_name['firstname'];
    $consult_last_name = $arr_consult_name['lastname'];
    $consult_email = $arr_consult_name['email'];

    //  Set conditions to update the database table. If it has  got a file to upload or not
    if (!($file_name=="")) {

        $target_dir = "pages/jb/$i_uID/upload/doc/";
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

                    //  Preparing PHP Mailer to forward confirmation to the new staff
                    $mail             = new PHPMailer();    // PHP Mailer Class
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Host       = "mail.iwhosting.org";      // sets Ipage as the SMTP server
                    $mail->Port       = 2525;                   // set the SMTP port
                    $mail->SMTPSecure = "none";                 // sets the prefix to the servier
                    $mail->SMTPAuth   = true;                  // enable SMTP authentication
                    $mail->Username   = "consultant@iwsystem.co.uk";  // GMAIL username
                    $mail->Password   = "Chumasky2014&";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.
                    $mail->From       = "donotreply@iwsystem.co.uk";
                    $mail->FromName   = "IW System";
                    $mail->addAddress("$consult_email", ucfirst($consult_first_name) . ucfirst($consult_last_name));
                    $mail->addReplyTo("donotreply@iwsystem.co.uk","Do not Reply");
                    $mail->Subject    = "New Update on Project - ". ucfirst($str_project_title);
                    $mail->AltBody    = "Hello " . ucfirst($consult_first_name) . " " . ucfirst($consult_last_name) . ", You have received a new message update on the project from your client. 
                    The message details are thus: Message Title:" . $title . "Message:" .$update_desc. "Attachment: Yes.
                    Visit your account at www.iwsystem.co.uk to respond to the message or contact the client directly by email if any further information is required. Regards.   Admin";
                    $mail->IsHTML(true); // send as HTML
                    $mail_body             = "Hello <b>" . ucfirst($consult_first_name) ." " . ucfirst($consult_last_name) . "</b>, <br><br>You have received a new message update on the project from your client. 
                    <br><brThe message details are thus:
                    <br><br><b>Message Title: </b>". $title . " <br><b>Message: </b>" . $update_desc . " <br><b>Attachment: </b> Yes
                    <br><br>Visit your account at www.iwsystem.co.uk to respond to the message or contact your client directly by email if any further information is required. 
                    <br><br>Regards
                    <br><br><b>Admin</b>";   // HTML Message
                    $mail->msgHTML($mail_body);
                    //  Sending off the mail
                    if(!$mail->Send()) {
                      echo "Mailer Error: " . $mail->ErrorInfo;
                    }

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

            //  Preparing PHP Mailer to forward confirmation to the new staff
            $mail             = new PHPMailer();    // PHP Mailer Class
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host       = "mail.iwhosting.org";      // sets Ipage as the SMTP server
            $mail->Port       = 2525;                   // set the SMTP port
            $mail->SMTPSecure = "none";                 // sets the prefix to the servier
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Username   = "consultant@iwsystem.co.uk";  // GMAIL username
            $mail->Password   = "Chumasky2014&";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.
            $mail->From       = "donotreply@iwsystem.co.uk";
            $mail->FromName   = "IW System";
            $mail->addAddress("$consult_email", ucfirst($consult_first_name) . ucfirst($consult_last_name));
            $mail->addReplyTo("donotreply@iwsystem.co.uk","Do not Reply");
            $mail->Subject    = "New Update on Project - ". ucfirst($str_project_title);
            $mail->AltBody    = "Hello " . ucfirst($consult_first_name) . " " . ucfirst($consult_last_name) . ", You have received a new message update on the project from your client. 
            The message details are thus: Message Title:" . $title . "Message:" .$update_desc. "Attachment: No.
            Visit your account at www.iwsystem.co.uk to respond to the message or contact the client directly by email if any further information is required. Regards.   Admin";
            $mail->IsHTML(true); // send as HTML
            $mail_body             = "Hello <b>" . ucfirst($consult_first_name) ." " . ucfirst($consult_last_name) . "</b>, <br><br>You have received a new message update on the project from your client. 
            <br><brThe message details are thus:
            <br><br><b>Message Title: </b>". $title . " <br><b>Message: </b>" . $update_desc . " <br><b>Attachment: </b> No
            <br><br>Visit your account at www.iwsystem.co.uk to respond to the message or contact your client directly by email if any further information is required. 
            <br><br>Regards
            <br><br><b>Admin</b>";   // HTML Message
            $mail->msgHTML($mail_body);
            //  Sending off the mail
            if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            }

        }   catch(PDOException $e)  {
            echo "Connection failed: " . $e->getMessage();
            $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
        }
    }
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:cli_project_detail.php?proj=$i_projID&status=$status"); 
?>
