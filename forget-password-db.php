<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include ('admin/config.php');


if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $code = $_POST['code-2'];
    if(!empty($email) && !empty($code)){
        if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM `user` where email='$email' AND code='$code'"))  > 0  ){
        $_SESSION['forget-password'] = $email; 
        header('location:reset-password.php');
        }
        else{
            $_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">Please Enter Valid Verification Code </div>';
            header('location:forget-password.php?tab=email');
            echo "654";
        }
    }
}
else{
    header('loaction:forget-password.php?tab=email');
}




?>