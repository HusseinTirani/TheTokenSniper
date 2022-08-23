<?php
include('./admin/config.php');
session_start();

if(isset($_POST['submit'])){

    $coinname = $_POST['coinname'];
    $Symbol = $_POST['Symbol'];
    $NetworkChain = $_POST['chain'];
    $Marketcap = $_POST['Marketcap'];
    $price = $_POST['price'];
    $contract_address = $_POST['contract_address'];
    $Description = $_POST['Description'];
    $Website = $_POST['Website'];
    $Launchdate = $_POST['Launchdate'];
    $Telegram = $_POST['Telegram'];
    $Twitter = $_POST['Twitter'];
    // $reddit = $_POST['reddit'];
    // $Discord = $_POST['Discord'];
    // $Charts = $_POST['Charts'];
    // $flooz = $_POST['flooz'];
    $information = $_POST['information'];


    $file= $_FILES['Logo'];	
    $filename = $file['name'];
    $fileerror = $file['error'];
    $filetmp = $file['tmp_name'];
    $filestore = explode('.',$filename);
    $filecheck = strtolower(end($filestore));
    $filecheckstore = array('jpg','png','jpeg');
    $destinationfile ='images/'.$filename;
    $destinationfilemove ='./images/'.$filename;
    move_uploaded_file($filetmp,$destinationfilemove);

    $sql =  mysqli_query($con,"INSERT INTO `coins` VALUES(NULL,'$coinname','$NetworkChain','$Symbol','$Description','$destinationfile','$price','$Marketcap','$Launchdate','$Website','$Twitter','$Telegram','$contract_address','$information','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."',0,0,0,0)");

    if($sql){
        $_SESSION['contact_msg']='<div class="alert alert-success">Your coin has been submitted for review <strong>Successfully</strong></div>';
    }else{
         $_SESSION['contact_msg']='<div class="alert alert-danger">Something went wrong</div>';
    }
    header("location:add-token.php");

}

?>