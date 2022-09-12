<?php
session_start();
include_once("condb.php");
     $userid=$_SESSION["user_id"];
     $result=mysqli_query($con,"select concat(first_name,' ',last_name),mob_no,address,email,adhar_no,gender,date,photo,adharcard from user where user_id=".$userid);////.$_GET["customerid"]
      $row=mysqli_fetch_row($result);
      $name=$row[0];
      $mobileno=$row[1];
      $address=$row[2];
      $email=$row[3];
      $aadhar=$row[4];
      $gender=$row[5];
      $dateofbirth=$row[6];
      $photo=$row[7];
      $adharcard=$row[8];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet">
  <script type="text/javascript" src="js/mdb.js"></script>
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
.lb{
    color: #f7c60b;
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
            <li class="nav-item ">
              <a class="nav-link "   href="customerseeavailableauto.php">Active Autos</a>
            </li>
            <li class="nav-item active">
                  <a class="nav-link " style="color:#f7c60b" href="customerprofile.php">Profile</a>
                </li>
                <li class="nav-item ">
              <a class="nav-link" href="login.php">Log out</a>
            </li>
          </ul>
</div>
</nav>
            <form action="customer.php" method="POST">
              <div class="container">
                   <div class="col-sm-12" style="margin-top: 20px;padding-top: 10px;margin-bottom: 73px;">  
                            <div class="card" style="padding: 27pt;margin-bottom: 15px;padding-top: 6px;">
                       <center> <h2>Profile</h2><br><img src="images/<?=$photo?>" class="rounded-circle" height="90" width="90" alt=""> </center><br>
                      <div class="row">
                          <div class="col">
                                <label class="lb">Name</label>
                                <h4><?=$name?></h4>
                          </div>
                          <div class="col">
                                <label class="lb">Mobile No.</label>
                                <h4><?=$mobileno?></h4>
                          </div>
                          <div class="col">
                                <label class="lb">Address</label>
                                <h4><?=$address?></h4>
                          </div>
                        </div><br>
                          <div class="row">
                                <div class="col">
                                      <label class="lb">Email</label>
                                      <h4><?=$email?></h4>
                              </div>
                              <div class="col">
                                  <label class="lb">Adhar No.</label>
                                  <h4><?=$aadhar?></h4>
                            </div>
                            <div class="col">
                                  <label class="lb">Gender</label>
                                  <h4><?=$gender?></h4>
                            </div>                          
                     
                    </div><br>
                    <div class="row">
                           
                            <div class="col">
                                  <label class="lb">DoB</label>
                                  <h4><?=$dateofbirth?></h4>
                            </div>
                            <div class="col">
                                  <label class="lb">Aadhar Card</label><br>
                                  <img src="images/<?=$adharcard?>" height="50pt" width="50pt">
                            </div>                               
                    </div>
                                             
                                 
            </div>
            </form>
                    <div class="footer">
                            <p>© 2019 Copyright:Rikshawala.com</p>
                          </div>
</body>
</html>