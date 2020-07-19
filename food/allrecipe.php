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
header("location:allrecipe.php?user_query=$pr");
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
<BODY style="background-color: lightblue">


<div id="navbar" class="navbar navbar-default">
	<div class="container">
		<div class="navbar-collapse collapse" id="navigation">
			<div class="padd-nav">
				<ul class="nav navbar-nav left">
					<li ><a href="index.php" >Home</a></li>
					<li><a href="favourite.php" >Go To Favourites <i class="fa fa-star"></i></a></li>
					<li><a href="allrecipe.php" class="act">All Recipes<i class="fa fa-book"></i></a></li>
          <li><a href="restaurant.php">Restaurants <i class="fa fa-cutlery"></i></a></li>
					

 	                
			<li> <form method="get" action="#" class="navbar-form">
					<div class="input-group">
						<input type="text" class="form-control" name="user_query" id="user_query" placeholder="search" required=" "/>
						<span class="input-group-btn">
						<button type="submit" name="search" id="search" value="Search" class="btn btn-primary">
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
<div id="content2" class="container">
		<div class="row1">
        <div class="col-md-2" style="height: 1500px" >
<div class="panel panel-default sidebar-menu" style="background-color: #ececed">
<div class="panel-heading">
	<h3 class="panel-title">Category</h3>

</div>
<div class="panel-body">
	<ul class="nav nav-pills nav-stacked category-menu">

		<li ><a href="allrecipe.php?prod=Veg">Veg</a></li>
		<li ><a href="allrecipe.php?prod=Non-veg">Non-veg</a></li>
	</ul>
</div>
</div>
</div>
		<form method="get">
     <?php
     global $getprod;
     if(isset($_GET['prod']))
     { $res=$_GET['prod'];
         $getprod="select * from recipe where category ilike '$res'";
     }
        else
        {
        $getprod="select * from recipe";
        }
		$runquery=pg_query($dbconn,$getprod);
		while($rowprod=pg_fetch_array($runquery))
		{     $prodid=$rowprod['recipe_name'];
			 $cat=$rowprod['category'];
			 $prodimg=$rowprod['img'];
			
         echo "
			<div class='col-md-3'>
			<div class='box' style='width:250px;height:330px'>
            <img class='img-responsive center-block' src='$prodimg'style='width:200px;height=200px'>
            <div class='text'>
            <h4 style='text-align:center'>
            $prodid
            </h4>
            </div>
            <p class='price' style='text-align:center'>
              $cat
            </p>
            <p class ='button' >
              <a  href='Viewrecipe.php?submit=$prodid'class='btn btn-primary'style='text-align:center;margin-bottom:5px'>
              View Recipe
              </a>
            <a href='allrecipe.php?submit=$prodid' class='btn btn-primary' >
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
	</BODY>
</HTML>
<?php

if (isset($_GET['submit'])) {
	if (!isset($_SESSION['email'])) {
	  echo "<script>alert('You must log in first')</script>";
	  echo "<script>window.open('allrecipe.php','_self')</script>";
	 
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
<script>
$(document).ready(function(){



 function load_data(user_query)
 {
  $.ajax({
   url:"searchrecipe.php",
   method:"POST",
   data:{user_query:user_query},
   success:function(data)
   {
    $('#content2').html(data);
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
 $("#search").click(function(){
console.log("working");
var search = $("#user_query").val();
  if(search != '')
  { console.log(search);
   load_data(search);
  }
  else
  {

   load_data();
  }

 });
});
</script>
