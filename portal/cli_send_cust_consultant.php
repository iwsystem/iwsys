<?php
	include_once('signon/session.php');
	include_once("signon/pdo-connect.php");
include_once("mailer/class.phpmailer.php");
include_once("mailer/class.smtp.php");


    $str_msg_title = $_POST['title']; // Variable for the title of the message from customer
    $int_msg_project = $_POST['project']; // Variable for the project of the customer
    $str_msg_desc = $_POST['message_description']; // Variable for the Message from the customer
    $int_user = $_POST['us']; // Variable for the user_id of the customer

	//  Code to store the inputed data into the database table
    try {
    	//	Query to retrieve the employee ID Associated with the project
        $str_query = "  SELECT emp_id, title
                        FROM tbl_project
                        WHERE  proj_id = :proj_id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':proj_id', $int_msg_project);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $arr_Project = $str_stmt->fetch();
        $int_emp = $arr_Project[0];
        $proj_title = $arr_Project[1];
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
    }

    try {
        // SQL Query to insert into the customer contact consultant table
        $str_query = "  INSERT INTO tbl_cust_consult_contact (user_id, emp_id, msg_title, proj_id, time, status)
                        VALUES (:user_id, :emp_id, :msg_title, :proj_id, NOW(), 7);";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':user_id', $int_user);
        $str_stmt->bindParam(':emp_id', $int_emp);
        $str_stmt->bindParam(':msg_title', $str_msg_title);
        $str_stmt->bindParam(':proj_id', $int_msg_project);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();

        // We Will prepare SQL Query to retrieve consultant user id from employee table
        $str_query = "  SELECT user_id
                        FROM tbl_employee
                        WHERE  emp_id = :emp_id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':emp_id', $int_emp);
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

         // We Will prepare SQL Query to retrieve customer's firstname and lastname
        $str_query = "  SELECT firstname, lastname, email
                        FROM tbl_user
                        WHERE  user_id = :user_id;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':user_id', $int_user);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        $arr_cusName = $str_stmt->fetch(PDO::FETCH_ASSOC);    // Aray containing the fetched data

        $s_cusFirstname = $arr_cusName['firstname'];  // Customer's firstname
        $s_cusLastname = $arr_cusName['lastname'];    // Customer's lastname
        $s_cusEmail = $arr_cusName['email'];    // Customer's email address

        //  Preparing PHP Mailer to forward the new Project mail confirmation to the customer 
        $mail             = new PHPMailer();    // PHP Mailer Class
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host       = "iwsystemcom.ipage.com";      // sets Ipage as the SMTP server
        $mail->Port       = 587;                   // set the SMTP port
        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Username   = "consultant@iwsystem.co.uk";  // GMAIL username
        $mail->Password   = "Chumasky2014&";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.
        $mail->From       = "donotreply@iwsystem.co.uk";
        $mail->FromName   = "IW System";
        $mail->addAddress("$s_consultEmail",ucfirst($s_consultFirstname) . ucfirst($s_consultLastname));
        $mail->addReplyTo("donotreply@iwsystem.co.uk","Do Not Reply");
        $mail->Subject    = "New Message From Client - ". ucfirst($s_cusFirstname);
        $mail->AltBody    = "Hello " . ucfirst($s_consultFirstname) ." " . ucfirst($s_consultLastname) . ", you have a new messsage from one of your clients. The details are below: Customer Name: "
         . ucfirst($s_cusFirstname) . " ". ucfirst($s_cusLastname) . " Message Title:  ". ucfirst($str_msg_title) . " Project: " . $proj_title . " Message: " . $str_msg_desc . "          "; //Text Body
        $mail->IsHTML(true); // send as HTML
        $mail_body             = "Hello " . ucfirst($s_consultFirstname) . " ". ucfirst($s_consultLastname) . ", <br><br>You have a new messsage from one of your clients. The details are below: <br><br><b>Customer Name: </b>"
         . ucfirst($s_cusFirstname) . " ". ucfirst($s_cusLastname) . " <br><b>Message Title:  </b>". ucfirst($str_msg_title) . " <br><b>Project: </b>" . $proj_title . " <br><b>Message: </b>" . $str_msg_desc . " <br><br>Please get intouch with client as soon as possible and update your portal account accordingly ";   // HTML Message
        $mail->msgHTML($mail_body);
        //  Sending off the mail
        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } 

        $status = "success";    // This variable will be sent tback to the user profile page to enable the success display
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
        $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
    }
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:cli_cust_contact_consult.php?status=$status"); 

?>




