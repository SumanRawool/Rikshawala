<?php
session_start();
include_once("condb.php");
if(isset($_POST['submit']))
{
$email=$_POST["email"];
$password=$_POST["password"];

$query="SELECT concat(first_name,' ',last_name), user_id,email,user_password,user_type FROM user where email='$email' and user_password=sha('$password')";

$data=mysqli_query($con,$query);
if($record=mysqli_fetch_row($data))
{
  $_SESSION['user_id']=$record[1];
  $_SESSION['user_type']=$record[4];
  $_SESSION['user_name']=$record[0];

	if($record[4]=='RegionAdmin'){
 header("location:dashboard.php");
	}
	else if($record[4]=='RikshaOwner')
	{
		$data=mysqli_query($con,"SELECT auto.auto_id,auto.driver_id from user inner join auto on auto.driver_id=user.user_id where user.user_id=".$record[1]." and user.status='Approved'");
		if(mysqli_num_rows($data)>0)
		{
      $row=mysqli_fetch_row($data);
      $_SESSION["autoid"]=$row[0];
      $_SESSION["driverid"]=$row[1];
      echo "<script>alert('Riksha Owner Login Successfull.');</script>";
			header("location:rikshaOwnerSeeRequest.php");	
		}
		else
		{
			echo"<script>alert('Your request is not accepted yet')</script>";
    }    
  }
  else if($record[4]=='Customer')
  {
    echo "<script>alert('Customer Login Successfull.');</script>";
    header("location:customerMakeRequest.php");	
  }
  
	echo "<script>alert('You are Not Registerd yet.');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Log in</title>
  <!-- Font Awesome -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
        .card:hover {
      box-shadow:0 30px 70px rgba(180, 176, 176, 0.2);
      background-color: #f8f9fa;
  }
  .card{
      background-color: #f8f9fa; 
  }
  .footer {
     position: fixed;
     left: 0;
     bottom: 0;
     width: 100%;
     background-color:gray;
     color: white;
     text-align: center;
  }
  .bg-light {
      background-color: #dae0e5!important;
  }
    </style>
</head>

<body>

        <nav class="navbar navbar-expand-sm bg-light sticky-top navbar-light" >

                <a class="navbar-brand site-name" href="#top"><h3 class="wow fadeInLeft" style="margin-top: -1px;">
                        RikshaWala <span style="color:#f7c60b">.com</span>
                    </h3></a>
                    <div>
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item ">
                    <a class="nav-link" href="home.php">Home</a>
                  </li>
                  <li class="nav-<divitem ">
                    <a class="nav-link" href="registration.php">Registration</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" style="color:#f7c60b" href="login.php">Log in</a>
                  </li>
                </ul>
            </div>
              </nav>

<form action="login.php" method="POST">
    <div class="container">
      <div id="mdb-preloader" class="flex-center">
        <div id="preloader-markup"></div>
      </div>
                <div class="col-sm-12" style="margin-top: 20px;padding-top: 10px;">
             <div class="card" style="padding: 27pt;">
        <center><img src="logo1.png"  height="100" width="100" alt=""><br>
          <h2>Log in</h2>
        </center>

        <label for="email">Email</label>
                <input type="text" id="email" class="form-control" name="email" placeholder="Email" required>
                
        
            <label for="password">Password </label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required><br>
                          
                <center> <div class="form-group" >
            
              <input type="submit" style="background-color: #f7c60b;align:center" id="submit" class="btn btn-lg" name="submit" value="Login"><br>
             <!--<input type="submit" style="background-color: #151517"class="btn btn-md" value="Sign in" name="submit">-->
             <h5 style="text-align:center">Don't have an account?<a href="ownerregistration.html">Sign up</a></h5>
            </div></center>
      </div>
    </div>
    </div>
</form>
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.js"></script>
  <div class="footer">
        <p>© 2019 Copyright:Rikshawala.com</p>
      </div>
</body>
</html>
