<?php

if (!isset($_SESSION)) {
    session_start();
}
$id = $_GET['id'];


include('admin/config.php');
require 'vendor/autoload.php';

use Carbon\Carbon;



include('header.php');


?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./assets/css/daterangepicker.css" />
<script type="text/javascript" src="./assets/js/daterangepicker.js"></script>
<link rel="stylesheet" href="./assets/css/jquery.paginate.css" />

<section class="container my-5"style="padding-bottom:80px">

      <div class="col-lg-12  justify-content-center d-flex">

    </div>  
	
	


</section>

/<?php
$news=mysqli_query($con, "SELECT * FROM autoBlog wHERE id='$id'");
foreach($news as $fullnew){
	
    
?>


<div class="row">
	<div class="col-lg-12 text-center" style="margin-bottom:80px;margin-top:150px">
		<h1 style="color:blue"><?php echo  $fullnew['title']?></h1>
		<p style="padding-top:20px;color:blue"><?php echo  $fullnew['pubDate'];?></p>
		
</div>
	<div class="col-lg-12 text-center" style="padding-left:7%;padding-right:7%">
		<p><?php echo  $fullnew['fullcontent'];?></p>
	</div>


</div>

<?php
}
	?>




<?php include 'footer.php'; ?>