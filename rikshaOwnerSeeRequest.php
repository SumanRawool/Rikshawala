<?php
include_once("condb.php");
session_start();

if(!isset($_SESSION["user_id"]))
header("location:login.php");
if($_SESSION["user_type"]!="RikshaOwner")
header("location:login.php");

$userid=$_SESSION["user_id"];
$result=mysqli_query($con,"select user.photo,concat(user.first_name,' ',user.last_name),user.mob_no,request.source,request.destination,request.request_id from user INNER join request on request.customer_id=user.user_id where request.request_status='Pending' and request.auto_id=(select auto.auto_id from auto where auto.driver_id=$userid)");
$result2=mysqli_query($con,"select concat(user.first_name,' ',user.last_name),user.mob_no,request.source,request.destination,trip.trip_cost from trip INNER join request on trip.request_id=request.request_id INNER JOIN user on request.customer_id=user.user_id where request.auto_id=(select auto.auto_id from auto where auto.driver_id=$userid)");
if(isset($_POST['accept']))
{
  $requestid=$_POST['requestid'];
  mysqli_query($con,"update request set request_status='Accepted' where request_id=".$requestid);
  header("location:activetrip.php?requestid=$requestid");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Request</title>
  <!-- Font Awesome -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!--  <link href="css/mdb.min.css" rel="stylesheet">-->
  <!--  <link href="css/style.css" rel="stylesheet">-->
    
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
body {
font-family:"Lato",sans-serif;
}
.switch {
position: relative;
display: inline-block;
width: 60px;
height: 34px;
}

.switch input { 
opacity: 0;
width: 0;
height: 0;
}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;
}

input:checked + .slider {
background-color: #2196F3;
}

input:focus + .slider {
box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
-webkit-transform: translateX(26px);
-ms-transform: translateX(26px);
transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
border-radius: 34px;
}

.slider.round:before {
border-radius: 50%;
}

.sidenav {
height: 100%;
width: 0;
position: fixed;
z-index: 1;
top: 0;
left: 0;
background-color: #111;
overflow-x: hidden;
transition: 0.5s;
padding-top: 60px;
}

.sidenav a {
padding: 8px 8px 8px 3;
text-decoration: none;
font-size: 25px;
color: #818181;
display: block;
transition: 0.3s;
}

.sidenav a:hover {
color: #f1f1f1;
}

.sidenav .closebtn {
position: absolute;
top: 0;
right: 25px;
font-size: 36px;
margin-left: 50px;
}

@media screen and (max-height: 450px) {
.sidenav {padding-top: 15px;}
.sidenav a {font-size: 18px;}
}
</style>
</head>

<body> 

    <nav class="navbar navbar-expand-sm bg-light sticky-top navbar-light" >

            <a class="navbar-brand site-name" href="#top"><h3 class="wow fadeInLeft" style="margin-top: -1px;">
                    RikshaWala <span style="color:#f7c60b">.com</span></h3>
                
            </a>
            <label class="switch ml-auto">
                <input type="checkbox" id="status" onclick="changenew(this)" style="display:inline-block;">
                        <span class="slider round"></span>
            </label>
            <div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="home.html">Home</a>
                    </li>
                    <li class="nav-item active" >
                        <a class="nav-link" style="color:#f7c60b" href="rikshaOwnerSeeRequest.php" >Request</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="report.php" >Report</a>
                    </li>
                    <li class="nav-item  " >
                        <a class="nav-link" href="expenses.php" >Expenses</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="driverprofile.php">Profile</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="login.php">Log out</a>
                    </li>
                </ul>
            </div>
    </nav>
    <div class="Column">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php
                        while($row=mysqli_fetch_row($result))
                            {
                    ?>
                    <form action="rikshaOwnerSeeRequest.php" method="POST">
                        <div class="col-sm-4 card" style="margin-top: 15px;padding-right: 30px;margin-left: 35px;margin-right: 17px;margin-bottom: 15px;padding-bottom: 5px; padding-left: 26px">
                            <div class="row" style="padding-top: 5px;">
                                <img src="images/<?=$row[0]?>" style="border-radius:50%" height="20%" width="20%" >
                                <h3 style="font-weignt:bold;padding-left: 10px;"><?=$row[1]?></h3>
                            </div>
                            <span class="text-muted" style="padding-left: 30px;"><?=$row[2]?><br></span>
                            <div class="row">     
                                <h6> From:<?=$row[3]?></h6>
                                <h6 style="padding-left: 48px;">To:<?=$row[4]?></h6>
                               
                            </div>  
                            <input type="hidden" name="requestid" value="<?=$row[5]?>">
                            <div class="row" style=" margin-left: -6px;margin-top: -6px;">
                                <input type="submit" style="background-color: #f7c60b ;margin-left: -15px;" class="btn col-sm-4 btn-sm"  name="decline" value="Decline"/>
                                <input type="submit"  style="color: #212121;margin-left: 5px;" class="btn  col-sm-4 btn-sm"  name="forward" value="Forwad"/>
                                <input type="submit"  style="background-color:#6c757d;margin-left: 7px; " class="btn  col-sm-4 btn-sm"  name="accept" value="Accept"/>
                             </div>
                        </div>
                    </form>
              <?php             
}
              ?>                        
                </div>
            </div>
          
                    <div class="card col-lg-4 col-sm-12 border" style="margin-top:10px;padding-right: -20px;margin-right:-7px;">
                    <div class="card-header" style="background-color:#f9dc6f" align="center"><h5>Trips</h5></div>
                            <div class="row">
                            <?php
                         while($row=mysqli_fetch_row($result2))
                            {
                    ?>
                                <div class="card" style="margin-top: 15px;margin-left: 35px;margin-right: 17px;margin-bottom: 15px;padding-bottom: 5px; padding-left: 26px;padding-right:97px">
                                  <div style="padding-top: 5px;">
                                    <h5 style="font-weignt:bold;padding-left: 10px;"><?=$row[0]?></h5><span class="text-muted" style="padding-left: 30px;"><?=$row[1]?><br></span></div>
                                    
                                      <div class="row">     
                                 <h6> From:<?=$row[2]?>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <span style="">To:<?=$row[3]?></span></h6></div>
                                  <h6> cost:<?=$row[4]?></h6>
                                 
                                </div>
                                <?php             
}
              ?>     
                                               
                                
                            </div>
</div>
                    </div>
            </div>
    </div>
<script>
function changenew(x) {
  var data=x.checked;
  //alert(status);
  var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
               alert(this.responseText);
                if(this.responseText=="Available")
                document.getElementById("status").setAttribute("Checked","true");
                else if(this.responseText=="Not Available")
                document.getElementById("status").removeAttribute("Checked");
                }
                };
                xmlhttp.open("GET","setautoavailability.php?autoid=<?=$_SESSION['autoid']?>&checkedstatus="+data, true);
                xmlhttp.send();
            
}
</script>
<div class="footer">
    <p>© 2019 Copyright:Rikshawala.com</p>
  </div>
  <script type="text/javascript" src="js/jquery.min.js"></script>
</body>

</html>
