<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");
include_once("mailer/class.phpmailer.php");
include_once("mailer/class.smtp.php");

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

        // We Will prepare SQL Query to retrieve customer's firstname and lastname
        $str_query = "  SELECT firstname, lastname, email
                        FROM tbl_user
                        WHERE  user_id = :user_id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':user_id', $i_client);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $arr_cusName = $str_stmt->fetch(PDO::FETCH_ASSOC);    // Aray containing the fetched data

        $s_cusFirstname = $arr_cusName['firstname'];  // Customer's firstname
        $s_cusLastname = $arr_cusName['lastname'];    // Customer's lastname
        $s_cusEmail = $arr_cusName['email'];    // Customer's email address


        // We Will prepare SQL Query to insert the new project to the database
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
        $beta_page = "pages/client/$s_cusFirstname[0]$s_cusFirstname[1]$s_cusLastname[0]/test/$i_projId";

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

        // We Will prepare SQL Query to retrieve consultant user id from employee table
        $str_query = "  SELECT user_id
                        FROM tbl_employee
                        WHERE  emp_id = :emp_id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':emp_id', $i_consultant);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $arr_Consultant = $str_stmt->fetch();
        $i_cUserID = $arr_Consultant[0];    // User id of the consultant

         // We Will prepare SQL Query to retrieve consultant firstname and lastname
        $str_query = "  SELECT firstname, lastname, email
                        FROM tbl_user
                        WHERE  user_id = :user_id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':user_id', $i_cUserID);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $arr_cName = $str_stmt->fetch(PDO::FETCH_ASSOC);    // Aray containing the fetched data

        $s_consultFirstname = $arr_cName['firstname'];  // Consultants firstname
        $s_consultLastname = $arr_cName['lastname'];    // Consultants lastname
        $s_consultEmail = $arr_cName['email'];    // Consultants email

        //  Preparing PHP Mailer to forward the new Project mail confirmation to the customer 
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
        $mail->addAddress("$s_cusEmail", ucfirst($s_cusFirstname) . ucfirst($s_cusLastname));
        $mail->addAddress("$s_consultEmail", ucfirst($s_consultFirstname) . ucfirst($s_consultLastname));
        $mail->addReplyTo("donotreply@iwsystem.co.uk","Do Not Reply");
        $mail->Subject    = "New Project Created - ".ucfirst($s_title);
        $mail->AltBody    = "Hi there, A new Project has been created for you. You can find the details about the project below: Title: "
         . ucfirst($s_title) . ". Visit your account at www.iwsystem.co.uk to log in and view project. You can contact your project consultant - ". ucfirst($s_consultFirstname)
         . " on ". $s_consultEmail ; //Text Body
        $mail->IsHTML(true); // send as HTML
        $mail_body             = "Hi there, <br><br>A new Project has been created for you. <br>You can find the details about the project below:<br><br><b>Client Name:</b> " .ucfirst($s_cusFirstname) ." ". ucfirst($s_cusLastname) . "<br><b>Title:</b> "
         . ucfirst($s_title) . "<br><b>Project Consultant:</b> " .ucfirst($s_consultFirstname) . "<br><br>Visit <a href='www.iwsystem.co.uk'>IW System</a> to log in and view project. <br>You can contact your project consultant on ". $s_consultEmail . " <br><br>Thanks. <br><br><b>Administrator</b><br>IW System";   // HTML Message
        $mail->msgHTML($mail_body);
        //  Sending off the mail
        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } 

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