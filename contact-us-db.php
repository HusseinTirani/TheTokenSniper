<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include ('admin/config.php');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $sql = mysqli_query($con,"INSERT INTO `message`(`name`, `email`, `message`) VALUES ('$name','$email','$message')");

    if($sql){
        $_SESSION['contact_msg'] = '<div class="alert alert-success text-center py-3" role="alert">Message Sent Successfully</div>';
        header('location:contact-us.php');
    }
}