<?php
session_start();
include_once("condb.php");

$query="select auto.auto_id,user.mob_no, auto.auto_no,CONCAT(user.first_name,' ',user.last_name),user.photo from auto inner join user on auto.driver_id=user.user_id where auto.auto_approval_status='Pending'";
$result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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
                    <li class="nav-item  ">
                        <a class="nav-link"  href="dashboard.php">Dashboard</a>
                          </li>
                            <li class="nav-item active ">
                              <a class="nav-link " style="color:#f7c60b" href="pendingrequest.php">Pending Request</a>
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
    
              <div class="Column">
                  <div class="row">
<?php
while($row=mysqli_fetch_row($result))
{ 
?>

                    <div class="col-sm-4 " style="margin-top: 21px;margin-left: 30px;">
                    <a href="autoapproval.php?autoid=<?=$row[0]?>" style="text-decoration:none;">
                    <div class="card p-2">
                    <h3><?=$row[2]?></h3>
                      <img src="images/<?=$row[4]?>"height="10%" width="10%">
                      <span class="text-muted"><p style="margin-bottom: 0rem;">Name:<?=$row[3]?></p>
                      <p>Mob. No.:<?=$row[1]?></p></span>
                    <!--  <input type="button"  class="btn btn-warning" name="cancle" value="Decline">
                    <input type="button"  class="btn btn-info" name="Login" value="Accept">-->
                    </div></a>
                </div>

<?php
}
?>
                    
                    <div class="footer">
                            <p>© 2019 Copyright:Rikshawala.com</p>
                          </div>
</body>
</html>