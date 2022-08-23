<?php
include('admin/config.php');

if(isset($_POST['action'])){
    $CheckVote=mysqli_query($con,"SELECT id FROM `event-votes` WHERE user_id='".$_SERVER['REMOTE_ADDR']."' AND event_id=".$_POST['id']);
    if(mysqli_num_rows($CheckVote)==0){
        if($_POST['action']=='like'){
            $INSERT=mysqli_query($con,"INSERT INTO `event-votes` VALUES(NULL,'".$_SERVER['REMOTE_ADDR']."',".$_POST['id'].",1,0,'".date('Y-m-d H:i:s')."')");
        }else{
            $INSERT=mysqli_query($con,"INSERT INTO `event-votes` VALUES(NULL,'".$_SERVER['REMOTE_ADDR']."',".$_POST['id'].",0,1,'".date('Y-m-d H:i:s')."')");
        }
    }
    
    foreach(mysqli_query($con,"SELECT SUM(likes) as `Count` FROM `event-votes` WHERE likes=1 AND event_id=".$_POST['id']) as $Likes);
    foreach(mysqli_query($con,"SELECT SUM(dislike) as `Count` FROM `event-votes` WHERE dislike=1 AND event_id=".$_POST['id']) as $DisLikes);
    $Total=$Likes['Count']+$DisLikes['Count'];
    if($Total>0){
        $percentage=($Likes['Count']/$Total)*100;
    }else{
        $percentage=0;
    }
    echo $Total.'|'.$percentage;
    exit;
}
require 'vendor/autoload.php';



use Carbon\Carbon;

$sql_text = mysqli_query($con, "SELECT * FROM `website` where role='header'");
$row_text = mysqli_fetch_assoc($sql_text);
include 'header.php';

?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./assets/css/daterangepicker.css" />
<script type="text/javascript" src="./assets/js/daterangepicker.js"></script>
<link rel="stylesheet" href="./assets/css/jquery.paginate.css" />

<section class="container my-5">

      <div class="col-lg-6 justify-content-center d-flex">

    </div>      


</section>

<form method="GET">
    <input type="hidden" name="event" value="<?php echo $_GET['event'];?>">
    <?php
    if(isset($_GET['search'])){
        $dates=explode('-',$_GET['dates']);
        $FIlter=" AND lunchdate BETWEEN DATE('".date('Y-m-d',strtotime($dates[0]))."') AND DATE('".date('Y-m-d',strtotime($dates[1]))."')";
        if(!empty($_GET['keyword'])){
            $FIlter.=" AND title LIKE '".$_GET['keyword']."%'";
        }
        if(!empty($_GET['category'])){
            $FIlter.=" AND category='".$_GET['category']."'";
        }
        if(!empty($_GET['sort'])){
            if($_GET['sort']=='date'){
                $FIlter.=" ORDER BY lunchdate ASC";     
            }else if($_GET['sort']=='added-date'){
                $FIlter.=" ORDER BY date ASC";  
            }else if($_GET['sort']=='hot'){
                $FIlter.=" ORDER BY hot DESC";  
            }
        }
    }
    ?>
  <div class="">
    <div class="row mx-0 justify-content-center">
    
      <div class="col-12 d-flex justify-content-center align-items-center py-3">
        <a href="?event=upcoming-event" class="<?php echo ($_GET['event']=='upcoming-event')?"text-primary":"text-dark";?> px-3"> Upcoming Events</a>
        <a href="?event=past-event" class="<?php echo ($_GET['event']=='past-event')?"text-primary":"text-dark";?> px-3">Past Events</a>
      </div>
      <div class="col-lg-2 col-12">
        <div class="ws-inp">
            <?php
            if(isset($_GET['event']) and !empty($_GET['event'])){
                if($_GET['event']=='past-event'){
                    $_GET['dates']=date('Y/m/d',strtotime(date().'-24month')).' - '.date('Y/m/d');
                }else{
                    $_GET['dates']=date('Y/m/d').' - '.date('Y/m/d',strtotime(date().'+24month'));
                } 
            }else{
                 $_GET['dates']=date('Y/m/d').' - '.date('Y/m/d',strtotime(date().'+24month'));
            }
            ?>
          <input type="text" name="dates" value="<?php echo $_GET['dates'];?>">
        </div>
      </div>
      <div class="col-lg-2 col-12">
        <div class="ws-inp">
          <input type="text" placeholder="Keywords" name="keyword" value="<?php echo $_GET['keyword'];?>">
        </div>
      </div>
      <div class="col-lg-2 col-12">
        <div class="ws-inp">
          <select name="category">
                <option>Select Category</option>
                <option value="NFT" <?php if($_GET['category']=='NFT'){ echo 'selected';}?>>NFT</option>
                <option value="Team Update" <?php if($_GET['category']=='Team Update'){ echo 'selected';}?>>Team Update</option>
                <option value="Airdrop/Snapshot" <?php if($_GET['category']=='Airdrop/Snapshot'){ echo 'selected';}?>>Airdrop/Snapshot</option>
                <option value="AMA" <?php if($_GET['category']=='AMA'){ echo 'selected';}?>>AMA</option>
                <option value="Partnership" <?php if($_GET['category']=='Partnership'){ echo 'selected';}?>>Partnership</option>
                <option value="Other" <?php if($_GET['category']=='Other'){ echo 'selected';}?>>Other</option>
                <option value="Whitepaper U" <?php if($_GET['category']=='Whitepaper U'){ echo 'selected';}?>>Whitepaper U</option>
                <option value="Branding"<?php if($_GET['category']=='Branding'){ echo 'selected';}?>>Branding</option>
                <option value="Meetup" <?php if($_GET['category']=='Meetup'){ echo 'selected';}?>>Meetup</option>
                <option value="Conference" <?php if($_GET['category']=='Conference'){ echo 'selected';}?>>Conference</option>
                <option value="Exchange" <?php if($_GET['category']=='Exchange'){ echo 'selected';}?>>Exchange</option>
                <option value="Release" <?php if($_GET['category']=='Release'){ echo 'selected';}?>>Release</option>
                <option value="Integration" <?php if($_GET['category']=='Integration'){ echo 'selected';}?>>Integration</option>
                <option value="Staking/Farming" <?php if($_GET['category']=='Staking/Farming'){ echo 'selected';}?>>Staking/Farming</option>
                <option value="Roadmap Update" <?php if($_GET['category']=='Roadmap Update'){ echo 'selected';}?>>Roadmap Update</option>
                <option value="Tokenomics" <?php if($_GET['category']=='Tokenomics'){ echo 'selected';}?>>Tokenomics</option>
          </select>
        </div>
      </div>
     
      <div class="col-lg-2 col-12">
        <div class="ws-inp">
          <select name="sort">
            <option value="" selected>Sort By</option>
            <option value="date" <?php if($_GET['sort']=='date'){ echo 'selected';}?>>Date</option>
            <option value="added-date"<?php if($_GET['sort']=='added-date'){ echo 'selected';}?>>Added Date</option>
            <option value="hot" <?php if($_GET['sort']=='hot'){ echo 'selected';}?>>Hot</option>
          </select>
        </div>
      </div>
      <!--<div class="col-lg-2 col-12">
        <div class="ws-inp">
          <select name="" id="">
            <option value="" selected>Show Only</option>
          </select>
        </div>
      </div>-->
      <div class="col-lg-1 col-12">
        <button class="b1 w-100 d-flex" name="search"> <i class="fa fa-search "></i></button>
      </div>
      <?php
       if(isset($_GET['search'])){
      ?>
      <div class="col-lg-1 col-12">
        <a href="events.php" class="ws-inp d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; ">
          <i class="fa fa-times text-primary fs-5"></i></a>
      </div>
      <?php } ?>
    </div>
  </div>
  </div>
</form>



<section>
  <div class="container-fluid my-5">
    <div class="row mx-0 "id="paginate">
        <?php
        //echo $FIlter;
        if(!isset($FIlter)){
            $FIlter=" AND DATE(lunchdate)>='".date('Y-m-d')."'";
            if(isset($_GET['event']) and !empty($_GET['event'])){
                if($_GET['event']=='upcoming-event'){
                    $FIlter=" AND DATE(lunchdate)>='".date('Y-m-d')."'";
                }else{
                    $FIlter=" AND DATE(lunchdate)<='".date('Y-m-d')."'";
                } 
            }
        }
        $GETevents=mysqli_query($con,"SELECT * FROM `event` WHERE adminstatus=1 ".$FIlter);
        foreach($GETevents as $event){
            foreach(mysqli_query($con,"SELECT * FROM `coins` WHERE id=".$event['coinid']) as $Coin);
        ?>
        <!--Single item start-->
        <div class=" col-lg-3 p-3 col-12">
          <div class="ws-card-2 py-4 pb-3 d-flex flex-column align-items-center">
            <div class="d-flex w-100 align-items-center justify-content-center">
                <div>
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
                
                
            </div>

            <img src="./<?php echo $Coin['Logo']?>" style="width: 40px; height: 40px;" class="my-3">
            <small class="d-block"><?php echo $event['category'];?></small>
            <span class="fs-7 fw-500 text-primary pb-2"><?php echo date('d M Y',strtotime($event['lunchdate']));?></span>
            <a href="detail.php?id=<?php echo $event['id']?>&&symbol=<?php echo $Coin['Symbol']?>" class="fs-6 fw-500 text-primary  text-uppercase text-center" style="height: 32px ; overflow: hidden; text-decoration:underline;" ><?php echo $Coin['coinname'].' ('.$Coin['Symbol'].')';?></a>
            
            <span class="fs-7 fw-400 text-center px-3" style="height:80px; overflow:hidden; position:relative; "><?php echo $event['description'];?><span class="px-3" style="position:absolute; bottom: -3px; right: 1px;  ">...</span>  </span>
  
            <div class="d-flex align-items-center pt-4 w-75">
              <button onclick="showImage('<?php echo $event['proof'];?>')" class="btn btn-outline-primary col me-2">Proof</button>
              <a href="<?php echo $event['twitter'];?>" target="_blank" class="btn btn-outline-primary col ms-2">Source</a>
              
            </div>
            
            <div class="px-3 w-100">
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
                <div class="progress-div  w-100  mt-3">
                  <div class="marker" id="marker_<?php echo $event['id'];?>" style="position:relative; left: calc(<?php echo $percentage;?>% - 16px);">
                    <img src="assets/images/marker.png" alt="">
                    <span id="display_<?php echo $event['id'];?>"><?php echo $percentage;?>%</span>
                  </div>
                  <div class="progress">
                    <span id="progress_<?php echo $event['id'];?>" style="width:<?php echo $percentage;?>%;" ></span>
                  </div>
                </div>
            </div>
            <span class="fs-7 fw-500 pt-2 vtdiv" id="total_vote_<?php echo $event['id'];?>" ><?php echo $Total;?> Votes</span>
            
            <div class="d-flex w-100 mt-2 p-3" id="action_<?php echo $event['id'];?>">
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
            
            <span class="fs-8 fw-500 pt-2 ">Added <?php echo date('d M Y',strtotime($event['date']));?></span>
            <span class="fs-8 fw-500 pt-2 ">Follow <a class="text-primary" href="<?php echo $event['twitter'];?>"> @<?php echo $event['twitter'];?></a></span>
          </div>
        </div>
        <!--Single item end-->
        <?php
        }
        ?>
    </div>
  </div>
</section>
<div class="col-12">
<h2 class="text-center">Coin Upcoming Events in 2022</h2>
<p class="text-center">Get info on the latest crypto coin upcoming events in 2022 with Thetoken Sniper. Thetoken Sniper is the leading site for folks looking to get the latest info about the upcoming cryptocurrency events in 2022. <br>With Thetoken Sniper, you can say goodbye to scourging hundreds of cryptocurrency news sites as you can find all the latest info about the new upcoming cryptocurrency events directly at Thetoken Sniper. <br>And if you are looking to organize a cryptocurrency event of your own, you can reach out to us at Thetoken Sniper, and we will list your event directly on the site without much hassle. <br>Now, stay tuned to get updated on new upcoming events in 2022. We want you to be the first to know about it.</p>
</div>
<!-- ads slider -->
<div class="container my-5">
  <div class="slider-parent hide-on-search py-2">
    <div class="ads-class">
      <?php
            $sql = mysqli_query($con, "SELECT * FROM `slider` ");
            foreach ($sql as $key => $value) {
                $src = explode('../', $value['image'])[1];
                echo '<a href="promotion.php?src=' . $src . '&link=' . $value['link'] . '"  class="slice-ad-items-1" ><img src="' . $src . '" alt=""></a>';
            }
            ?>
    </div>
  </div>
</div>
<!-- <button class="btn-1 col mx-3" style="border-radius:10px;" onclick="voteit(this)" id="promote-' . $result['id'] . '"> <i class="fa fa-thumbs-up mx-1"></i> Vote </button> -->

<!-- <div class="d-flex w-100 align-items-center justify-content-center my-5">
  <div class="arrows mx-2">
    <i class="fa fa-angle-left "></i>
  </div>
  <div class="pagination">
    <a href="">1</a>
    <a href="">2</a>
    <a href="">3</a>
    <a href="">4</a>
    <a href="">5</a>
    <a href="" class="active">6</a>
    <a href="">7</a>
    <a href="">8</a>
    <a href="">9</a>
    <a href="">12</a>
  </div>
  <div class="arrows mx-2">
    <i class="fa fa-angle-right "></i>
  </div>
</div> -->

<!-- <section>
  <div class="container my-5">
    <div class="row">
      <div class="col-lg-4 col-12 p-3">
        <div class="card">
          <img src="assets/images/c1.png" class="card-img-top" loading="lazy">
          <div class="card-body">
            <p class="card-text fs-7 fw-500 mb-2">15 Jan 2022</p>
            <h5 class="card-title fw-500">Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr.</h5>
            <p class="card-text fs-7 fw-500">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
              eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
              accusam et</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-12 p-3">
        <div class="card">
          <img src="assets/images/c2.png" class="card-img-top" loading="lazy">
          <div class="card-body">
            <p class="card-text fs-7 fw-500 mb-2">15 Jan 2022</p>
            <h5 class="card-title fw-500">Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr.</h5>
            <p class="card-text fs-7 fw-500">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
              eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
              accusam et</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-12 p-3">
        <div class="card">
          <img src="assets/images/c3.png" class="card-img-top" loading="lazy">
          <div class="card-body">
            <p class="card-text fs-7 fw-500 mb-2">15 Jan 2022</p>
            <h5 class="card-title fw-500">Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr.</h5>
            <p class="card-text fs-7 fw-500">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
              eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
              accusam et</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
<div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content ">
			<div class="modal-body">
				<img class="img-fluid" id="proofImage">
			</div>
		</div>
	</div>
</div>
<script src="scripts.js"></script>
<script>
	$('#paginate').paginate({perPage:12});
</script>
<script>
$('input[name="dates"]').daterangepicker({ 
    locale: {
      format: 'Y/M/D'
    }
});
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
            $('#marker_'+id).css('left','calc('+data[1]+'% - 16px)');
            $('#display_'+id).text(data[1]+'%');
            $('#progress_'+id).css('width',data[1]+'%');
            $('#total_vote_'+id).text('Vote '+data[0]);
            $('#action_'+id).html('<span class=" mx-auto">Thanks for your help!</span>');
        }
        
    })
}
  
</script>
<script src="assets/js/votes.js?v=<?php echo time(); ?>"></script>
<?php include('footer.php'); ?>
