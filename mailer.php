<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('admin/config.php');

if(isset($_GET['email'])){

    $email = $_GET['email'];
    $sql = mysqli_query($con,"SELECT * FROM `user` where email='$email'");

    if(mysqli_num_rows($sql) > 0){
        
        if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM `user` WHERE email='$email' AND password!='null' ")) > 0 ){

            $six_digit_random_number = random_int(100000, 999999);

        mysqli_query($con,"UPDATE `user` set `code`='$six_digit_random_number' where email='$email'");


        //Load Composer's autoloader
        require 'vendor/autoload.php';
            
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'testingweb348@gmail.com';                     //SMTP username
            $mail->Password   = 'imbestdev01';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('testingweb348@gmail.com', 'Token Finder');
            $mail->addAddress($email);     //Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            $code = $six_digit_random_number;
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forget Password';
            $mail->Body    = '
            
            
            <p>Hi</p>
        
            <p>Forget Your Password</p>
        
            <p>The Verification Code is : <strong> <u>'.$code.'</u> </strong></p>
            
            ';
        
            $mail->send();
            echo '<small class="text-success"> Verification code has been send to <u> '.$email.'</u> </small>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }
        else{
            echo '<small class="text-danger">Cannot Reset Password ( Signup With Google  ) <i class="fas fa-info-circle"></i></small>';
        }
        
    }else{
        echo '<small class="text-danger">Email not exist (please enter correct email address) <i class="fas fa-info-circle"></i></small>';
    }
}

