
<?php
include("db.php");
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
        input,button:focus {
             outline:none;
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
            margin-top: 7.5vh;
            height: auto;
            position: fixed;
        }
        .signin_form{
            padding-left: 10%;
            padding-right: 10%;
            padding-top: 1.5%;
            padding-bottom: 1.5%;
            /* text-align: center; */
        }
        .field{
            margin: 3.5%;
            border-radius: 35px;
        }
        input{
            /* color: rgb(0, 11, 160); */
            padding: 2%;
            width: 95%;
            color: black;
            font-weight: bold;
            background-color: white;
            border-radius: 20px;
            align-content: center;
            border: 1px solid rgb(0, 0, 189);
        }
        .loginbutton{
            background-color: rgb(251, 5, 5);
            padding: 2%;
            color: white;
            font-weight: bold;
            width: 40%;
            border-radius: 15px;
            border: 0.5px solid rgb(243, 5, 5);
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
        <form class="signin_form" name="signupform" method="post">
            <div>
            <h1 style="text-align: center;">  <a href="Login.php" class="choice"> Sign In </a> <span style="color: rgba(0, 0, 0, 0.712);">|</span> <a href="#" class="choice" > Sign Up </a></h1>
            </div>
            <div class="field">
                <label for="email" style="clear: both; float:left; font-weight: bold;">FIRST NAME</label> <br>
                <input style="text-align: center;" type="text" placeholder="ENTER YOUR FIRST NAME" name="First_Name" id="" required>
            </div>
            <div class="field">
                <label for="password" style="clear: both; font-weight: bold; float:left;">LAST NAME</label> <br>
                <input style="text-align: center;" type="text" name="Last_Name" placeholder="ENTER YOUR LAST NAME" id=""required>
            </div>
            <div class="field">
                <label for="email" style="clear: both; float:left; font-weight: bold; ">EMAIL</label> <br>
                <input style="text-align: center;" type="email" placeholder="ENTER YOUR EMAIL" name="email" id="" required>
            </div>
            <div class="field">
                <label for="password" style="clear: both; font-weight: bold; float:left;">PHONE NUMBER</label> <br>
                <input style="text-align: center;" type="tel" name="phone" placeholder="ENTER YOUR PHONE NUMBER" id=""required>
            </div>
            <div class="field">
                <label for="password" style="clear: both; font-weight: bold; float:left;">PASSWORD</label> <br>
                <input style="text-align: center;" type="password" name="password" placeholder="ENTER YOUR PASSWORD" id=""required>
            </div>
            <div style="text-align: center; margin-bottom: 2%;">
                <button type="submit" onclick="check2()" name="login" class="loginbutton">
                    SIGN UP
                </button>
            </div> 
        </form>
    </div>
</body>
</html>

<?php

if(isset($_POST['login']))
{
  $namef=$_POST['First_Name'];
  $namel=$_POST['Last_Name'];
  $pass=$_POST['password'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
    $query = "INSERT INTO Account(Fname,Lname,email,phone,password) values ('$namef','$namel','$email',$phone,'$pass')";
    $results = pg_query($dbconn, $query);
    if ($results) {
        echo "<script>alert('User Registerd successfully')</script>";
        echo "<script>window.open('Login.php','_self')</script>";
      }
}

?>