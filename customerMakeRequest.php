
<?php
include_once("condb.php");
session_start();

if(!isset($_SESSION["user_id"]))
header("location:login.php");
if($_SESSION["user_type"]!="Customer")
header("location:login.php");

if(isset($_POST["btnNext"]))
{
  $userid=$_SESSION["user_id"];
  $source=$_POST["from"];
  $destination=$_POST["to"];
  mysqli_query($con,"insert into request(customer_id, request_status,source,destination) values($userid,'Created','$source','$destination')");
  $result=mysqli_query($con,"select last_insert_id() from dual;");
  $row=mysqli_fetch_row($result);
  header("location:customerseeavailableauto.php?requestid=".$row[0]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">-->
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
            <li class="nav-item active">
              <a class="nav-link " style="color:#f7c60b" href="customerMakeRequest.php">Location</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link "  href="customerseeavailableauto.php">Active Autos</a>
            </li>
            <li class="nav-item ">
                  <a class="nav-link " href="customerprofile.php">Profile</a>
                </li>
                <li class="nav-item ">
              <a class="nav-link" href="login.php">Log out</a>
            </li>
          </ul>
</div>
</nav>
<div class="container">
  
  <div id="mdb-preloader" class="flex-center">
    <div id="preloader-markup"></div>
  </div>
  <!-- Start your project here-->
  <div style="height: 100vh">
    <form action="customerMakeRequest.php" method="POST">
    <label for="from">From</label>
  <input type="text" id="from" name="from" class="form-control">
  
  <label for="to">To </label>
  <input type="text" name="to" id="to" class="form-control">
  <br>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" style="background-color: #f7c60b" name="btnNext" class="btn btn-md">Next</button>
      
    </div>
  </div>
  <!-- Grid row -->
</form>

  </div>
</div>
  <!-- /Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
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
