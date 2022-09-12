<?php
include_once("condb.php");
if(isset($_POST["submit"]))
{
    if($_POST["type"]=='RegionAdmin')
    {
        $region=$_POST["region"];
     $result=mysqli_query($con,"select * from region where region_name='$region'");
        if(mysqli_num_rows($result)>0)
        exit("<script>alert('Selected region is already registerd');window.location.href='registration.php';</script>");
    }

	$firstname=trim($_POST["first_name"]);
	$lastname=trim($_POST["last_name"]);
	$mobilenumber=$_POST["mobile_no"];
	$adharno=$_POST["adhar_no"];
	$gender=$_POST["gender"];
	$date=$_POST["date"];
    $email=$_POST["email"];
    $password="null";
    if($_POST["password"]==$_POST["password2"])
    {
    $password=$_POST["password2"];
    }
    else
     {
        exit("<script>alert('password does not match');window.location.href='registration.php';</script>");
    }
    $address=$_POST["address"];
	$type=$_POST["type"];
    $autonumber=(isset($_POST["auto_no"]))?$_POST["auto_no"]:"null";
    $region="abc";
    $regionid=9;
    if(isset($_POST["region"]))
    {if (preg_match('#[0-9]#',$_POST["region"]))
        $regionid=$_POST["region"];
        else
        $region=$_POST["region"];
    }
    $license=null;
    if(isset($_FILES["photo"]))
    {
    $path_parts = pathinfo($_FILES["photo"]["name"]);
    $extension = $path_parts['extension'];
    $photo=$firstname.$lastname."-photo".".".$extension;
    move_uploaded_file($_FILES["photo"]["tmp_name"],"images/".$firstname.$lastname."-photo".".".$extension);    
}
if(isset($_FILES["adharcard"]))
{
    $path_parts = pathinfo($_FILES["adharcard"]["name"]);
    $extension = $path_parts['extension'];
    $adharcard=$firstname.$lastname."-adharcard".".".$extension;
	move_uploaded_file($_FILES["adharcard"]["tmp_name"],"images/".$firstname.$lastname."-adharcard".".".$extension);
}
if(isset($_FILES["license"]))
{
    $path_parts = pathinfo($_FILES["license"]["name"]);
    $extension = $path_parts['extension'];
    $license=$firstname.$lastname."-license".".".$extension;
    move_uploaded_file($_FILES["license"]["tmp_name"],"images/".$firstname.$lastname."-license".".".$extension);
}
	$query="SELECT * FROM user where email='$email'";
	$data=mysqli_query($con,$query);
	$total=mysqli_num_rows($data);
	if($total>0)
	{
		echo "<script>alert('It seems Like you Have Already Register');</script>";
	}
	else
	{   
		$result=mysqli_query($con,"call insertuser('$firstname','$lastname','$password','$type','$address','$adharno','$mobilenumber','$gender','$date','$email','$autonumber','$photo','$adharcard','$license','$region',$regionid);");
		if($result)
		{
			echo "<script>alert('Registration Successful.');window.location.href=\"login.php\";</script>";
		}
		else{

			echo "<script>alert('Data can not Inserted.Please insert proper data.');</script>";
		}
	}
}
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' data: gap: https://ssl.gstatic.com 'unsafe-inline'; style-src 'self' 'unsafe-inline'; media-src *; img-src 'self' data: content:;connect-src *">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=eedge">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="cordova.js"></script>
  <script src="js/adminregistration.js"></script>
  <title>registration</title>
  <style> 
        .card:hover  {
      box-shadow:0  30px 70px rgba(180, 176, 176, 0.2);
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
                                      <a class="nav-link" href="#">Home</a>
                                    </li>
                                    <li class="nav-item active">
                                      <a class="nav-link" style="color:#f7c60b" href="registration.php">Registration</a>
                                    </li>
                                    <li class="nav-item ">
                                      <a class="nav-link" href="login.php">Log in</a>
                                    </li>
                                  </ul>
            </div>
              </nav>


<!-- Open form tag -->

<form name="form" id="form"  action="registration.php" method="POST" enctype="multipart/form-data" >
    <div class="container" style="width:600%">
  <div id="mdb-preloader" class="flex-center">
    <div id="preloader-markup"></div>
  </div>
  <!-- Start your project here-->
  <div class="col-sm-12" style="margin-top: 20px;padding-top: 10px;margin-bottom: 73px;">
    <div class="card" style="padding:20pt">
      <center><img src="logo1.png"  height="100" width="100" alt="">
        <h2>Registration</h2>
      </center>
      <div class="row">
        <div class="col">
            <label for="last_name">First name</label>
  <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First name" required >
        </div>
        <div class="col">
        <label for="last_name">last name</label>
  <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last name" required>  
</div>
  </div>



  <div class="row">
      <div class="col">
          <label for="mobile_no">Mobile No.</label>
              <input type="text" id="mobile_no" class="form-control" name="mobile_no" placeholder="Mobile no" required>              
              </div>
              <div class="col">
                  <label for="adhar_no">Adhar No.</label>
                  <input type="text" id="adhar_no" class="form-control" name="adhar_no" placeholder="Adhar No." required>                
                  </div>
                </div>



  <div class="row">
  <div class="col">
          I am:
         <select style="border:1px solid #f8f9fa" class="form-control" id="gender" name="gender" required>
                 <option value="Male">Male</option>
                <option value="Female">Female</option>
               </select>
           </div>
           <div class="col">
                  Date
               <input type="date" id="date" class="form-control datepicker" name="date" required>
           </div>
</div>

<div class="row">
    <div class="col">
        <label for="password">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>            
    </div>
    <div class="col">
        <label for="password">confrom Password</label>
            <input type="password" id="password2" class="form-control" name="password2" placeholder="conform Password" required>
          </div>
    </div>


    <div class="row">
        <div class="col">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>               
                </div>               
                <div class="col">
                         <label for="address">Address</label>  
                        <input type="text" id="address" class="form-control" name="address" placeholder="Address" required>
                </div>

                <script>
                function response()
                 {
                   var data=document.getElementById("type").value;
                   if(data=='RegionAdmin'){
                    document.getElementById('auto_no').setAttribute("disabled","true");
                    document.getElementById("regionspan").innerHTML="<input type='text' id='region' class='form-control' name='region' placeholder='Region' required>";
                   }
                 
                 if(data=='Customer')
                 {

                    document.getElementById('license').disabled=true;
                    document.getElementById('auto_no').setAttribute("disabled","true");
                  document.getElementById("regionspan").innerHTML="<input type='text' id='region' class='form-control' name='region' placeholder='Region' disabled required>";
                   
                 }
                 if(data=="RikshaOwner")
                 {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("regionspan").innerHTML = this.responseText;
                    }
                    };
                    xmlhttp.open("GET", "getregions.php", true);
                    xmlhttp.send();
                    document.getElementById('auto_no').removeAttribute("disabled");
                    document.getElementById('license').removeAttribute("disabled");
                
                 }
                
                 }

                </script>
            <div class="col">
                Type:
         <select style="border:1px solid #f8f9fa" class="form-control" id="type" name="type" onclick="response()" required>
                 <option value="RegionAdmin" >Region Admin</option>
                <option value="RikshaOwner">Driver</option>
                <option value="Customer">Customer</option>
               </select>
              </div>
                </div><br>

    <div class="row">
    <div class="col">
        <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="photo" >
              <label class="custom-file-label" for="inputGroupFile01">Photo</label>
            </div>
          </div>
          </div>
    <div class="col">
        <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon01" name="adharcard" >
              <label class="custom-file-label" for="inputGroupFile01">Adharcard</label>
            </div>
          </div>
          </div>
          <div class="col">
              <div class="input-group">
              <div class="custom-file">
                  <input type="file" class="custom-file-input" id="license" aria-describedby="inputGroupFileAddon01" name="license" >
                  <label class="custom-file-label" for="inputGroupFile01">License</label>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
              <div class="col">
                  
                  <label for="region">Region</label>  
                  <span id="regionspan">               
                      <input type="text" id="region" class="form-control" name="region" placeholder="Region" required>
                      </span>
                </div>
                      
                      <div class="col">
                      <label for="auto_no">Auto no</label>
                              <input type="text" id="auto_no" class="form-control" name="auto_no" placeholder="Auto no." required>
                              
                              </div>

                      </div>

<br>
<div class="md-form" >
        <input type="submit" style="background-color: #f7c60b" id="submit" class="btn" value="Register" name="submit" >
      </div>   
      <div class="row"></div>Already register user?<a href="login.html">Log in</a> </div>     
</div>

</div>
</form>
  <div class="footer">
        <p>© 2019 Copyright:Rikshawala.com</p>
      </div>
</body>
</html>