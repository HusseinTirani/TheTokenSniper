<?php


if (!isset($_SESSION)) {
    session_start();
}

include('admin/config.php');
require 'vendor/autoload.php';

use Carbon\Carbon;


if(!isset($_GET['coin_id'])){
    if(!empty($_SERVER['HTTP_REFERER'])){
        header('location:'.$_SERVER['HTTP_REFERER']);
    }else{
        header('location:index.php');
    }
}
include('header.php');
?>


<div class="container mt-5 pt-5">
    <div class="row mx-0 py-5 justify-content-center">
        <div class="wrapper-1 col-lg-12 col-11">
            <?php
            $GETcoinInfo=mysqli_query($con,"SELECT * FROM `coins` WHERE id=".$_GET['coin_id']);
            foreach($GETcoinInfo as $CoinInfo);
            $CountVotes=mysqli_query($con,"SELECT id FROM `votes` WHERE coin_id=".$CoinInfo['id']);
            $CountVOtesToday=mysqli_query($con,"SELECT id FROM `votes` WHERE coin_id=".$CoinInfo['id']." AND DATE_FORMAT(created_at,'%Y-%m-%d')='".date('Y-m-d')."'");
            ?>
            <div class="row mx-0">
                <div class="col-lg-8 px-0">
                    <div class="ci-head flex-lg-row flex-column">
                        <img src="<?php echo $CoinInfo['Logo'];?>" class="logo" alt="">
                        <div class="ps-3 pt-lg-0 pt-3">
                            <div class="d-flex align-items-center justify-content-lg-start justify-content-center">
                                <h2 class="mb-0"><?php echo ucfirst($CoinInfo['coinname']);?></h2>
                            </div>
                            <div class="pt-2 d-flex align-items-center">
                                <span class="sym-badge text-dark"><?php echo strtoupper($CoinInfo['Symbol']);?></span>
                                <span class="sym-badge text-dark sym-badge-outline"><small>Votes</small><?php echo mysqli_num_rows($CountVotes);?></span>
                                <span class="sym-badge text-dark sym-badge-outline"><small>Today</small><?php echo mysqli_num_rows($CountVOtesToday);?></span>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning">
                        <strong class="d-block"><?php echo strtoupper($CoinInfo['chain']);?>Contract Address</strong>
                        <div class="d-flex">
                            <span class="d-block" style="overflow:hidden">
                                <span><?php echo $CoinInfo['contract_address'];?></span>
                                <input class="d-none" id="walletAddress" value="<?php echo $CoinInfo['contract_address'];?>">
                            </span>
                            <button class="btn btn-sm" onclick="copyToClipboard(this)" title="Copy to clipboard">
                                <i class="btn fa fa-copy px-2"></i>    
                            </button>
                            
                        </div>
                        
                    </div>
                    <div class="badge-div mt-2">
                        <div>
                            <small>Marketcap</small>
                            <span>$<?php echo $CoinInfo['Marketcap'];?></span>
                        </div>
                        <div>
                            <small>Price</small>
                            <span>$<?php echo $CoinInfo['Price'];?></span>
                        </div>
                        <div>
                            <small>Launch</small>
                            <span><?php echo date('d M Y',strtotime($CoinInfo['Launchdate']));?></span>
                        </div>
                    </div>
                    <div>
                        <?php echo $CoinInfo['Description'];?>    
                    </div>
                    <?php
                        $CheckVote=mysqli_query($con,"SELECT id FROM `votes` WHERE user_id='".$_SERVER['REMOTE_ADDR']."' AND DATE_FORMAT(created_at,'%Y-%m-%d')='".date('Y-m-d')."' AND coin_id=".$CoinInfo['id']);
                        if(mysqli_num_rows($CheckVote)==0){
                        ?>
                        <span onclick="voteit(this)" class="info-vote " id="promote-72">
                            <button onclick="vote(this,'<?php echo $CoinInfo['id'];?>')" class="btn btn-outline-primary btn-over-off w-100"><i class="fa fa-rocket"></i> Vote</button>
                        </span> 
                        <small class="mt-2 text-center col-12"><i class="tex-center w-100">You can vote once every 24 hours.</i></small>
                        <?php 
                        } else{
                        ?>
                        <small class="mt-2 text-center col-12"><i class="tex-center w-100">You can vote once every 24 hours.</i></small>
                        <?php 
                        }
                    ?>
                    

                </div>
                <div class="col-lg-4 ps-lg-5 ps-0">
                    <div class="row mx-0">
                        
                        <div class="col px-0 d-flex flex-column">
                            <h5>Information</h5>
                            <div>
                                <?php echo $CoinInfo['informations'];?>    
                            </div>
                            <a target="_blank" href="<?php echo $CoinInfo['Website'];?>" class="btn btn-outline-primary mt-2"><span>Visit Website</span></a>
                            <a target="_blank" href="<?php echo $CoinInfo['telegram'];?>" class="btn btn-outline-primary mt-2"><span>Join Telegram</span></a>
                            <a target="_blank" href="<?php echo $CoinInfo['Twitter'];?>" class="btn btn-outline-primary mt-2"> <span>Follow Twitter</span></a>
                        </div>
                    </div>


                </div>
               
            </div>
        </div>
    </div>
</div>


<script>
function vote(obj,id){
    $.ajax({
        type:'post',
        url:'index.php',
        data:{
            'voteid':id
        },success:function(response){
            if(response!=null){
                $('#votes_'+id).text(response);
                $(obj).find('i').attr('class','fas fa-heart');
            }
        }
        
    })
}
</script>
<script>
    function copyToClipboard(obj) {
      var copyText = document.getElementById("walletAddress");
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */
      navigator.clipboard.writeText(copyText.value);
      $(obj).html('Copied');
      setTimeout(function(){
          $(obj).html('<i class="btn fa fa-copy px-2"></i>');
      },1500);
    }
</script>
<script>
    $('.ads-class').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        prevArrow: false,
        nextArrow: false,
        responsive: [{
                breakpoint: 700,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
</script>
<?php
include('footer.php');
?>