<?php
include_once("condb.php");
session_start();
if(isset($_POST["submit"]))
{
$driverid=$_SESSION["driverid"];
$type=$_POST["type"];
$amount=$_POST["amount"];
mysqli_query($con,"INSERT INTO `expenses`(`driver_id`, `date`, `expenses_amount`, `expenses_type`) VALUES ($driverid,sysdate(),$amount,'$type')");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Expenses</title>
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
     width: 100%;php
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
                            <div class="d-flex justify-content-start">
                            <ul class="navbar-nav ml-auto">
                  <li class="nav-item " >
                    <a class="nav-link" href="rikshaOwnerSeeRequest.php" >Request</a>
                  </li>
                  <li class="nav-item  " >
                        <a class="nav-link"   href="report.php" >Report</a>
                      </li>
                      <li class="nav-item  active" >
                        <a class="nav-link" style="color:#f7c60b" href="expenses.php" >Expenses</a>
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
              <form action="expenses.php" method="POST">
                    <div class="Column">
                            <div  class="md-form">RikshaOwner
                                    Add Expenses:
                                   <select style="border:1px solid #f8f9fa" class="form-control " name="type" required>
                                           <option value="petrol">Petrol</option>
                                          <option value="servicing">Servicing</option>
                                          <option value="other">Other</option>
                                         </select>
                                     </div>
                                
                             <div class="form-group">
                                    <label for="amount">Add:</label>
                                    <input type="text" class="form-control input-lg" id="amount" name="amount" placeholder="Enter expenses">
                                    <span class="help-block"></span>
                                  </div>
                            <!-- Grid row -->
                          
                            <!-- Grid row -->
                            <div class="form-group row">
                              <div class="col-sm-10">
                                <button type="submit" name="submit" class="btn btn-default btn-lg">Add</button>
                          
                              </div>
                            </div>
                    </div>
                </form>
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
