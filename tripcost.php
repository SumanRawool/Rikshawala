<?php
session_start();
include_once("condb.php");

$requestid=$_GET["requestid"];
$result=mysqli_query($con,"select trip_cost,trip_id from trip where request_id=".$requestid);
$row=mysqli_fetch_row($result);
$tripcost=$row[0];
$tripid=$row[1];

if(isset($_POST["submit"]))
{
$tripcost=$_POST["tripcost"];
$tripid=$_POST["tripid"];
$rating=$_POST["rating"];
$comment=$_POST["comment"];
echo $tripcost.$tripid.$rating.$comment;
mysqli_query($con,"INSERT INTO `feedback`(`customer_id`, `trip_id`, `rating`, `comment`) VALUES ((select customer_id from request where request_id=(select request_id from trip where trip_id=$tripid)),$tripid,$rating,'$comment')");
echo "<script>alert('Feedback submited successfully');window.location.href='customerMakeRequest.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Active trip</title>
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
              <a class="nav-link " href="customerMakeRequest.php">Location</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link " style="color:#f7c60b"  href="customerseeavailableauto.php">Active Autos</a>
            </li>
            <li class="nav-item ">
                  <a class="nav-link " href="profile.html">Profile</a>
                </li>
                <li class="nav-item ">
              <a class="nav-link" href="login.php">Log out</a>
            </li>
          </ul>
</div>
</nav>

<form action="tripcost.php" method="POST">
    <div class="container">
      <div id="mdb-preloader" class="flex-center">
        <div id="preloader-markup"></div>
      </div>
                <div class="col-sm-12" style="margin-top: 20px;padding-top: 10px;">
             <div class="card" style="padding: 27pt;">
        <center>
          <h2>Trip Cost</h2>
        </center>
          
                <center> <div class="form-group" ></div>
                    <h1> Your trip cost is<br>₹<?=$tripcost?>
                    
                </h1>
                <input type="hidden" name="tripid" value="<?=$tripid?>">
                <input type="hidden" name="tripcost" value="<?=$tripcost?>">
                <input type="number" class="form-control" placeholder="Ratings" min=0 max=5 name="rating" preloader="Ratings in Number"><br>
             <textarea name="comment" class="form-control" placeholder="Comment About trip"></textarea>
                <input type="submit" style="background-color: #151517"class="btn btn-md" value="Submit" name="submit">
           </center>
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
