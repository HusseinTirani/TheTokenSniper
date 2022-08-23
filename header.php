<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(!isset($_SESSION['random_id'])){
  $_SESSION['random_id'] = time();
}

// session_destroy();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time();?>">
    <?php
$uri = $_SERVER['REQUEST_URI'];
if ($uri=='/' || $uri=='/index.php') { ?>
<title>Free Token Listing Request | Cryptocurrency Coin Market - The Tokensniper</title>
<meta name="description" content="The Token Sniper is one of the best solutions for the cryptocurrency coin market online platform for listing your token where you can request for Free Token Listing. Visit our website today!">
<link rel="canonical" href="https://thetokensniper.com/" />
<?php } else if($uri=='/events.php') {?>
<title>New Coin & Upcoming Cryptocurrency Event in 2022 - The Tokensniper</title>
<meta name="description" content="You can get the New Coin & Upcoming Cryptocurrency Event alerts for your favorite coins/tokens using The Tokensniper. Follow the crypto ecosystem with our crypto events calendar.">
<link rel="canonical" href="https://thetokensniper.com/events.php" />
<?php } else {?>
<title>The Tokensniper</title>
<meta name="description" content="We aim for tokens with potential, you vote and we promote. We display only a selection of tokens to make the difference, feel free to contact us for a suggestion, support or new token.">
<?php echo "<link rel='canonical' href='https://thetokensniper.com$uri'>";?>
<?php } ?>
	  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-J9C6M12SXF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-J9C6M12SXF');
</script>
	  
	  
	  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    
  
    <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <!-- <img src="assets/images/logo.png" alt="" /> -->
          <span class="fs-4 fw-700 text-primary">Thetoken Sniper</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-left:8%">
			  
		  <ul class="navbar-nav mr-auto"> 
            <li class="nav-item active">
              <a class="nav-link ps-lg-4 ps-2" aria-current="page" href="events.php">The Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-lg-4 ps-2" aria-current="page" href="tokens.php">The Tokens</a>
            </li>
            <li class="nav-item">
              <a class="nav-link ps-lg-4 ps-2" aria-current="page" href="contact-us.php">Contact Us</a>
            </li>
			  <li class="nav-item active">
              <a class="nav-link ps-lg-4 ps-2" aria-current="page" href="Bloginfo.php">The Crypto Blog</a>
            </li>
            <?php if(basename($_SERVER['PHP_SELF'])=="index.php" or basename($_SERVER['PHP_SELF'])=="events.php"){ ?>
            <li class="nav-item">
              <a class=" nav-link  ps-lg-4 ps-2" aria-current="page" href="add-events.php"> <i class="fa fa-plus"></i> Add Events</a>
            </li>
			  
            <?php } ?>
            <?php if(basename($_SERVER['PHP_SELF'])=="tokens.php"){ ?>
             <li class="nav-item">
              <a class="nav-link  ps-lg-4 ps-2" aria-current="page" href="add-token.php"> <i class="fa fa-plus"></i> Add Token</a>
            </li>
            <?php } ?>
			  
				  </ul>
			  <form class="form-inline my-2 my-lg-4" style="padding-left:3%" method="POST" action="">
				  
				  
				  

<script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.css" />
<input id="myinput" list="datalistOptions" class="form-control" placeholder="Search for Coins..." spellcheck="false" />
<datalist id="datalistOptions">
	 <?php
                        $coin=mysqli_query($con,"SELECT * FROM `coins`");
                        foreach($coin as $coindetail)
							
                        {?>
                            <option value="/coininfo.php?coin_id=<?php echo  $coindetail['id'];?>&&Symbol=<?php echo  $coindetail['coinname'];?>"><?php echo $coindetail['Symbol']; ?></option>
                        <?php }
                        ?>
</datalist>  
               
	
    </form>
			  
			  
				  
				  
				  
			 
			  
			  
			 
			   
			  
      </div>
		  </div>
		
    </nav>

    <img src="assets/images/bg3.png" alt="" class="bg-img">
	  
	  <script>
    var aweInput = new Awesomplete(myinput);
myinput.addEventListener('awesomplete-select', function(e) {
  var url = e.text.value; // The value associated with the selection
	window.location.href = url;
  
  // Some optional actions:
  e.preventDefault(); // Prevent the URL from appearing in the input box
  e.target.value = e.text.label; // Set the value to the selected label
  aweInput.close(); // close the drop-down
  //
});
</script>