<?php
session_start();
include_once("condb.php");

if(isset($_POST["users"]))
    {
      foreach ($_POST["users"] as $key => $value) {
        if(mysqli_query($con,"DELETE FROM user WHERE user_id=$value;")&&mysqli_query($con,"DELETE FROM auto WHERE driver_id=$value;"))
        echo("$value done");
        else
        echo("$value not done");
      }
     /* $rec = mysqli_query($con,"SELECT driver_id from user INNER JOIN auto ON user.user_id=auto.driver_id WHERE user.user_type='RikshaOwner' AND user.status='Approved'");
     
      echo "<script> alert('we are here');<script>";
            while($row=mysqli_fetch_row($rec))
        { 
          echo "<script> alert('$row[0]');<script>";
            if(isset($_POST[$row[0]]))
              {
                mysqli_query($con,"DELETE * FROM auto WHERE driver_id=$row[0]");
                echo "<script> alert('Records deleted Successfully.');<script>";
              }
        }*/
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Remove</title>
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
                    <li class="nav-item  ">
                        <a class="nav-link"  href="dashboard.php">Dashboard</a>
                          </li>
                            <li class="nav-item  ">
                              <a class="nav-link " href="pendingrequest.php">Pending Request</a>
                            </li>
                            <li class="nav-item active">
                              <a class="nav-link " style="color:#f7c60b" href="remove.php">Auto Remove</a>
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

<form action="remove.php" method="POST" >
<div class="container">
        <table class="table" style="margin-top: 16px;">
                <thead class="thead-dark">
                  <tr>
                    <th><input type="checkbox" onClick="allselect(this)"/>All</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Auto No.</th>
                    <th>Mobile No.</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                $query="SELECT auto.driver_id, user.first_name,user.last_name,user.email,auto.auto_no,user.mob_no from user INNER JOIN auto ON user.user_id=auto.driver_id WHERE user.user_type='RikshaOwner' AND user.status='Approved'";
                 $result=mysqli_query($con,$query);
                 $i=1;
                 while($row=mysqli_fetch_row($result))
                {
                  ?>
                  <tr>
                    <td><lable><?= $i?> </lable><input type="checkbox" name="users[]" value="<?=$row[0]?>"></td>
                    <td><?=$row[1]?></td>
                    <td><?=$row[2]?></td>
                    <td><?=$row[3]?></td>
                    <td><?=$row[4]?></td>
                    <td><?=$row[5]?></td>
                  </tr>
                  <?php
                  $i++;
                }
                ?>
                </tbody>
              </table>
              <input type="submit" style="background-color: #f7c60b;align:center" class="btn btn-lg" name="d" value="Delete"><br>
         
</div>

</form>
<script language="JavaScript">
     
 </script>


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
