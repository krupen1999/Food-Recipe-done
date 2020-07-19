<?php
include("db.php");
session_start();

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }

   if(isset($_GET['user_query']))
  { $pr=$_GET['user_query'];
header("location:shop.php?user_query=$pr");
  }
?>
<!DOCTYPE HTML>

<HTML>
<head>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>Food Recipe</title>
</head>
<body style="background:  rgb(0, 154, 201);font-family:apple;">


<div id="navbar" style="background: rgb(10, 0, 54);" class="navbar navbar-default">
	<div class="container">
		<div class="navbar-collapse collapse" id="navigation">
			<div class="padd-nav">
				<ul class="nav navbar-nav left">
					<li ><a href="#" class="act">Home</a></li>
					<li><a href="favourite.php">Go To Favourites <i class="fa fa-star"></i></a></li>
					<li><a href="allrecipe.php">All Recipes<i class="fa fa-book"></i></a></li>
					<li><a href="restaurant.php">Restaurants <i class="fa fa-cutlery"></i></a></li>
					

 	                
			<li> <form method="get" action="#" class="navbar-form">
					<div class="input-group">
						<input type="text" class="form-control" name="user_query" id="user_query" placeholder="search" required=" "/>
						<span class="input-group-btn">
						<button type="submit" name="search" value="Search" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
                     </form>
					</li>
				
		<?php  
					if (!isset($_SESSION['email'])) 
					{
		echo "<li class='shift' style='margin-left: 100px;margin-right:0px'><a href='sign-up.php'>Register</a></li>
    		     <li><a href='Login.php'>Login</a></li>
    		";
    	}
    	else
    	{
    		$user=$_SESSION['email'];
    		echo "
		<li style='margin-left: 100px;'><a href='profile.php'>Welcome <h4 style='color:yellow; display:inline'>$user</h4></a></li>
    	 <li><a href='index.php?logout=1'>Logout</a></li> ";
    	}
     ?>
					
					</ul>
				
			</div>
			
</div>
</div>
</div>




<div class="carousel slide" id="myCarousel" data-ride="carousel">
	<ol class="carousel-indicators">
    <li  class="active" data-target="#myCarousel" data-slide-to ="0"></li>
     <li data-target="#myCarousel" data-slide-to ="1"></li>
      <li data-target="#myCarousel" data-slide-to ="2"></li>
       <li data-target="#myCarousel" data-slide-to ="3"></li>

	</ol>
	<div class="carousel-inner">
		<?php
		$res=pg_query($dbconn,"select * from slider where slider_name='Burger'");
		
while($row1 = pg_fetch_array($res))
{
	
echo " 

<div class='item active'>

	<img src='$row1[slider_img]'>
	</div>
	
	" ;
}
$res=pg_query($dbconn,"select * from slider where slider_name='Pizza'");
while($row1 = pg_fetch_array($res))
{
	
echo " 

<div class='item'>

	<img src='$row1[slider_img]'>
	</div>
	
	" ;
}
$res=pg_query($dbconn,"select * from slider where slider_name='Plate'");
while($row1 = pg_fetch_array($res))
{
	
echo " 

<div class='item'>

	<img src='$row1[slider_img]'>
	</div>
	
	" ;
}
$res=pg_query($dbconn,"select * from slider where slider_name='Nachos'");
while($row1 = pg_fetch_array($res))
{
	
echo " 

<div class='item'>

	<img src='$row1[slider_img]'>
	</div>
	
	" ;
}
    	
?>
		
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>

</div>
<br>
<br>
<div id="hot">
	<div class="box">
<div class="container">
	<div class="col-md-12">
		<h2 style="color:red">Trending Recipes</h2>
	</div>
</div>
</div>
</div>
<div id="content" class="container">
		<div class="row1">
		<form method="get">
     <?php
     
		$getprod="select * from recipe LIMIT 6";

		$runquery=pg_query($dbconn,$getprod);
		while($rowprod=pg_fetch_array($runquery))
		{     $prodid=$rowprod['recipe_name'];
			 $cat=$rowprod['category'];
			 $prodimg=$rowprod['img'];
			
			
         echo "
			<div class='col-md-4'>
			<div  class='box'>
			<img  src=$prodimg class='img-responsive center-block' style='width:100%;height:100%'>
			
			
            <div class='text'>
            <h4 style='text-align:center'>
            $prodid
            </h4>
            </div>
            <p class='price' style='text-align:center'>
              $cat
            </p>
            <p class ='button' >
			  <a  href='Viewrecipe.php?submit=$prodid'class='btn btn-primary'
			  style='text-align:center;margin-bottom:5px'>
              View Recipe
              </a>
            <a href='index.php?submit=$prodid' class='btn btn-primary' >
            <i class='fa fa-star' ></i> Add to Favourites
            </a>
            </p>
            </div>
            </div>
             ";
		}
		?>
	</form>
	</div>
</div>
		
</div>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</body>
</HTML>


<?php

if (isset($_GET['submit'])) {
	if (!isset($_SESSION['email'])) {
	  echo "<script>alert('You must log in first')</script>";
	  echo "<script>window.open('index.php','_self')</script>";
	 
	  }
	  else
	  {
	$name=$_SESSION['email'];
	 $id=$_GET['submit'];
	 $run_prod1="select * from recipe where recipe_name='$id'";
$run_q=pg_query($dbconn,$run_prod1);

while($run_prod=pg_fetch_array($run_q))
{
	$cat1=$run_prod['category'];
	$prodimg1=$run_prod['img'];
			$prodtitle1=$run_prod['recipe_name'];

	$getcart="insert into favourites(category,rec_img,rec_name,username)values('$cat1','$prodimg1','$prodtitle1','$name')";
	$rp=pg_query($dbconn,$getcart);

	

	if ($rp) {

		echo "<script>alert('Product added successfully')</script>";
		
	}

}
}
}
?>
<script >
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"searchprod.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('').html(data);
   }
  });
 }
 $("#user_query").keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>