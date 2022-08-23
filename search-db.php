<?php

include('admin/config.php');
session_start();
require 'vendor/autoload.php';

use Carbon\Carbon;

$search_key  = $_GET['search'];
if (!empty($search_key)) {
    $sql = mysqli_query($con, "SELECT * FROM `coins` WHERE  adminapproval='1' AND coinname LIKE '%$search_key%' ");
    $result = mysqli_fetch_assoc($sql);
    $output = '';
    $rowcounter = 1;
    if (mysqli_num_rows($sql) > 0) {
        $output .= '
        <div class="container mb-5">
        <div class="table-custom-head row mx-0 ">
          <div class=" col d-lg-flex align-items-center">
            # <span class="ps-5">Name</span> 
          </div>
          <div class="justify-content-center col d-lg-flex d-none align-items-center">
          Price 
          </div>
          <div class=" col d-lg-flex d-none align-items-center">
          Holder
          </div>
          <div class=" col d-lg-flex align-items-center">
          Market cap <img src="assets/images/info.png" class="ps-1" alt="">
          </div>
          <div class=" col d-lg-flex d-none align-items-center">
          Performance
          </div>
          <div class=" col d-lg-flex d-none align-items-center">
          7 Derniers Jours
          </div>
          <div class="justify-content-center col d-flex  align-items-center">
          Vote <img src="assets/images/heart.png" class="ps-2" alt="">
          </div>
        </div>
      ';
        foreach ($sql as $result) {
            $isactive = "";
            $heart = "white-heart.png";
            if (isset($_SESSION['user_info'])) {
                $cid = $result['id'];
                $uid = $_SESSION['user_info']['id'];
                if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM `votes` WHERE coin_id='$cid' AND user_id='$uid'")) > 0) {
                    $isactive = 'active';
                    $heart = "white-heart.png";
                }
            }
            $human_dt =  Carbon::now()->diffForHumans($result['Launchdate']);
            if(strpos($human_dt, 'after') !== false){
              $human_dt  = explode("after",$human_dt)[0] .' '. explode("after",$human_dt)[1] = 'ago' ; 
            } 
            if(strpos($human_dt, 'before') !== false){
              $human_dt  =explode("before",$human_dt)[1] = 'In'.' ' . explode("before",$human_dt)[0]; 
            } 
            if(strpos($human_dt, 'hours')){
                $human_dt = "Launched Today";
            }
            $output .= ' <div class="table-custom-body row mx-0 ">
            <div  class=" col d-flex align-items-center flex-row" onclick="coininfo('.$result['id'].')">
              <span class="gradient-text">'.$rowcounter++.'</span>
              <div class="d-flex align-items-center flex-lg-row flex-column ">
              <img src="'.$result['Logo'].'" class="mx-3 table-coin-logo" alt="">
               '.$result['coinname'].'
              </div>
            </div>
            <div class="justify-content-center col d-lg-flex d-none align-items-center flex-wrap" onclick="coininfo('.$result['id'].')">
            <span>'.$result['Price'].'</span>  <span class="faded-price px-2">2,940.97 USD</span> 
            </div>
            <div class=" col d-lg-flex d-none align-items-center justify-content-center" onclick="coininfo('.$result['id'].')">
              1,108,746.3584
            </div>
            <div class=" col d-flex align-items-center justify-content-center" onclick="coininfo('.$result['id'].')">
            '.$result['Marketcap'].'
            </div>
            <div class=" col d-lg-flex d-none align-items-center flex-column" onclick="coininfo('.$result['id'].')">
              0.00015714723672 ATH
              <img src="assets/images/progress.PNG" class="img-fluid" alt="">
              <div class="d-flex justify-content-between w-100">
                <span>Low</span>
                <span>High</span>
              </div>
            </div>
            <div class=" col d-lg-flex d-none align-items-center" onclick="coininfo('.$result['id'].')">
            <img src="assets/images/graph.png" alt="">
            </div>
            <div class="justify-content-center col d-flex  align-items-center">
            <span onclick="voteit(this)" id="promote-'.$result['id'].'" class="w-100">
              <button class="vote-button '.$isactive.'">
                <img src="assets/images/'.$heart.'" alt="">
                <span>'.$result['votes'].'</span>
              </button>
            </span>
            </div>
          </div>
            ';
        }
        $output.='  </div>
        </div>';
        echo $output;
    }
} else {
    echo  $output =  '<div class="w-100 text-center text-danger py-5"> Result Not Found !</div>';
}
