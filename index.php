<?php
include('admin/config.php');
session_start();
if(isset($_POST['NumberOfPages'])){
    $_SESSION['NumPage']=$_POST['NumberOfPages'];
}
if(isset($_POST['voteid'])){
	
    $CheckVote=mysqli_query($con,"SELECT id FROM `votes` WHERE user_id='".$_SERVER['REMOTE_ADDR']."' AND DATE_FORMAT(created_at,'%Y-%m-%d')='".date('Y-m-d')."' AND coin_id=".$_POST['voteid']);
    if(mysqli_num_rows($CheckVote)==0){
        $INSERT=mysqli_query($con,"INSERT INTO `votes` VALUES(NULL,'".$_SERVER['REMOTE_ADDR']."',".$_POST['voteid'].",'".date('Y-m-d H:i:s')."')");
		
        if($INSERT){
            mysqli_query($con,"UPDATE `coins` SET votes=votes+1 WHERE id=".$_POST['voteid']);
        }
    }
    $countVotes=mysqli_query($con,"SELECT id FROM `votes` WHERE coin_id=".$_POST['voteid']);
    echo mysqli_num_rows($countVotes);
    exit;
}

require 'vendor/autoload.php';

use Carbon\Carbon;

$sql_text = mysqli_query($con, "SELECT * FROM `website` where role='header'");
$row_text = mysqli_fetch_assoc($sql_text);
include 'header.php';
?>
<link rel="stylesheet" href="./assets/css/jquery.paginate.css" />
<script src="lazysizes.min.js" async></script>
<?php 
include('admin/config.php');
session_start();
$coins = mysqli_query($con, "SELECT * from coins WHERE adminapproval=1");
foreach($coins as $coinlink){
	$link= "https://www.thetokensniper.com/coininfo.php?coin_id=".$coinlink['id']."&amp;&amp;Symbol=".$coinlink['Symbol'];
	$check = mysqli_query($con, "SELECT * from sitemap where subject='$link'");
	if(mysqli_num_rows($check)==0){
		$subject = $link;
		$created= $coinlink['created_at'];
		$insert = mysqli_query($con, "INSERT INTO sitemap VALUES (NULL,'$subject','$created','0.8')");
		
	}
}
$events = mysqli_query($con, "SELECT * from event WHERE adminstatus=1 ");
foreach($events as $eventlink){
	$symbol = $eventlink['coinid'];
	$symbolValue = mysqli_query($con, "SELECT * from coins where id='$symbol'");
	foreach($symbolValue as $finalSymbol){
		$eventLink="https://www.thetokensniper.com/detail.php?id=".$eventlink['id']."&amp;&amp;symbol=".$finalSymbol['Symbol'];
		$checkevent = mysqli_query($con, "SELECT * from sitemap where subject='$eventLink'");
		if(mysqli_num_rows($checkevent)==0){
		$subject = $eventLink;
		$created = $finalSymbol['created_at'];
		$insert = mysqli_query($con, "INSERT INTO sitemap VALUES (NULL,'$subject','$created','0.64')");
			
		}
	}
	
}
$blog = mysqli_query($con, "SELECT * from autoBlog");
foreach($blog as $bloglink){
	$linkblog= "https://www.thetokensniper.com/blog.php?id=".$bloglink['id'];
	$checkblog = mysqli_query($con, "SELECT * from sitemap where subject='$linkblog'");
	if(mysqli_num_rows($checkblog)==0){
		$subject = $linkblog;
		$created = date('Y-m-d H:i:s');
		$insert = mysqli_query($con, "INSERT INTO sitemap VALUES (NULL,'$subject','$created','0.64')");
		
	}
}



$xml = new DomDocument('1.0','UTF-8');
$xml->formatOutput=true;
$urlset = $xml->createElement("urlset");
$urlset->setAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");
$urlset->setAttribute("xmlns:xsi","http://www.w3.org/2001/XMLSchema-instance");
$urlset->setAttribute("xsi:schemaLocation","http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");
$xml->appendChild($urlset);
$sitemap=mysqli_query($con, "SELECT * FROM sitemap");
foreach($sitemap as $map){
	
$url = $xml->createElement("url");
$urlset->appendChild($url);
	

$loc=$xml->createElement("loc",$map['subject']);
$url->appendChild($loc);
$date = str_replace('/', '-', $map['created']);
$lastmod=$xml->createElement("lastmod",date("Y-m-d", strtotime($date)).'T'.date("H-i-s", strtotime($date)).'Z');
$url->appendChild($lastmod);
$priority=$xml->createElement("priority",$map['priority']);
$url->appendChild($priority);

}



$xml->save("sitemap.xml") or die("Error, Unable to create");


?>

  

<section class="main">

  <div class="container d-flex align-items-center justify-content-between">
    <div class="row mx-0">
      <div class="col-lg-6 d-flex flex-column align-items-start">
        <span class="side-heading">Token Sniper</span>
        <h1 class="main-heading fw-600" style="font-size: 40px ;">Cryptocurrency snipping plateform</h1>
        <p class="first-paragraph fs-6 fw-500">
          <?php echo $row_text['text']; ?>
        </p>
        <!-- <button class="b1 ">Read More</button> -->
      </div>
      <div class="col-lg-6 justify-content-center d-flex">
        <img src="assets/images/svg1.png " class="mobile-img lazyload" alt=""  />
		  
      </div>
    </div>
  </div>
</section>
<form action="search.php" method="GET">
  <div class="container mb-5 mt-5">
    <div class="row mx-0 p-4 justify-content-center  ws-card">
          <div class="col-lg-4 col-12 p-2">
            <div class="ws-inp">
              <input type="text" name="coin" placeholder="Enter coin name">
            </div>
          </div>
          <div class="col-lg-4 col-12 p-2">
            <div class="ws-inp">
              <input type="text" name="address" placeholder="Enter contract address">
            </div>
          </div>
          
          <div class="col-lg-2 col-12 p-2">
            <button class="b1 w-100 d-flex "> <i class="fa fa-search "></i> <span class="col">Search</span> </button>
          </div> 
       
    </div>
  </div>
</form>
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

<section>
  <div class="hide-on-search container ">
    <div class="d-flex">
      <h4 class="gradient-heading">TOP 100 CRYPTO</h4>
    </div>
    <div class="table-tray-ls  container py-4   px-0 nav nav-pills w-100" id="pills-tab" role="tablist">
		<button class="  me-lg-4 me-3 nav-link active " id="pills-alltime-tab" data-bs-toggle="pill" data-bs-target="#pills-alltime" type="button" role="tab" aria-controls="pills-alltime" aria-selected="true">
        All Time</button>
      <button class="  me-lg-4 me-3 nav-link " id="pills-today-tab" data-bs-toggle="pill" data-bs-target="#pills-today" type="button" role="tab" aria-controls="pills-today" aria-selected="true">
        Today</button>
      
      <button class="  me-lg-4 me-3 nav-link " id="pills-new-tab" data-bs-toggle="pill" data-bs-target="#pills-new" type="button" role="tab" aria-controls="pills-new" aria-selected="true">
        New </button>
      <button class="  me-lg-4 me-3 nav-link " id="pills-marketcap-tab" data-bs-toggle="pill" data-bs-target="#pills-marketcap" type="button" role="tab" aria-controls="pills-marketcap" aria-selected="true">
        Market Cap</button>
      <form method="post" class="btn btn-sm btn-light" style="margin-left:auto;">
          Number of Result
          <select class="border-0 bg-transparent" name="NumberOfPages" onchange="$(this).parent().submit()">
              <option value="10" <?php echo (intval($_SESSION['NumPage'])=='10')?'selected':'';?>>10</option>
              <option value="50" <?php echo (intval($_SESSION['NumPage'])=='50')?'selected':'';?>>50</option>
              <option value="100" <?php echo (intval($_SESSION['NumPage'])=='100')?'selected':'';?>>100</option>
          </select>
      </form>
    </div>

	
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show " id="pills-today" role="tabpanel" aria-labelledby="nav-today-tab">
        <div class="container mb-5 px-0">
          <div class="table-custom-head row mx-0 px-1 px-lg-3 text-nowrap">
            <div class=" col d-lg-flex align-items-center">
              # <span class="pl-1 pl-lg-5">Name</span>
            </div>
            <div class="justify-content-center col d-lg-flex d-none align-items-center justify-content-center">
              Chain
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Symbol
            </div>
            <div class=" col d-lg-flex align-items-center justify-content-center">
              Market cap <img src="assets/images/info.png" class="ps-1" alt="">
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Price
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Launch
            </div>
            <div class="justify-content-center col d-flex align-items-center justify-content-center">
              Votes
            </div>
            <div class="justify-content-center col d-flex align-items-center justify-content-center">
              Vote
            </div>
          </div>
          <div id="paginate_today">
            <?php
			 
            $index=1;
			  
            $GETcoins=mysqli_query($con,"SELECT * FROM coins INNER JOIN votes ON coins.id=coin_id WHERE DATE(votes.created_at)=CURRENT_DATE() and adminapproval= 1 ORDER By votes.created_at DESC");
            foreach($GETcoins as $Coins){
                ?>
                <div class="align-items-center table-custom-body row mx-0 px-1 px-lg-3 list">
                    <div class=" col d-flex align-items-center flex-row">
                      <span class="gradient-text"><?php echo $index++;?></span>
                      <a href="./coininfo.php?coin_id=<?php echo  $Coins['id'];?>&&Symbol=<?php echo  $Coins['Symbol'];?>" class="d-flex align-items-center flex-lg-row flex-column ">
                        <img src="<?php echo $Coins['Logo'];?>" class="mx-2 table-coin-logo" alt="">
                        <span class="d-none d-md-inline"><?php echo $Coins['coinname'];?></span>
                      </a>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <span class="btn btn-sm btn-light"><?php echo $Coins['chain'];?></span>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <?php echo $Coins['Symbol'];?>
                    </div>
                    <div class=" col text-center text-nowrap">
                      $ <?php echo $Coins['Marketcap'];?>
                    </div>
                    <div class=" col text-center d-lg-block d-none text-nowrap">
                      $ <?php echo $Coins['Price'];?>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <?php echo date('d M Y',strtotime($Coins['Launchdate']));?>
                    </div>
                    <div class=" col text-center">
                        <span class="btn btn-sm btn-primary" id="votes_<?php echo $Coins['id'];?>"><?php echo $Coins['votes'];?></span>
                    </div>
                    <div class=" col text-center">
                        <button class="btn btn-sm btn-primary" onclick="vote(this,'<?php echo $Coins['id'];?>')">
                            <?php
                            $CheckVote=mysqli_query($con,"SELECT id FROM `votes` WHERE user_id='".$_SERVER['REMOTE_ADDR']."' AND coin_id=".$Coins['id']);
                            if(mysqli_num_rows($CheckVote)==0){
                            ?>
                            <i class="far fa-heart"></i>
                            <?php 
                            } else{
                            ?>
                            <i class="fa fa-heart"></i>
                            <?php 
                            }
                            ?>
                            Vote
                        </button>
                    </div>
                  </div>
                <?php
            }
            ?>
            </div>
        </div>
      </div>
     
    
      <div class="tab-pane fade show active" id="pills-alltime" role="tabpanel" aria-labelledby="nav-alltime-tab">
        <div class="container mb-5 px-0">
          <div class="table-custom-head row mx-0 px-1 px-lg-3 text-nowrap">
            <div class=" col d-lg-flex align-items-center">
              # <span class="pl-1 pl-lg-5">Name</span>
            </div>
            <div class="justify-content-center col d-lg-flex d-none align-items-center justify-content-center">
              Chain
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Symbol
            </div>
            <div class=" col d-lg-flex align-items-center justify-content-center">
              Market cap <img src="assets/images/info.png" class="ps-1" alt="">
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Price
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Launch
            </div>
            <div class="justify-content-center col d-flex align-items-center justify-content-center">
              Votes
            </div>
            <div class="justify-content-center col d-flex align-items-center justify-content-center">
              Vote
            </div>
          </div>
          <div id="paginate_alltime">
            <?php
            
            $index=1;
            $GETcoins=mysqli_query($con,"SELECT *,(SELECT COUNT(id) from `votes` WHERE `votes`.coin_id=`coins`.id) AS `Rank` FROM `coins` WHERE adminapproval=1 ORDER BY `Rank` DESC");
            foreach($GETcoins as $Coins){
                ?>
                <div class="align-items-center table-custom-body row mx-0 px-1 px-lg-3 list">
                    <div class=" col d-flex align-items-center flex-row">
                      <span class="gradient-text"><?php echo $index++;?></span>
                      <a href="./coininfo.php?coin_id=<?php echo  $Coins['id'];?>&&Symbol=<?php echo  $Coins['Symbol'];?>" class="d-flex align-items-center flex-lg-row flex-column ">
                        <img src="<?php echo $Coins['Logo'];?>" class="mx-2 table-coin-logo" alt="">
                        <span class="d-none d-md-inline"><?php echo $Coins['coinname'];?></span>
                      </a>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <span class="btn btn-sm btn-light"><?php echo $Coins['chain'];?></span>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <?php echo $Coins['Symbol'];?>
                    </div>
                    <div class=" col text-center text-nowrap">
                      $ <?php echo $Coins['Marketcap'];?>
                    </div>
                    <div class=" col text-center d-lg-block d-none text-nowrap">
                      $ <?php echo $Coins['Price'];?>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <?php echo date('d M Y',strtotime($Coins['Launchdate']));?>
                    </div>
                    <div class=" col text-center">
                        <span class="btn btn-sm btn-primary" id="votes_<?php echo $Coins['id'];?>"><?php echo $Coins['votes'];?></span>
                    </div>
                    <div class=" col text-center">
                        <button class="btn btn-sm btn-primary" onclick="vote(this,'<?php echo $Coins['id'];?>')">
                            <?php
                            $CheckVote=mysqli_query($con,"SELECT id FROM `votes` WHERE user_id='".$_SERVER['REMOTE_ADDR']."' AND coin_id=".$Coins['id']);
                            if(mysqli_num_rows($CheckVote)==0){
                            ?>
                            <i class="far fa-heart"></i>
                            <?php 
                            } else{
                            ?>
                            <i class="fa fa-heart"></i>
                            <?php 
                            }
                            ?>
                            Vote
                        </button>
                    </div>
                  </div>
                <?php
            }
            ?>
            </div>
        </div>
      </div>
     
   
      <div class="tab-pane fade show" id="pills-new" role="tabpanel" aria-labelledby="nav-new-tab">
        <div class="container mb-5 px-0">
          <div class="table-custom-head row mx-0 px-1 px-lg-3 text-nowrap">
            <div class=" col d-lg-flex align-items-center">
              # <span class="pl-1 pl-lg-5">Name</span>
            </div>
            <div class="justify-content-center col d-lg-flex d-none align-items-center justify-content-center">
              Chain
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Symbol
            </div>
            <div class=" col d-lg-flex align-items-center justify-content-center">
              Market cap <img src="assets/images/info.png" class="ps-1" alt="">
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Price
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Launch
            </div>
            <div class="justify-content-center col d-flex align-items-center justify-content-center">
              Votes
            </div>
            <div class="justify-content-center col d-flex align-items-center justify-content-center">
              Vote
            </div>
          </div>
          <div id="paginate_new">
            <?php
            $index=1;
            $GETcoins=mysqli_query($con,"SELECT * FROM `coins` where adminapproval = '1' ORDER By Launchdate DESC ");
            foreach($GETcoins as $Coins){
                ?>
                <div class="align-items-center table-custom-body row mx-0 px-1 px-lg-3 list">
                    <div class=" col d-flex align-items-center flex-row">
                      <span class="gradient-text"><?php echo $index++;?></span>
                      <a href="./coininfo.php?coin_id=<?php echo  $Coins['id'];?>&&Symbol=<?php echo  $Coins['Symbol'];?>" class="d-flex align-items-center flex-lg-row flex-column ">
                        <img src="<?php echo $Coins['Logo'];?>" class="mx-2 table-coin-logo" alt="">
                        <span class="d-none d-md-inline"><?php echo $Coins['coinname'];?></span>
                      </a>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <span class="btn btn-sm btn-light"><?php echo $Coins['chain'];?></span>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <?php echo $Coins['Symbol'];?>
                    </div>
                    <div class=" col text-center text-nowrap">
                      $ <?php echo $Coins['Marketcap'];?>
                    </div>
                    <div class=" col text-center d-lg-block d-none text-nowrap">
                      $ <?php echo $Coins['Price'];?>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <?php echo date('d M Y',strtotime($Coins['Launchdate']));?>
                    </div>
                    <div class=" col text-center">
                        <span class="btn btn-sm btn-primary" id="votes_<?php echo $Coins['id'];?>"><?php echo $Coins['votes'];?></span>
                    </div>
                    <div class=" col text-center">
                        <button class="btn btn-sm btn-primary" onclick="vote(this,'<?php echo $Coins['id'];?>')">
                            <?php
                            $CheckVote=mysqli_query($con,"SELECT id FROM `votes` WHERE user_id='".$_SERVER['REMOTE_ADDR']."' AND coin_id=".$Coins['id']);
                            if(mysqli_num_rows($CheckVote)==0){
                            ?>
                            <i class="far fa-heart"></i>
                            <?php 
                            } else{
                            ?>
                            <i class="fa fa-heart"></i>
                            <?php 
                            }
                            ?>
                            Vote
                        </button>
                    </div>
                  </div>
                <?php
            }
            ?>
            </div>
        </div>
      </div>
     
   
      <div class="tab-pane fade show" id="pills-marketcap" role="tabpanel" aria-labelledby="nav-marketcap-tab">
        <div class="container mb-5 px-0">
          <div class="table-custom-head row mx-0 px-1 px-lg-3 text-nowrap">
            <div class=" col d-lg-flex align-items-center">
              # <span class="pl-1 pl-lg-5">Name</span>
            </div>
            <div class="justify-content-center col d-lg-flex d-none align-items-center justify-content-center">
              Chain
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Symbol
            </div>
            <div class=" col d-lg-flex align-items-center justify-content-center">
              Market cap <img src="assets/images/info.png" class="ps-1" alt="">
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Price
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center">
              Launch
            </div>
            <div class="justify-content-center col d-flex align-items-center justify-content-center">
              Votes
            </div>
            <div class="justify-content-center col d-flex align-items-center justify-content-center">
              Vote
            </div>
          </div>
          <div id="paginate_marketcap">
            <?php
            $index=1;
            $GETcoins=mysqli_query($con,"SELECT * FROM `coins` WHERE adminapproval='1' ORDER by Marketcap DESC;");
            foreach($GETcoins as $Coins){
                ?>
                <div class="align-items-center table-custom-body row mx-0 px-1 px-lg-3 list">
                    <div class=" col d-flex align-items-center flex-row">
                      <span class="gradient-text"><?php echo $index++;?></span>
                      <a href="./coininfo.php?coin_id=<?php echo  $Coins['id'];?>&&Symbol=<?php echo  $Coins['Symbol'];?>" class="d-flex align-items-center flex-lg-row flex-column ">
                        <img src="<?php echo $Coins['Logo'];?>" class="mx-2 table-coin-logo" alt="">
                        <span class="d-none d-md-inline"><?php echo $Coins['coinname'];?></span>
                      </a>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <span class="btn btn-sm btn-light"><?php echo $Coins['chain'];?></span>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <?php echo $Coins['Symbol'];?>
                    </div>
                    <div class=" col text-center text-nowrap">
                      $ <?php echo $Coins['Marketcap'];?>
                    </div>
                    <div class=" col text-center d-lg-block d-none text-nowrap">
                      $ <?php echo $Coins['Price'];?>
                    </div>
                    <div class=" col text-center d-lg-block d-none">
                      <?php echo date('d M Y',strtotime($Coins['Launchdate']));?>
                    </div>
                    <div class=" col text-center">
                        <span class="btn btn-sm btn-primary" id="votes_<?php echo $Coins['id'];?>"><?php echo $Coins['votes'];?></span>
                    </div>
                    <div class=" col text-center">
                        <button class="btn btn-sm btn-primary" onclick="vote(this,'<?php echo $Coins['id'];?>')">
                            <?php
                            $CheckVote=mysqli_query($con,"SELECT id FROM `votes` WHERE user_id='".$_SERVER['REMOTE_ADDR']."' AND coin_id=".$Coins['id']);
                            if(mysqli_num_rows($CheckVote)==0){
                            ?>
                            <i class="far fa-heart"></i>
                            <?php 
                            } else{
                            ?>
                            <i class="fa fa-heart"></i>
                            <?php 
                            }
                            ?>
                            Vote
                        </button>
                    </div>
                  </div>
                <?php
            }
            ?>
            </div>
        </div>
      </div>
     
    </div>
	  
	 
	
<h2 class="text-center">List Your Crypto Token for Free</h2>
<p class="text-center">Thetoken Sniper is the place for one to be regarding the latest crypto listing new coins in 2022. Thetoken Sniper allows you to list your crypto token for free on our site and then have it circulate in the cryptocurrency coin market. We constantly update our new coin crypto list of 2022, so if you are looking to list your coin for free, you can reach out to us for a free token listing request. So, what are you waiting for? List your cryptocurrency online with Thetoken Sniper today without any hassle and add your cryptocoin online in our new coin listings in 2022. Now, connect with us and list your crypto tokens for free at our website. </p>
<br>
  </div>
	
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="scripts.js"></script>

<script>
	$('#paginate_today').paginate({perPage:<?php echo (!empty($_SESSION['NumPage']))?intval($_SESSION['NumPage']):'10';?>});
	$('#paginate_alltime').paginate({perPage:<?php echo (!empty($_SESSION['NumPage']))?intval($_SESSION['NumPage']):'10';?>});
	$('#paginate_new').paginate({perPage:<?php echo (!empty($_SESSION['NumPage']))?intval($_SESSION['NumPage']):'10';?>});
	$('#paginate_marketcap').paginate({perPage:<?php echo (!empty($_SESSION['NumPage']))?intval($_SESSION['NumPage']):'10';?>});
</script>


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
<?php include('footer.php'); ?>