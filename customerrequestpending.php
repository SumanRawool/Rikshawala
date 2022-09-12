<?php
session_start();
include_once("condb.php");

$requestid=$_GET["requestid"];
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
    <script>
        function load(){
            var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText=="Accepted")
                    window.location.href="customerrequestaccepted.php?requestid=<?=$requestid?>";
                    else 
                    setTimeout(load,700);
                    }
                    };
                    xmlhttp.open("GET", "getRequestStatus.php?requestid=<?=$requestid?>", true);
                    xmlhttp.send();
   
        }
        
                     
                    
    </script>
</head>

<body onload="load()">

        <nav class="navbar navbar-expand-sm bg-light sticky-top navbar-light" >

                <a class="navbar-brand site-name" href="#top"><h3 class="wow fadeInLeft" style="margin-top: -1px;">
                        RikshaWala <span style="color:#f7c60b">.com</span>
                    </h3></a>
                    <div>
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item ">
                    <a class="nav-link" href="home.html">Home</a>
                  </li>
                  <li class="nav-<divitem ">
                    <a class="nav-link" href="registration.html">Registration</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" style="color:#f7c60b" href="login.html">Log in</a>
                  </li>
                  <li class="nav-item ">
                        <a class="nav-link" href="profile.html">Profile</a>
                      </li>
                  <li class$requestid="nav-item">
                    <a class="nav-link " href="remove.html">Remove auto</a>
                  </li>
                </ul>
            </div>
              </nav>

<form action="activetrip.php" method="POST">
    <div class="container">
      <div id="mdb-preloader" class="flex-center">
        <div id="preloader-markup"></div>
      </div>
                <div class="col-sm-12" style="margin-top: 20px;padding-top: 10px;">
             <div class="card" style="padding: 27pt;">
        <center>
          <h2>Request Pending</h2>
        </center>
          
                <center> <div class="form-group" >
                    <h1> Your request is pending for approval</h1>
             <!--<input type="submit" style="background-color: #151517"class="btn btn-md" value="Sign in" name="submit">-->
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
