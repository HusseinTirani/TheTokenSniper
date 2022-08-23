<?php
include('admin/config.php');
session_start();

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

<section class="container my-5"style="padding-bottom:80px">

      <div class="col-lg-12  justify-content-center d-flex">

    </div> 
	</section>
	<?php


$news=simplexml_load_file("https://cdn.feedcontrol.net/5181/5109-k31FG7KcuoeLv.xml");



foreach ($news->channel->item as $item) 
{
	$content = $item->children('content', 'http://purl.org/rss/1.0/modules/content/');
	$html_string = $content->encoded;
	$dom = new DOMDocument();
	$dom->loadHTML($html_string);
	$img = $dom->getElementsByTagName('img')->item(0)->getAttribute('src');
	$title = $item->title;
	$description = $item->description;
	$image = $img;
	$fullcontent = $html_string ;
	$pubDate =$item->pubDate ;
	$sql = mysqli_query($con, "SELECT * FROM `autoBlog` where title='$title'");
	if(mysqli_num_rows($sql)==0){
		
		$insert =  mysqli_query($con,"INSERT INTO `autoBlog` VALUES(NULL,'$title','$description','$image','$fullcontent','$pubDate')");
	}
	
	
}
$news1=simplexml_load_file("https://cdn.feedcontrol.net/5208/5134-baVA1ohFwnPeh.xml");



foreach ($news1->channel->item as $item) 
{
	$content = $item->children('content', 'http://purl.org/rss/1.0/modules/content/');
	$html_string = $content->encoded;
	$dom = new DOMDocument();
	$dom->loadHTML($html_string);
	$img = $dom->getElementsByTagName('img')->item(0)->getAttribute('src');
	$title = $item->title;
	$description = $item->description;
	$image = $img;
	$fullcontent = $html_string ;
	$pubDate =$item->pubDate ;
	$sql = mysqli_query($con, "SELECT * FROM `autoBlog` where title='$title'");
	if(mysqli_num_rows($sql)==0){
		
		$insert =  mysqli_query($con,"INSERT INTO `autoBlog` VALUES(NULL,'$title','$description','$image','$fullcontent','$pubDate')");
	}
	
	
}
$news2=simplexml_load_file("https://cdn.feedcontrol.net/5208/5125-ptyFT7JBfH9Lm.xml");



foreach ($news2->channel->item as $item) 
{
	$content = $item->children('content', 'http://purl.org/rss/1.0/modules/content/');
	$html_string = $content->encoded;
	$dom = new DOMDocument();
	$dom->loadHTML($html_string);
	$img = $dom->getElementsByTagName('img')->item(0)->getAttribute('src');
	$title = $item->title;
	$description = $item->description;
	$image = $img;
	$fullcontent = $html_string ;
	$pubDate =$item->pubDate ;
	$sql = mysqli_query($con, "SELECT * FROM `autoBlog` where title='$title'");
	if(mysqli_num_rows($sql)==0){
		
		$insert =  mysqli_query($con,"INSERT INTO `autoBlog` VALUES(NULL,'$title','$description','$image','$fullcontent','$pubDate')");
	}
	
	
}
$news3=simplexml_load_file("https://cdn.feedcontrol.net/5272/5205-VKWGBN5R5DR4a.xml");



foreach ($news3->channel->item as $item) 
{
	$content = $item->children('content', 'http://purl.org/rss/1.0/modules/content/');
	$html_string = $content->encoded;
	$dom = new DOMDocument();
	$dom->loadHTML($html_string);
	$img = $dom->getElementsByTagName('img')->item(0)->getAttribute('src');
	$title = $item->title;
	$description = $item->description;
	$image = $img;
	$fullcontent = $html_string ;
	$pubDate =$item->pubDate ;
	$sql = mysqli_query($con, "SELECT * FROM `autoBlog` where title='$title'");
	if(mysqli_num_rows($sql)==0){
		
		$insert =  mysqli_query($con,"INSERT INTO `autoBlog` VALUES(NULL,'$title','$description','$image','$fullcontent','$pubDate')");
	}
	
	
}
$news4=simplexml_load_file("https://cdn.feedcontrol.net/5272/5203-rikuw8EWHjial.xml");



foreach ($news4->channel->item as $item) 
{
	$content = $item->children('content', 'http://purl.org/rss/1.0/modules/content/');
	$html_string = $content->encoded;
	$dom = new DOMDocument();
	$dom->loadHTML($html_string);
	$img = $dom->getElementsByTagName('img')->item(0)->getAttribute('src');
	$title = $item->title;
	$description = $item->description;
	$image = $img;
	$fullcontent = $html_string ;
	$pubDate =$item->pubDate ;
	$sql = mysqli_query($con, "SELECT * FROM `autoBlog` where title='$title'");
	if(mysqli_num_rows($sql)==0){
		
		$insert =  mysqli_query($con,"INSERT INTO `autoBlog` VALUES(NULL,'$title','$description','$image','$fullcontent','$pubDate')");
	}
	
	
}
	
	?>
<div id="paginate-blog">
<?php
	$result = mysqli_query($con, "SELECT * FROM autoBlog ORDER BY id DESC ");
		foreach($result as $fullnews){
	
	?>
<div class="card text-center" style="margin-top:30px">
	<div class="row">
		
		<div class="col-lg-3 card-header">
			
			<a href="./blog.php?id=<?php echo $fullnews['id'] ;?>">
				<img  class="card-img-top" style="width:300px" src="<?php  echo $fullnews['image'];?>" alt="card image cap" />
			</a>
			
			
		</div>
		<div class="col-lg-9 text-center" style="margin-top:30px">
			<a href="./blog.php?id=<?php echo $fullnews['id'] ;?>"><h5  class="card-title"><?php  echo $fullnews['title'];?></h5></a>
			<div class="card-text">
		<?php  echo $fullnews['description'];?>
				<div style="margin-top:20px;color:blue">
					<p>Published in:<?php  echo $fullnews['pubDate'];?> </p>
				</div>
		
	</div>
			
		</div>
	</div>
	
	
	
</div>
	



  <?php  
	
}



?>
	</div>
<script src="scripts.js"></script>
<script>
	$('#paginate-blog').paginate({perPage:15});
</script>


<section class="container my-5"style="padding-bottom:40px">

      <div class="col-lg-12  justify-content-center d-flex">

    </div> 
	</section>
		





	
	
	<script>
function fetchDetails(title,image,pubDate){
	
	$.ajax({
		type:'post',
		url:'/viewBlog.php',
		data:{
			'title':title,
			'image':image,
			'pubDate':pubDate
		},
		success:function(response){
			window.location = 'viewBlog.php';
		}
		
	});
}
</script>
	


	
<?php include 'footer.php'; ?>



