<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include ('admin/config.php');


if(isset($_POST['reset'])){
    $npassword = $_POST['npassword'];
    $cpassword = $_POST['cpassword'];
    $email = $_SESSION['forget-password']; 
    if(!empty($npassword) && !empty($cpassword)){
        if($npassword == $cpassword ){
            if(mysqli_query($con,"UPDATE `user` set `password`='$npassword'  where email='$email'  ")){
                $_SESSION['error'] = '<div class="alert alert-success text-center" role="alert">Password has been reset </div>'; 
                $_SESSION['reset-redirect'] = true;
                unset($_SESSION['forget-password']);
                mysqli_query($con,"UPDATE `user` set `code`='0' where email='$email' ");
                header('location:reset-password.php');
            }
        }
        else{
            $_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">Password and Confirm password should match!</div>'; 
            header('location:reset-password.php');
        }
    }
}
else{
}




?>