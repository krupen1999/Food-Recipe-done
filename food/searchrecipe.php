<?php
include("db.php");
session_start();

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }
?>
<!DOCTYPE HTML>
<HTML>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>E store</title>
</head>
<BODY style="background-color: lightgreen">

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



      	
		<?php
		global $getprod;
		if(isset($_POST['user_query']))
		{ $userq=$_POST['user_query'];
     $getprod="select * from recipe where recipe_name ilike '%$userq%'";
		}
else
{
	$getprod="select * from recipe order by recipe_name";
}
		$runquery=pg_query($dbconn,$getprod);
		while($rowprod=pg_fetch_array($runquery))
		{
			$prodid=$rowprod['recipe_name'];
			 $cat=$rowprod['category'];
			 $prodimg=$rowprod['img'];
			
         echo "
			<div class='col-md-3'>
			<div class='box'style='width:250px;height:330px'>
            <img class='img-responsive center-block' src='$prodimg'>
            <div class='text'>
            <h4>
            $prodid
            </h4>
            </div>
            <p class='price' style='text-align:center'>
              $cat
            </p>
            <p class ='button' >
              <a  href='details.php?submit=$prodid'class='btn btn-primary' style='text-align:center;margin-bottom:5px'>
              View Recipe 
              </a>
            <a href='index.php?submit=$prodid' class='btn btn-primary' >
            <i class='fa fa-star' ></i> Add to Favourites
            </a>
            </p>
            </div>
            </div>
			
             ";		}
	
		?>
			</div>
</div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</BODY>
</HTML>
<?php

if (isset($_GET['submit'])) {
	$name=$_SESSION['name'];
	 $id=$_GET['submit'];
	 $run_prod1="select * from products where prod_id=$id";
$run_q=pg_query($dbconn,$run_prod1);

while($run_prod=pg_fetch_array($run_q))
{
	$getprice1=$run_prod['prod_price'];
	$prodimg1=$run_prod['prod_img'];
			$prodtitle1=$run_prod['prod_title'];

	$getcart="insert into cart(name,prod_img,prod_price,prod_title,prod_id)values('$name','$prodimg1',$getprice1,'$prodtitle1',$id)";
	$rp=pg_query($dbconn,$getcart);

	

	if ($rp) {

		echo "<script>alert('Product added successfully')</script>";
		
	}

}
}
?>