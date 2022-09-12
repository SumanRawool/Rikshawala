<?php
session_start();
include_once("condb.php");
$userid=$_SESSION["user_id"];

$res1=mysqli_query($con,"select count(*) from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE region.admin_id=".$userid);
$sum1=mysqli_fetch_row($res1);

$res2=mysqli_query($con,"select count(*) from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE user.status='Pending' AND region.admin_id=".$userid);
$sum2=mysqli_fetch_row($res2);

$res3=mysqli_query($con,"select count(*) from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE auto.auto_availablity_status='Available' AND region.admin_id=".$userid);
$sum3=mysqli_fetch_row($res3);
//select concat(user.first_name,' ',user.last_name)from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE region.admin_id=1
//select concat(user.first_name,'',user.last_name)from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE user.status='Pending' AND region.admin_id=1
//select concat(user.first_name,' ',user.last_name) from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE auto.auto_availablity_status='Available' AND region.admin_id=1
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Dashboard</title>
  <!-- Font Awesome -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="chart.js"></script>
<style>
        .checked 
    {
    color: orange;
    }
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
                    <li class="nav-item active ">
                        <a class="nav-link" style="color:#f7c60b" href="dashboard.php">Dashboard</a>
                          </li>
                            <li class="nav-item  ">
                              <a class="nav-link " href="pendingrequest.php">Pending Request</a>
                            </li>
                            <li class="nav-item ">
                              <a class="nav-link "  href="remove.php">Auto Remove</a>
                            </li>
                            <li class="nav-item ">
                                  <a class="nav-link " href="adminprofile.php">Profile</a>
                                </li>
                                <li class="nav-item ">
                              <a class="nav-link" href="login.php">Log out</a>
                            </li>
                          </ul>
            </div>
              </nav>
              <div class="container" style="margin-top:10px">
                  <div class="col-lg-12 col-sm-12">
                      <div class="row">
                          <div class="col">
                              <div class="card border" >
                            <h3 align="center">Total Auto</h3>
                              <h6 align="center" style=" font-size: 6rem;color: #17a2b8;"><?=$sum1[0]?></h6>
                              </div>
                           </div>
                              <div class="col">
                            <div class="card" >
                            <h3 align="center">Pendding Request</h3>
                              <h6 align="center" style=" font-size: 6rem;color: #17a2b8;"><?=$sum2[0]?></h6>
                            </div>
                        </div>
                        <div class="col">
                            
                                        <div class="card " >
                                        <h3 align="center">Active Auto</h3>
                                                  <h6 align="center" style=" font-size: 6rem;color: #17a2b8;"><?=$sum3[0]?></h6>
                                          </div>
                        
                            </div>


                          </div>
                          <div class="row">
                            <div class="col">
                                <div class="card border" >
                                <table class="table">
                                   <tbody>
                                   <?php
                          $query="select concat(user.first_name,' ',user.last_name)from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE region.admin_id=".$userid;
                              $result=mysqli_query($con,$query);
                                    while($row=mysqli_fetch_row($result))
                {
                  ?>
                  <tr>
                    <td align="center"><?=$row[0]?></td>      
                  </tr>
                  <?php
                }
                ?>

                                   </tbody>
                                </table>
                                </div>
                             </div>
                                <div class="col">
                              <div class="card" >
                              <table class="table">
                                   <tbody>
                                   <?php
                          $query1="select concat(user.first_name,'',user.last_name)from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE user.status='Pending' AND region.admin_id=".$userid;
                              $result=mysqli_query($con,$query1);
                                    while($row=mysqli_fetch_row($result))
                {
                  ?>
                  <tr>
                    <td align="center"><?=$row[0]?></td>      
                  </tr>
                  <?php
                }
                ?>
                                   </tbody>
                                </table>
                              </div>
                          </div>
                          <div class="col">
                              
                                          <div class="card " >
                                          <table class="table">
                                   <tbody>
                                   <?php
                          $query2="select concat(user.first_name,' ',user.last_name) from user INNER join auto on user.user_id=auto.driver_id inner join region on auto.region_id=region.region_id WHERE auto.auto_availablity_status='Available' AND region.admin_id=".$userid;
                              $result=mysqli_query($con,$query2);
                                    while($row=mysqli_fetch_row($result))
                {
                  ?>
                  <tr>
                    <td align="center"><?=$row[0]?></td>     
                  </tr>
                  <?php
                }
                ?>
                                   </tbody>
                                </table>
                                           </div>
                          
                              </div>
  
                            </div>

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
