<?php
include("db.php");

session_start();
if(isset($_POST['login']))
{
    
  $names=$_POST['email'];
  $pass=$_POST['password'];
    $query = "SELECT * FROM account WHERE email='$names' AND password='$pass'";
    $results = pg_query($dbconn, $query);
    if (pg_num_rows($results) == 1) {
      while($res=pg_fetch_array($results))
      {
      $name=$res['fname'];
      $_SESSION['email'] = $name;
      echo "<script>window.open('index.php','_self')</script>";
    }
}
    else{
       echo "<script>alert('email or password do not match')</script>";
       echo "<script>window.open('login.php','self')</script>";
       session_destroy();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="auth.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Oxygen&display=swap');    
        body,html{
            top: 0;
            height: 100%;
            font-family: 'Oxygen', sans-serif;
            /* font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; */
        }
        body{
            background-size: cover;
            background-position: center;
            /* background-attachment: fixed; */
            background-repeat: no-repeat;
            background-color: whitesmoke;
            background-image: url('https://www.mallofamerica.com/sites/default/files/2019-05/MOA-Eats-MAY_2019-1920x1080.jpg');
            opacity: 0.925;
        }
        .background{
            background-color: whitesmoke;
            width: 50%;
            margin-left: 25%;
            margin-top: 10vh;
            height: auto;
            position: fixed;
        }
        .signin_form{
            padding-left: 10%;
            padding-right: 10%;
            padding-top: 2.5%;
            padding-bottom: 2.5%;
            /* text-align: center; */
        }
        .field{
            margin: 3.5%;
            border-radius: 35px;
        }
        input{
            /* color: rgb(0, 11, 160); */
            padding: 2.5%;
            width: 95%;
            color: black;
            font-weight: bold;
            background-color: white;
            border-radius: 15px;
            align-content: center;
            border: 1px solid rgb(0, 0, 189);
        }
        input,button:focus {
             outline:none;
            }
        .loginbutton{
            background-color: rgb(3, 3, 168);
            padding: 2%;
            color: white;
            font-weight: bold;
            width: 30%;
            border-radius: 15px;
            border: 0.5px solid black;
            margin-right: 5%;
            cursor: pointer;
            transition: background 0.6s;

        }
        .loginbutton:hover{
            background: #47a7f5 radial-gradient(circle, transparent 1%, #90c4ee 1%) center/15000%;
        }
        hr{
            border: .55px solid rgb(199, 199, 199);
            border-radius: 5px;
        }
        ::placeholder {
            color: rgba(0, 0, 0, 0.973);
            font-weight: bold;
            }
            a:hover{
                color: red;
            }
            a{
                font-weight: bold;
                color: blue;
                text-decoration: none;
            }
            button{
                cursor: pointer;
            }
            .choice{
                color: rgb(0, 0, 0);
                margin: 3%;
            }
            .choice:active
            {
                color:yellow; 
            }
            .choice:hover{
                color:  red;
            }
            label{
                font-style: italic;
            }
    </style>
</head>
<body>
    <div class="background">
        <form class="signin_form" method="post">
            <div>
            <h1 style="text-align: center;">  <a href="Login.php" class="choice"> Sign In </a> <span style="color: rgba(0, 0, 0, 0.712);">|</span> <a href="sign-up.php" class="choice" > Sign Up </a></h1>
            </div>
            <div class="field">
                <label for="email" style="clear: both; float:left; font-weight: bold; margin-bottom: 1%">EMAIL</label> <br>
                <input style="text-align: center;" type="email" placeholder="ENTER YOUR EMAIL" name="email" id="email" required>
            </div>
            <div class="field">
                <label for="password" style="clear: both; font-weight: bold; float:left;margin-bottom: 1%">PASSWORD</label> <br>
                <input style="text-align: center;" type="password" name="password" placeholder="ENTER YOUR PASSWORD" id="password"required>
            </div>
            <div style="text-align: center; margin-bottom: 4%;">
                <button type="submit" onclick="hi()" class="loginbutton" name='login'>
                    LOGIN
                </button>
                <a href="#" style="color: red" > Forgot password?</a>
            </div> 
             <hr>
        </form>
            <div style="text-align: center; margin-bottom: 7.5%;">
                    <span style=" font-size: 100%; color: rgb(4, 31, 58);"> <b> OR </b> <i>  </i> <br> <br> </span>
                    <button style="text-align: center; background-color: red; width:27%; margin: 1%; border: 1px red; border-radius: 20px; padding: 1.5%;"> <span style="font-weight:bold; padding: 5%; text-align: center; color: white; font-size: 120%;">LOGIN WITH</span><i class="fa fa-google" style="font-size:25px;color:white"></i></button>
                    <button style="text-align: center; background-color: blue; width:27.5%; margin: 1%; border: 1px blue; border-radius: 20px; padding: 1.5%;"><span style="font-weight:bold; padding: 5%; color: white; font-size: 120%;">LOGIN WITH</span><i class="fa fa-facebook" style="font-size:25px;color:white"></i></button>
                    <!--        
                     <br>              
                    <a href="#" style="margin: 1.5%;"><i class="fa fa-google" style="font-size:30px;color:red"></i></a>
                    <a href="#" style="margin: 1.5%;"><i class="fa fa-facebook-square" style="font-size:30px;color:blue"></i></a> 
                    -->
            </div>
             <div align="right" >
              <strong>  <p>Developed by<br>
                Aditya Sehgal &nbsp Anuj Shah &nbsp Krupen Shah</p></strong>  </div>
            <!-- <div style="text-align: right; padding: 2.5%;">
                  <b style="margin-right: 2%;"> DON'T HAVE AN ACCOUNT ? </b>
                  <a href="#" style="font-size: 110%; "> Sign up</a>
            </div> -->
    </div>
</body>
</html>




