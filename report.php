<?php
include_once("condb.php");
session_start();

if(!isset($_SESSION["user_id"]))
header("location:login.php");
if($_SESSION["user_type"]!="RikshaOwner")
header("location:login.php");

$userid=$_SESSION['user_id'];

if(isset($_GET["type"]))
{
  if($_GET["type"]=="today")
  {
  $result=mysqli_query($con,"select sum(trip.trip_cost) as profit from trip INNER join request on trip.request_id=request.request_id inner join auto on request.auto_id=auto.auto_id inner join user on auto.driver_id=user.user_id where trip.trip_date=CURRENT_DATE() and user.user_id=$userid");
  $row=mysqli_fetch_row($result);
  $profit=$row[0];
  $result=mysqli_query($con,"select sum(expenses.expenses_amount) from expenses where date=CURRENT_DATE() and driver_id=$userid");
  $row=mysqli_fetch_row($result);
  $expenses=$row[0];

  $istoday="active";
  $isweek="";
  $ismonth="";
  }
  if($_GET["type"]=="week")
  {
    $result=mysqli_query($con,"select sum(trip.trip_cost) as profit from trip INNER join request on trip.request_id=request.request_id inner join auto on request.auto_id=auto.auto_id inner join user on auto.driver_id=user.user_id where user.user_id=$userid GROUP by YEARWEEK(CURRENT_DATE())");
    $row=mysqli_fetch_row($result);
    $profit=$row[0];
    $result=mysqli_query($con,"select sum(expenses.expenses_amount) from expenses where driver_id=$userid group by YEARWEEK(CURRENT_DATE())");
    $row=mysqli_fetch_row($result);
    $expenses=$row[0];

    $istoday="";
    $isweek="active";
    $ismonth="";
  }
  if($_GET["type"]=="month")
  {
    $result=mysqli_query($con,"select sum(trip.trip_cost) as profit from trip INNER join request on trip.request_id=request.request_id inner join auto on request.auto_id=auto.auto_id inner join user on auto.driver_id=user.user_id where user.user_id=$userid and MONTH(trip.trip_date)=MONTH(CURRENT_DATE())");
    $row=mysqli_fetch_row($result);
    $profit=$row[0];
    $result=mysqli_query($con,"select sum(expenses.expenses_amount) from expenses where driver_id=$userid and MONTH(expenses.date)=MONTH(CURRENT_DATE())");
    $row=mysqli_fetch_row($result);
    $expenses=$row[0];

    $istoday="";
    $isweek="";
    $ismonth="active";
  }
}
else
{
  //today
  $result=mysqli_query($con,"select sum(trip.trip_cost) as profit from trip INNER join request on trip.request_id=request.request_id inner join auto on request.auto_id=auto.auto_id inner join user on auto.driver_id=user.user_id where trip.trip_date=CURRENT_DATE() and user.user_id=$userid");
  $row=mysqli_fetch_row($result);
  $profit=$row[0];
  $result=mysqli_query($con,"select sum(expenses.expenses_amount) from expenses where date=CURRENT_DATE() and driver_id=$userid");
  $row=mysqli_fetch_row($result);
  $expenses=$row[0];

  $istoday="active";
  $isweek="";
  $ismonth="";
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Report</title>
  <!-- Font Awesome -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="js/bootstrap.min.js" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="chart.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Petrol',     11],
          ['Expenses',      2],
          ['Profit',  2],
         
        ]);

        var options = {
          title: 'My Daily Report'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
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
                            <label class="switch ml-auto">
                            
                            <div>
                           <div class="text-right">
              
                            <ul class="navbar-nav ml-auto">
                  <li class="nav-item " >
                    <a class="nav-link" href="rikshaOwnerSeeRequest.php" >Request</a>
                  </li>
                  <li class="nav-item active " >
                        <a class="nav-link" style="color:#f7c60b"  href="report.php" >Report</a>
                      </li>
                      <li class="nav-item  " >
                        <a class="nav-link"href="expenses.php" >Expenses</a>
                      </li>
                      <li class="nav-item ">
                        <a class="nav-link" href="driverprofile.php">Profile</a>
                      </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="login.php">log out</a>
                  </li>
                </ul>
                </div>
            </div>
              </nav>
            </div>
              </nav>
              <div class="container">
                  <div class="col-lg-12 col-sm-12">
                        <ul class="nav nav-tabs" style="width:100%;padding-top: 43px;">
                            <li class="nav-item">
                              <a class="nav-link <?=$istoday?>" href="report.php?type=today">Today</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link <?=$isweek?>" href="report.php?type=week">Weekly</a>
                            </li>
                            <li class="nav-item <?=$ismonth?>">
                              <a class="nav-link" href="report.php?type=month">monthly</a>
                            </li>
                          </ul>
                          <div class="col-sm-12 card" style="margin: 10px">
                        
                              <h3 style="margin-left:10px;margin-top:10px" >Profit</h3>
                              <span style="text-align: center;margin-bottom: 20px;display: inline-block">
                              <span class="text-muted" style="font-size: 30px ;font-weight: bold;">₹<?=$profit?></span></span>
                         
                            </div>
                          
                            <div class="col-sm-12 card" style="margin: 10px">
                              <h3 style="margin-left:10px;margin-top:10px">Expenses</h3>
                               <span style="text-align: center;margin-bottom: 20px;display: inline-block">
                              <span class="text-muted" style="font-size: 30px ;font-weight: bold;display:inline-block">₹<?=$expenses?></span></span>
                            </div>
                
                <center>
                <span style="height: 10px"class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <div id="piechart" style="width: 900px; height: 500px;"></div>
                </center>
                
                
            </div>
                <!-- Horizontal material form -->
                  </div>
  <!-- /Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>

        <p>© 2019 Copyright:Rikshawala.com</p>
      </div>
</body>

</html>
