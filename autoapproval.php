<?php
include_once("condb.php");
if(isset($_GET["autoid"]))
{
     $result=mysqli_query($con,"select concat(user.first_name,' ',user.last_name),user.mob_no,user.address,auto.auto_no,region.region_name,user.email,user.adhar_no,user.gender,user.date,user.photo,user.adharcard,user.license from user INNER JOIN auto on auto.driver_id=user.user_id INNER JOIN region on region.region_id=auto.region_id where auto_id=".$_GET["autoid"]);
      $row=mysqli_fetch_row($result);
      $autoid=$_GET["autoid"];
      $name=$row[0];
      $mobileno=$row[1];
      $address=$row[2];
      $autono=$row[3];
      $region_name=$row[4];
      $email=$row[5];
      $aadhar=$row[6];
      $gender=$row[7];
      $dateofbirth=$row[8];
      $photo=$row[9];
      $aadharcard=$row[10];
      $lincens=$row[11];
}
if(isset($_POST["accept"]))
{
mysqli_query($con,"update auto set auto_approval_status='Approved' where auto_id=".$_POST["autoid"]);
mysqli_query($con,"update user set status='Approved' where  user_id=(select driver_id from auto where auto_id=".$_POST["autoid"].")");
echo "<script>alert('Approved successfully');</script>";
header("location:dashboard.php");
}
if(isset($_POST["decline"]))
{
      mysqli_query($con,"update auto set auto_approval_status='Declined' where auto_id=".$_POST["autoid"]);
      mysqli_query($con,"update user set status='Declined' where  user_id=(select driver_id from auto where auto_id=".$_POST["autoid"].")");
      echo "<script>alert('Declined successfully');</script>";
      header("location:home.php");
}
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
                                      <a class="nav-link" href="home.html">Home</a>
                                    </li>
                                    <li class="nav-item ">
                                      <a class="nav-link" href="registration.html">Registration</a>
                                    </li>
                                    <li class="nav-item ">
                                      <a class="nav-link" href="login.html">Log in</a>
                                    </li>
                                    <li class="nav-item ">
                                          <a class="nav-link active" style="color:#f7c60b" href="profile.html">Profile</a>
                                        </li>
                                    <li class="nav-item">
                                      <a class="nav-link " href="remove.html">Remove auto</a>
                                    </li>
                                  </ul>
             
            </div>
              </nav>
            <form action="autoapproval.php" method="POST">
              <div class="container">
                   <div class="col-sm-12" style="margin-top: 20px;padding-top: 10px;margin-bottom: 73px;">  
                            <div class="card" style="padding: 27pt;margin-bottom: 15px;padding-top: 6px;">
                       <center> <h2>Profile</h2><br><img src="logo1.png"  height="100" width="100" alt=""> </center><br>
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
                                      <label class="lb">Auto No.</label>
                                      <h4><?=$autono?></h4>
                                </div>
                                <div class="col">
                                      <label class="lb">Region</label>
                                      <h4><?=$region_name?></h4>
                                </div>
                                <div class="col">
                                      <label class="lb">Email</label>
                                      <h4><?=$email?></h4>
                                </div>                         
                     
                    </div><br>
                    <div class="row">
                            <div class="col">
                                  <label class="lb">Adhar No.</label>
                                  <h4><?=$aadhar?></h4>
                            </div>
                            <div class="col">
                                  <label class="lb">Gender</label>
                                  <h4><?=$gender?></h4>
                            </div>
                            <div class="col">
                                  <label class="lb">DoB</label>
                                  <h4><?=$dateofbirth?></h4>
                            </div>                            
                    </div>


                    <div class="row">
                            <div class="col">
                                  <label class="lb">Photo</label>
                                  <img src="images/<?=$photo?>" height="20pt" width="20pt">
                            </div>
                            <div class="col">
                                  <label class="lb">Aadhar Card</label>
                                  <img src="images/<?=$aadharcard?>" height="20pt" width="20pt">
                            </div>
                            <div class="col">
                                  <label class="lb">Driving Lincens</label>
                                  <img src="images/<?=$lincens?>" height="20pt" width="20pt">
                            </div>                       
                            <input type="hidden" name="autoid" value="<?=$autoid?>">     
                    </div>

                    </div>
                    <input type="submit"  class="btn btn-warning" name="accept" value="Accept">
                    <input type="submit"  class="btn btn-info" name="decline" value="Decline">
                </div> 
            </div>
            </form>
                    <div class="footer">
                            <p>© 2019 Copyright:Rikshawala.com</p>
                          </div>
</body>
</html>