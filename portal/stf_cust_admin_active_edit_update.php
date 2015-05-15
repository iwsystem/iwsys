<?php 
include_once('signon/session.php');
include_once("signon/pdo-connect.php");
include_once("mailer/class.phpmailer.php");
include_once("mailer/class.smtp.php");

    //  Retrieving the variables sent by submitting  the user form
    $i_uID = $_POST['usr']; // This is the id of the user
    $firstname = strtolower($_POST['first_name']); // Variable for the user's first name
    $lastname = strtolower($_POST['last_name']); // Variable for the user's last name
    $email = strtolower($_POST['email']); // Variable for the user's email
    $phone = strtolower($_POST['phone']); // Variable for the user's phone
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

    } else {    // If password is entered

        // Section to create a secure password to be stored in the table
        $cost = 10;

        // Create a random salt
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

        // Prefix information about the hash so PHP knows how to verify it later.
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        // Hash the password with the salt
        $hash_password = crypt($password, $salt);   //  Password to be stored in database
        
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
                $str_stmt->bindParam(':password', $hash_password);
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
                $str_stmt->bindParam(':password', $hash_password);
                $str_stmt->bindParam(':status', $status);
                // For Executing prepared statement we will use below function
                $str_stmt->execute();
                $status = "success";    // This variable will be sent tback to the user profile page to enable the success display
            }   catch(PDOException $e)  {
                echo "Connection failed: " . $e->getMessage();
                $status = "fail";    // This variable will be sent back to the user profile page to enable the failure display
            }
        }
        //  Send mail to the client asking them to sign in and change password from there profile.
        //  As they requested for a change of password.
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
        $mail->addAddress("$email", ucfirst($firstname) . ucfirst($lastname));
        $mail->addReplyTo("donotreply@iwsystem.co.uk","Do Not Reply");
        $mail->Subject    = "Password Changed";
        $mail->AltBody    = "Hi " . ucfirst($firstname) .", A new password has been created for you. Your new password is: "
         . $password . ". Please, login to your account at http://www.iwsystem.co.uk and change your password immediately for improved security of your account. If you didn't request for this change, please contact us immediately on support@iwsystem.co.uk. Thanks. Support Team"; //Text Body
        $mail->IsHTML(true); // send as HTML
        $mail_body             = "Hi " . ucfirst($firstname) .", <br><br>A new password has been created for you <br><br>Your new password is: <b>" . $password . "</b><br><br>Please, login to your <a href='http://www.iwsystem.co.uk'>IW System account</a> and change your password immediately for improved security of your account  
        <br><br>If you didn't request for this change, please contact us immediately on <a>support@iwsystem.co.uk</a>.<br><br>Thanks. <br><br><b>Administrator</b><br>IW System";   // HTML Message
        $mail->msgHTML($mail_body);
        //  Sending off the mail
        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } 
    }
    // Closing MySQL database connection   
    $r_Db = null;
    //  Redirect to the user profile page
    header("location:stf_cust_admin_active_edit.php?usr=$i_uID&status=$status"); 
?>