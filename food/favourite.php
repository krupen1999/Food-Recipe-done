<?php
include("db.php");
session_start();
if (!isset($_SESSION['email'])) {
	  echo "<script>alert('You must log in first')</script>";
	  echo "<script>window.open('index.php','_self')</script>";
  	}

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }

   if(isset($_GET['user_query']))
  { $pr=$_GET['user_query'];
header("location:allrecipe.php?user_query=$pr");
  }
  if(isset($_GET['del']))
  { $ids=$_GET['del'];
      $del_que="delete from favourites where rec_id='$ids' ";
      pg_query($dbconn,$del_que);

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
					<li><a href="favourite.php" class="act" >Go To Favourites <i class="fa fa-star"></i></a></li>
					<li><a href="allrecipe.php" >All Recipes<i class="fa fa-book"></i></a></li>
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

<div class="container">
	<div id="cart" class="col-md-9">
	<div class="box">
	<form action="" method="get" enctype="multipart/form-data">
	<h1>Favourites</h1>
	
	<div class="table-responsive">
		<table class="table" style="padding: 10px">
			<thead>
				<tr>
				<th >Recipe</th>
				<th>Name</th>
				<th>Category</th>
				<th></th>
				


				</tr>
			</thead>
			<tbody>
				
         <?php  
              if (isset($_SESSION['email'])) {
                   $user=$_SESSION['email'];
              $run_q="select * from favourites where username='$user' ";
              $query_run=pg_query($dbconn,$run_q);
              while($run_que=pg_fetch_array($query_run))
              {  
			 
			 $prodimg=$run_que['rec_img'];
			 $prodtitle=$run_que['rec_name'];
             $cat=$run_que['category'];
             $id=$run_que['rec_id'];
              echo "
              <tr>
					<td>
					<img src='$prodimg' style='width:80px;height:80px'>
					</td>
					<td>
					$prodtitle
					</td>
					<td>
					$cat
					</td>
					<td>
					<a href='favourite.php?del=$id' class='btn btn-primary'>
            <i class='fa fa-remove' ></i> 
            </a>
					</td>

					</tr>";
			}
		}
				?>
				
			</tbody>
		</table>  
	</div>
	</form>

	
</div>
</div>
</div>
</BODY>
</html>