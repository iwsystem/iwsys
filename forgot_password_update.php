<?php 
include_once("signon/pdo-connect.php");
include_once("mailer/class.phpmailer.php");
include_once("mailer/class.smtp.php");

    //  Retrieving the variables sent by submitting  the update form
    $email = $_POST['email']; // Variable for the email
    $code_word = "floccinaucinihilipilification";   // THe word that is shufffled to get a hash code for new password
    $shuffled_word = str_shuffle($code_word);   // Salt word for the new password
    $password = $shuffled_word[0].$shuffled_word[6].mt_rand(10, 32).$shuffled_word[4].mt_rand(1, 6).$shuffled_word[10].mt_rand(40, 90); // Generating random password using the user's first name and last name combination

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
        $str_query = "  SELECT *
                        FROM tbl_user
                        WHERE email = :email;";
        $str_stmt = $r_Db->prepare($str_query);
        // bind paramenters, Named paramenters alaways start with colon(:)
        $str_stmt->bindParam(':email', $email);
        // For Executing prepared statement we will use below function
        $str_stmt->execute();
        // Count no. of records 
        $count = $str_stmt->rowCount();
        //just fetch. only gets one row. Use  fatch(PDO::FETCH_ASSOC) for making the result an associative array
        $row  = $str_stmt -> fetch();

        if ($count == 1) {
            // We Will prepare SQL Query to insert new password
            $str_query = "  UPDATE tbl_user 
                            SET password=:password, status = 7
                            WHERE email = :email;";
            $str_stmt = $r_Db->prepare($str_query);
            // bind paramenters, Named paramenters alaways start with colon(:)
            $str_stmt->bindParam(':password', $hash_password);
            $str_stmt->bindParam(':email', $email);
            // For Executing prepared statement we will use below function
            $str_stmt->execute();

            //  Preparing PHP Mailer to forward new email to user
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
            $mail->addAddress("$email", ucfirst($row[1]));
            $mail->addReplyTo("donotreply@iwsystem.co.uk","Do not Reply");
            $mail->Subject    = "New Account Password";
            $mail->AltBody    = "Hello " . ucfirst($row[1]). ", A new password has been created for you. Visit your account at www.iwsystem.co.uk. 
            Your login details are: Username: ". $row[12] . " New Password: " . $password . " You will be asked to change your password immediately upon login. This is for improved security of your account because we take the security of
            your data very seriously. If this change was not initiated by you, please contact your consultant immediately.  If you require any further assistance, do not hesitate to contact us at support@iwsystem.co.uk ";
            $mail->IsHTML(true); // send as HTML
            $mail_body             = "Hello <b>" . ucfirst($row[1]) . "</b>, <br><br>A new password has been created for you. <br><br>Visit your account at www.iwsystem.co.uk. <br><br>
            Your login details are: <br><br><b>Username: </b>". $row[12] . " <br><b>Password: </b>" . $password . " <br><br>You will be asked to change your password immediately upon login. This is for improved security of your account because we take the security of
            your data very seriously.<br><br><br><br>If this change was not initiated by you, please contact your consultant immediately. <br><br>Do you require any further assistance? Do not hesitate to contact us at admin@iwsystem.co.uk<br><br><br><br>Thanks<br><br><b>Admin</b>";   // HTML Message
            $mail->msgHTML($mail_body);
            //  Sending off the mail
            if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } 

            // Closing MySQL database connection   
            $r_Db = null;
            //  Redirect to the invalid email page
            header("location:password_change_sent.php"); 
        } elseif ($count > 1) {
            // Closing MySQL database connection   
            $r_Db = null;
            //  Redirect to contact support page
            header("location:password_suport.php"); 
        } else {
            // Closing MySQL database connection   
            $r_Db = null;
            //  Redirect to the invalid email page
            header("location:password_invalid_email.php"); 
        }
    }   catch(PDOException $e)  {
        echo "Connection failed: " . $e->getMessage();
    }

?>
