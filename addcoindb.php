<?php
require('admin/config.php');
session_start();
if(isset($_POST['coinname']) && isset($_SESSION['user_info'])){


    $coinname = $_POST['coinname'];
    $Symbol = $_POST['Symbol'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];
    $Marketcap = $_POST['Marketcap'];
    $Launchdate = $_POST['Launchdate'];
    $BinanceSmartChain = $_POST['BinanceSmartChain'];
    $Ethereum = $_POST['Ethereum'];
    $Solana = $_POST['Solana'];
    $Polygon = $_POST['Polygon'];
    $Website = $_POST['Website'];
    $Telegram = $_POST['Telegram'];
    $Twitter = $_POST['Twitter'];
    $informations = $_POST['informations'];
    $created_by  = $_SESSION['user_info']['id'];

    $file= $_FILES['Logo'];	
    $filename = $file['name'];
    $fileerror = $file['error'];
    $filetmp = $file['tmp_name'];
    $filestore = explode('.',$filename);
    $filecheck = strtolower(end($filestore));
    $filecheckstore = array('jpg','png','jpeg');
    $destinationfile ='images/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);


    $sql =  "INSERT INTO `coins`( `coinname`, `Symbol`, `Description`, `Logo`, `Price`, `Marketcap`, `Launchdate`, `BinanceSmartChain`, `Ethereum`, `Solana`,`Polygon`, `Website`, `Telegram`, `Twitter`, `informations`,`created_by`)
     VALUES ('$coinname','$Symbol','$Description','$destinationfile','$Price','$Marketcap','$Launchdate','$BinanceSmartChain','$Ethereum','$Solana','$Polygon','$Website','$Telegram','$Twitter','$informations','$created_by ')";

     if(mysqli_query($con,$sql)){
         header('location:index.php');
      }
      else{
          echo "coin added denied";
      }
}
else{
    header('location:login.php');
}

?>