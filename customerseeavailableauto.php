<?php
include_once("condb.php");
session_start();

if(!isset($_SESSION["user_id"]))
header("location:login.php");
if($_SESSION["user_type"]!="Customer")
header("location:login.php");
if(!isset($_GET["requestid"]))
header("location:customerMakeRequest.php");

$requestid=$_GET["requestid"];
$result=mysqli_query($con,"select user.photo,concat(user.first_name,' ',user.last_name),auto.auto_no,user.mob_no,user.user_id from user inner join auto on user.user_id=auto.driver_id where auto.auto_availablity_status='Available'");

if(isset($_POST['send']))
{
$requestid=$_POST["requestid"];
$driverid=$_POST["driverid"];
mysqli_query($con,"update request set auto_id=(select auto_id from auto where driver_id=$driverid),request_status='Pending' where request_id=$requestid");
header("location:customerrequestpending.php?requestid=".$requestid);
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
</head>
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
<div class="container">
  <div id="mdb-preloader" class="flex-center">
    <div id="preloader-markup"></div>
  </div>
  <!-- Start your project here-->
  <div style="height: 100vh">
    
 <div class="Column">
   <?php
   while($row=mysqli_fetch_row($result))
   {
   ?>
   <form action="customerseeavailableauto.php" method="POST">
      <div class="col-sm-4 card" style="margin-top: 15px;margin-left: 0px;margin-bottom: 15px;padding-bottom: 5px;    padding-left: 26px">
        <div class="row" style="padding-top: 5px;">
          <img src="images/<?=$row[0]?>" style="border-radius:70%" height="10%" width="10%">
          <h3 style="font-weignt=bold;padding-left: 10px;margin"><?=$row[1]?></h3><h6 class="text-muted" style="padding-left: 16px;"><?=$row[2]?><br></h6>
         </div>
          <span class="text-muted" style="padding-left: 30px;"><?=$row[3]?><br></span> 
      <div class="row" style=" margin-left: -6px;margin-top: -6px;">

      <input type="hidden" name="requestid" value="<?=$requestid?>">
      <input type="hidden" name="driverid" value="<?=$row[4]?>">

     <input type="submit" style="background-color: #f7c60b;    margin-right: 71px;" class="btn col-sm-4 btn-sm"  name="send" value="Send"/>
      <input type="submit"  style="background-color:#6c757d " class="btn  col-sm-4 btn-sm"  name="cancel" value="Cancle"/>
    </div>
      </div>
      </form>
<?php
}
?>
    </div>
    </div>
 
  <!-- Grid row -->


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
</body>

</html>
