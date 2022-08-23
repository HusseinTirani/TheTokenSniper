<?php
require('admin/config.php');
session_start();
if(isset($_POST['submit'])){
    $coinname = $_POST['coinid'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $lunchdate = $_POST['lunchdate'];
    $description = $_POST['description'];
    $sourcelink = $_POST['sourcelink'];
    $symbol = $_POST['symbol'];
    $address = $_POST['address'];
    $twitter = $_POST['twitter'];
    $date=date("Y-m-d");

    if(isset($_FILES['proof']) and $_FILES['proof']['error'] == 0){
		$allowed = array('jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'png' => 'image/png');
		$filename = $_FILES['proof']['name'];
		$filetype = $_FILES['proof']['type'];
		if(in_array($filetype, $allowed)){
		    $destinationfile ='images/events/'.$filename;
			move_uploaded_file($_FILES['proof']['tmp_name'],$destinationfile);
		}
	}

    $sql =  "INSERT INTO `event` VALUES (NULL,'$coinname','$title','$category','$lunchdate','$description','$sourcelink','$destinationfile','$symbol','$address ','$twitter',0,0,0,0,'$date')";

     if(mysqli_query($con,$sql)){
         header('location:add-events.php');
		  $_SESSION['contact_msg']='<div class="alert alert-success">Your new event has been submitted for review   <strong>Successfully</strong></div>';
      }
      else{
          echo "coin added denied";
      }
}
else{
    header('location:add-events.php');
}

?>