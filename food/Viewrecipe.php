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
<BODY style="background-color: lightgreen">


<div id="navbar" class="navbar navbar-default">
	<div class="container">
		<div class="navbar-collapse collapse" id="navigation">
			<div class="padd-nav">
				<ul class="nav navbar-nav left">
					<li ><a href="index.php" class="act">Home</a></li>
					<li><a href="favourite.php">Go To Favourites <i class="fa fa-star"></i></a></li>
					<li><a href="allrecipe.php">All Recipes<i class="fa fa-book"></i></a></li>
					

 	                
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
<div id='container'>
<?php

if (isset($_GET['submit'])) {

	 $id=$_GET['submit'];
	 $run_prod1="select * from recipe where recipe_name='$id'";
$run_q=pg_query($dbconn,$run_prod1);

while($run_prod=pg_fetch_array($run_q))
{
    $getcat1=$run_prod['category'];
    $getcus1=$run_prod['cuisine'];
    $prodimg1=$run_prod['img'];
     $prodingredients1=$run_prod['ingredients'];
    $proddetails1=$run_prod['details'];
			$prodtitle1=$run_prod['recipe_name'];
			$prod_des=$run_prod['recipe_desp'];
			
			echo "<H4 style='margin-left:630px'>Recipe</h4>
			
			<div class='box' style='width:1000px; height:1000px;margin-left:auto;margin-right:auto;'>
			<img  class='img-responsive center-block' style='margin-bottom:10px;' src='$prodimg1'>
             <p>NAME : $prodtitle1</p>
             <p>DESCRIPTION : $prod_des </p>
             <p>INSTRUCTIONS : $proddetails1 </p>
             <p>INGREDIENTS : $prodingredients1 </p>
             <p>CATEGORY : $getcat1 </p>
             <p>CUISINE : $getcus1 </p>

 			</div>
                
			";
   
}

		}
		?>
	</div>
    </body>
    </html>