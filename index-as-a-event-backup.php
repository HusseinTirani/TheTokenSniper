<?php
include 'header.php';
include('admin/config.php');
require 'vendor/autoload.php';

use Carbon\Carbon;

$sql_text = mysqli_query($con,"SELECT * FROM `website` where role='header'");
$row_text = mysqli_fetch_assoc($sql_text);

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
        <img src="assets/images/svg.png " class="mobile-img" alt="" />
      </div>
    </div>
  </div>
</section>




<!-- <section>
  <div class="container  " style="transform: translateY(-50px);">
    <div class="row mx-0 ">
      <div class="col-lg-3 p-2 col-12">
        <div class="first-card p-3">
          <div class=" card-heading d-flex align-items-center justify-content-center fw-500 fs-5 ">Trending </div>

          <div class=" small-heading d-flex align-items-center justify-content-center ">15 jan 2022</div>
          <div class="d-flex align-items-center justify-content-center fw-600 mt-3 text-primary fs-5 "> Stacking
            Launch</div>
          <div class=" mt-2 small-heading d-flex align-items-center justify-content-center">+2332 views |+504 Votes
          </div>
        </div>
      </div>
      <div class="col-lg-3 p-2 col-12">
        <div class="first-card p-3">
          <div class=" card-heading d-flex align-items-center justify-content-center fw-500 fs-5 ">Trending </div>

          <div class=" small-heading d-flex align-items-center justify-content-center ">15 jan 2022</div>
          <div class="d-flex align-items-center justify-content-center fw-600 mt-3 text-primary fs-5 "> Stacking
            Launch</div>
          <div class=" mt-2 small-heading d-flex align-items-center justify-content-center">+2332 views |+504 Votes
          </div>
        </div>
      </div>
      <div class="col-lg-3 p-2 col-12">
        <div class="first-card p-3">
          <div class=" card-heading d-flex align-items-center justify-content-center fw-500 fs-5 ">Trending </div>

          <div class=" small-heading d-flex align-items-center justify-content-center ">15 jan 2022</div>
          <div class="d-flex align-items-center justify-content-center fw-600 mt-3 text-primary fs-5 "> Stacking
            Launch</div>
          <div class=" mt-2 small-heading d-flex align-items-center justify-content-center">+2332 views |+504 Votes
          </div>
        </div>
      </div>
      <div class="col-lg-3 p-2 col-12">
        <div class="first-card p-3">
          <div class=" card-heading d-flex align-items-center justify-content-center fw-500 fs-5 ">Trending </div>

          <div class=" small-heading d-flex align-items-center justify-content-center ">15 jan 2022</div>
          <div class="d-flex align-items-center justify-content-center fw-600 mt-3 text-primary fs-5 "> Stacking
            Launch</div>
          <div class=" mt-2 small-heading d-flex align-items-center justify-content-center">+2332 views |+504 Votes
          </div>
        </div>
      </div>

    </div>
  </div>
</section> -->

<form action="search.php" method="GET">
  <div class="container mb-5 mt-5">
    <div class="row mx-0 p-4 justify-content-center  ws-card">
      <div class="col-12 d-flex justify-content-center align-items-center py-3">
        <span>Highlight</span>
        <span class="text-primary px-3"> Upcoming Events</span>
        <span>Post Events</span>
      </div> 
      <div class="col-lg-3 col-12 p-2">
        <div class="ws-inp">
          <input type="date">
        </div>
      </div>
      <div class="col-lg-2 col-12 p-2">
        <div class="ws-inp">
          <input type="text" placeholder="Keywords">
        </div>
      </div>
      <div class="col-lg-2 col-12 p-2">
        <div class="ws-inp">
          <select name="" id="">
            <option value="" selected>Coins</option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-12 p-2">
        <div class="ws-inp">
          <select name="" id="">
            <option value="" selected>Exchange -All</option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-12 p-2">
        <div class="ws-inp">
          <select name="" id="">
            <option value="" selected>Category -All</option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-12 p-2">
        <div class="ws-inp">
          <select name="" id="">
            <option value="" selected>Sort By</option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-12 p-2">
        <div class="ws-inp">
          <select name="" id="">
            <option value="" selected>Show Only</option>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-12 p-2">
        <button class="b1 w-100 d-flex "> <i class="fa fa-search "></i> <span class="col">Search</span> </button>
      </div> 
       <div class="col-lg-2 col-12 p-2">
        <button class="ws-inp d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; ">
          <i class="fa fa-times text-primary fs-5"></i></button>
      </div>
<!-- 
      <div class="col-lg-5 col-12 p-2">
        <div class="ws-inp">
          <input type="text" class="ps-2" name="coin" placeholder="Enter coin name">
        </div>
      </div>
      <div class="col-lg-5 col-12 p-2">
        <div class="ws-inp">
          <input type="text" class="ps-2" name="address" placeholder="Enter contract address">
        </div>
      </div>

      <div class="col-lg-2 col-12 p-2">
        <button class="b1 w-100 d-flex "> <i class="fa fa-search "></i> <span class="col">Search</span> </button> -->
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
        echo '<a href="promotion.php?src=' . $src . '&link='.$value['link'].'"  class="slice-ad-items-1" ><img src="' . $src . '" alt=""></a>';
      }
      ?>
    </div>
  </div>
</div>

<section>
  <div class="container my-5">
    <div class="row mx-0 ">


      <?php
      $total_vote = mysqli_query($con, "SELECT * FROM `coins`");
      $total_num_vote = 0;
      foreach ($total_vote as  $total_votes) {
        $total_num_vote += $total_votes['votes'];
      }

      $sql = mysqli_query($con, "SELECT * FROM `coins`  ORDER BY votes + 0 DESC ");
      if (mysqli_num_rows($sql) > 0) {
        $rowcounter = 1;
        foreach ($sql as $result) {
          $percentage = $result['votes'] / $total_num_vote * 100;
          $percentage = round($percentage);
          $isactive = "";
          $heart = "white-heart.png";
          $cid = $result['id'];
          if (isset($_SESSION['user_info'])) {
            $uid = $_SESSION['user_info']['id'];
            if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM `votes` WHERE coin_id='$cid' AND user_id='$uid'")) > 0) {
              $isactive = 'active';
              $heart = "white-heart.png";
            }
          } else {
            $uid = $_SESSION['random_id'];
            if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM `votes` WHERE coin_id='$cid' AND user_id='$uid'")) > 0) {
              $isactive = 'active';
              $heart = "white-heart.png";
            }
          }
          $human_dt =  Carbon::now()->diffForHumans($result['Launchdate']);
          if (strpos($human_dt, 'after') !== false) {
            $human_dt  = explode("after", $human_dt)[0] . ' ' . explode("after", $human_dt)[1] = 'ago';
          }
          if (strpos($human_dt, 'before') !== false) {
            $human_dt  = explode("before", $human_dt)[1] = 'In' . ' ' . explode("before", $human_dt)[0];
          }
          if (strpos($human_dt, 'hours')) {
            $human_dt = "Launched Today";
          }
          echo '
          <div class=" col-lg-3 p-3 col-12">
          <div class="ws-card-2 py-4 pb-3 d-flex flex-column align-items-center">
            <div class="d-flex w-100 align-items-center justify-content-center">
              <img src="assets/images/check.png" class="" style="width: 15px;" alt="">
              <img src="assets/images/crown.png" class=" mx-2" style="width: 15px;" alt="">
              <img src="assets/images/fire.png" class="" style="width: 15px;" alt="">
            </div>
            <img src="' . $result['Logo'] . '" style="width: 40px; height: 40px;" class="my-3">
            <a href="detail.php?id=' . $result['id'] . '" class="fs-5 fw-500 text-primary  text-uppercase text-center" style="height: 32px ; overflow: hidden; text-decoration:underline;" >' . $result['coinname'] . ' (' . $result['Symbol'] . ')</a>
            <span class="fs-7 fw-500">' . $human_dt . '</span>
            <span class="fs-7 fw-500 text-center px-3" style="height:80px; overflow:hidden; position:relative; ">' . $result['Description'] . ' <span class="px-3" style="position:absolute; bottom: -3px; right: 1px;  ">...</span>  </span>
  
            <div class="progress-div w-100  mt-3">
              <div class="marker" style="position:relative; left: calc(' . $percentage . '% - 16px);">
                <img src="assets/images/marker.png" alt="">
                <span>' . $percentage . '%</span>
              </div>
              <div class="progress">
                <span style="width:' . $percentage . '%;" ></span>
              </div>
            </div>
            <span class="fs-7 fw-500 pt-2 vtdiv"  >' . $result['votes'] . ' Votes</span>
            <div class="d-flex w-100 mt-2">
              <button class="btn-1 col " onclick="voteit(this)" id="promote-' . $result['id'] . '">  <i class="fa fa-thumbs-up mx-1"></i> Like </button>
              <button class="btn-1 col " onclick="dislike(this)" id="promote-' . $result['id'] . '">  <i class="fa fa-thumbs-down mx-1"></i> Dislike </button>
            </div>
            
            <span class="fs-8 fw-500 pt-2 ">Follow <a class="text-primary" href="' . $result['Twitter'] . '"> @' . $result['Twitter'] . '</a></span>
          </div>
        </div>';
        }
      }

      ?>
    </div>
  </div>
</section>
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


<?php include('footer.php'); ?>
<script src="assets/js/votes.js?v=<?php echo time(); ?>"></script>