<?php
if (!isset($_SESSION)) {
    session_start();
}
include('header.php');
include('admin/config.php');

?>

<div class="container">
    <a href="index.php" class="back"><i class="fa fa-angle-left"></i> </a>
    <div class="row mx-0 justify-content-center px-2 mt-5 pt-5 py-5 ">
        <div  class="col-lg-7 mt-5 col-12" >
			<a href="<?php echo $_GET['link']; ?>">
            	<img src="<?php echo $_GET['src']; ?>" class="w-100" alt="">
			</a>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>