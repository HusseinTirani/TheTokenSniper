<?php 

$sql = mysqli_query($con,"SELECT * FROM `website` where role='footer'");
$row = mysqli_fetch_assoc($sql);

// if(isset($_POST['newsletter'])){
//   $email = $_POST['email'];
//   $news  = mysqli_query($con,"INSERT INTO `newsletter`(`email`) VALUES ('$email')");
// }


?>
<!-- <div class="container-fluid my-5 newsletter">
  <div class="row mx-0 justify-content-center">
    <div class="col-lg-9 col-12">
      <div class="ws-card-2 d-flex align-items-center flex-column p-4">
        <span class="fw-600 text-center text-primary">3 coins to keep an eye on</span>
        <span class="text-center fs-7 py-3">Subscribe to receive a weekly selection of 3 coins to watch closely, based
          on upcoming events and technical analysis.</span>
        <div class="row mx-0 justify-content-center w-100 pb-4">
          <div class="col-lg-9 col-12">
            <form class="ws-inp pe-0 w-100 " method="post"  >
              <input type="email" name="email"  class="ps-2" placeholder="Enter Email" required>
              <input class="b1  px-3 fs-7 text-light" style="max-width: 200px;" type="submit" name="newsletter" value="Submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="footer">
  <div class="container">
    <div class="row py-5  mx-0">
      <div class="col-lg-12 d-flex align-items-center flex-column col-12">
        <!-- <img src="assets/images/logo.png" alt=""> -->
        <span class="fs-4 fw-700 text-primary">Thetoken Sniper</span>

        <p class="mb-0 fs-7 text-light mt-3 col-lg-8 col-12 text-center"><?php echo $row['text']; ?></p>
      </div>
      <div class="col-lg-12 col-12 d-flex align-items-center justify-content-center pt-4">
        <a href="/" class="text-light px-2 pb-2 fs-7" style="opacity: .9;">Home</a>
        <a href="contact-us.php" class="text-light px-2 pb-2 fs-7" style="opacity: .9;">Contact</a>
        <a href="events.php" class="text-light px-2 pb-2 fs-7" style="opacity: .9;">Events</a>
        <a href="https://twitter.com/TheTokenSniper" class="text-light px-2 pb-2 fs-7" style="opacity: .9;"> Twitter</a>
         <a href="term-of-use.php" class="text-light px-2 pb-2 fs-7" style="opacity: .9;">Term and privacy</a>
      </div>

    </div>
  </div>
</div>

<div class="text-center p-3">
  Copyright Reserves © 2022. All Rights Reserved.
</div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="assets/js/search.js?v=<?php echo time(); ?>"></script>
<script src="assets/js/number-formator.js?v=<?php echo time(); ?>"></script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
  $('.ads-class').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    infinite: true,
    slidesToShow: 3,
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

</html>