<?php

if (!isset($_GET['id'])) {
    header('location:events.php');
}

include 'header.php';
include('admin/config.php');
require 'vendor/autoload.php';
use Carbon\Carbon;

$id = $_GET['id'];
foreach(mysqli_query($con, "SELECT * FROM `event` WHERE id='$id'") as $event);
foreach(mysqli_query($con,"SELECT * FROM `coins` WHERE id=".$event['coinid']) as $Coin);
?>
<div class="" style="padding-top: 200px;">
    <div class="container">
        <div class="row mx-0">
            <div class="col-lg-8 col-12 d-flex flex-column">
                <img src="./<?php echo $Coin['Logo'];?>" style="width: 50px; border-radius:10px;" alt="">
                <div class="d-flex pt-3 align-items-center">
                    <span class="fs-3  fw-600  text-primary" style="margin-right:10px;"><?php echo date('d M Y',strtotime($event['lunchdate']));?></span>
                    <?php if($event['adminstatus']==1){?>
                        <i class="fa fa-check-circle" style="color:#60c01e; margin-right:5px;" title="Confirmed by official representatives"></i>
                    <?php } ?>
                    <?php if($event['siginificant']==1){?>
                        <i class="fa fa-crown" style="color:#fbc70b; margin-right:5px;" title="Significant"></i>
                    <?php } ?>
                    <?php if($event['hot']==1){?>
                        <i class="fa fa-fire" style="color:#ff9725; margin-right:5px;" title="Hot"></i>
                    <?php } ?>
                    <?php if($event['trending']==1){?>
                        <i class="fa fa-level-up" style="color:#e4382b; margin-right:5px;" title="Trending"></i>
                    <?php } ?>
                </div>
                <span class="fs-1  fw-700  "><?php echo $event['title'];?></span>
                <p class="pt-3"><?php echo $event['description'];?></p>
                <div class="d-flex align-items-center pt-4 w-75">
                  <button onclick="showImage('<?php echo $event['proof'];?>')" class="btn btn-outline-primary col me-2">Proof</button>
                  <a href="<?php echo $event['sourcelink'];?>" target="_blank" class="btn btn-outline-primary col ms-2">Source</a>
                </div>
            </div>
            <div class="col-lg-4 col-12 py-3">
                <div class="wrapper-1 d-flex flex-column">
                    <?php
                    foreach(mysqli_query($con,"SELECT SUM(likes) as `Count` FROM `event-votes` WHERE likes=1 AND event_id=".$event['id']) as $Likes);
                    foreach(mysqli_query($con,"SELECT SUM(dislike) as `Count` FROM `event-votes` WHERE dislike=1 AND event_id=".$event['id']) as $DisLikes);
                    $Total=$Likes['Count']+$DisLikes['Count'];
                    if($Total>0){
                        $percentage=($Likes['Count']/$Total)*100;
                    }else{
                        $percentage=0;
                    }
                    ?>
                    <div class="d-flex ">
                        <div class="ws-box-1 col me-2 active p-3 d-flex flex-column">
                            <span style="color: white;">Confidence</span>
                            <span class="fs-2 fw-600 text-center" style="color: white;" id="votePercentage"><?php echo $percentage;?>%</span>
                        </div>
                        <div class="ws-box-1 col ms-2  p-3 d-flex flex-column">
                            <span class="text-light-blue">Votes</span>
                            <span class="fs-2 fw-600 text-center text-light-blue" id="voteCount"><?php echo $Total;?></span>
                        </div>
                    </div>
                    <div class="d-flex w-100 mt-2 pt-3" id="action">
                        <?php
                        $CheckVote=mysqli_query($con,"SELECT id FROM `event-votes` WHERE user_id='".$_SERVER['REMOTE_ADDR']."' AND event_id=".$event['id']);
                        if(mysqli_num_rows($CheckVote)==0){
                           ?>
                            <button class="btn-1 col me-2" onclick="vote('like','<?php echo $event['id'];?>')">  <i class="fa fa-thumbs-up mx-1"></i> Like </button>
                            <button class="btn-1 col ms-2" onclick="vote('dislike','<?php echo $event['id'];?>')">  <i class="fa fa-thumbs-down mx-1"></i> Dislike </button>
                            <?php
                        }else{
                            ?>
                            <span class=" mx-auto">Thanks for your help!</span>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="wrapper-1 d-flex flex-column mt-4 ">
                    <span class="fw-500">Added <?php echo date('d M Y',strtotime($event['date']));?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--

<section class="mt-5 pt-5">
    <div class="container mt-5">
        <div class=" flex-wrap central-box py-3 d-flex flex-lg-row flex-column align-items-center justify-content-between">
            <div class=" col-box  d-flex flex-column align-items-center ">
                <img src="<?php echo $row['Logo']; ?>" class="bitcoin mt-3 " alt="">
                <span class="fs-5 fw-500 my-2"><?php echo $row['coinname']; ?> (<?php echo $row['Symbol']; ?>) </span>
            </div>
            <div class="col-box fw-600 d-flex flex-column align-items-center">launch Date
                <span class=" fw-500 small-heading mt-2"><?php echo $row['Launchdate']; ?></span>
            </div>

            <div class="col-box fw-600 d-flex flex-column align-items-center mt-2">Total Votes
                <span class=" fw-500 small-heading mt-2" ><?php echo $row['votes']; ?></span>
            </div>
            <div class="col-12 p-lg-5 p-4">
                <?php echo $row['Description']; ?>
                <?php echo $row['informations']; ?>
                <div class="d-flex align-items-center my-5 ">
                    <a href="<?php echo $row['Website']; ?>" class="text-dark d-flex align-items-center "><i class="fas fa-globe fs-4 mx-3 text-primary"></i>Website</a>
                    <a href="<?php echo $row['Twitter']; ?>" class="text-dark d-flex align-items-center "><i class="fab fa-twitter text-primary mx-3 fs-4"> </i>Twitter</a>
                    <a href="<?php echo $row['whitepaper']; ?>" class="text-dark d-flex align-items-center "><i class="fas fa-newspaper text-primary mx-3 fs-3"></i>Whitepaper</a>
                    <a href="<?php echo $row['buy']; ?>" class="text-dark d-flex align-items-center "><i class="fas fa-shopping-cart text-primary mx-3 fs-4"></i>Buy</a>
                </div>
            </div>
            <div class="col-12 d-flex mb-4  justify-content-center">
                <div class="col-lg-3 px-2 col-6">
                    <button class="btn-1 w-100" style="border-radius: 10px;"> <i class="fa fa-thumbs-up mx-1"></i> Like </button>
                </div>
                <div class="col-lg-3 px-2 col-6">
                    <button class="btn-1 w-100" style="border-radius: 10px;"> <i class="fa fa-thumbs-down mx-1"></i> Dislike </button>
                </div>
                <button class="btn-1 col-lg-3 col-12 mx-3" style="border-radius:10px;" onclick="voteit(this)" id="promote-<?php echo $row['id']; ?>"> <i class="fa fa-thumbs-up mx-1"></i> Vote </button>
            </div>
        </div>
    </div>
</section>
-->
<div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content ">
			<div class="modal-body">
				<img class="img-fluid" id="proofImage">
			</div>
		</div>
	</div>
</div>
<script>
function showImage(image){
    $('#proofModal').find('img').attr('src',image);
    $('#proofModal').modal('show');
}
function vote(action,id){
    $.ajax({
        type:'post',
        url:'events.php',
        data:{
            'action':action,
            'id':id
        },success:function(response){
            var data=response.split('|');
            $('#votePercentage').text(data[1]+'%');
            $('#voteCount').text(data[0]);
            $('#action').html('<span class=" mx-auto">Thanks for your help!</span>');
        }
        
    })
}
</script>

<script src="assets/js/votes.js?v=<?php echo time(); ?>"></script>
<?php include('footer.php'); ?>
