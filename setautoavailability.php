<?php
include_once("condb.php");
if($_GET["checkedstatus"]=="true")
mysqli_query($con,"update auto set auto_availablity_status='Available' where auto_id=".$_GET["autoid"]);
else if($_GET["checkedstatus"]=="false")
mysqli_query($con,"update auto set auto_availablity_status='Not Available' where auto_id=".$_GET["autoid"]);
$result=mysqli_query($con,"select auto_availablity_status from auto where auto_id=".$_GET["autoid"]);
$row=mysqli_fetch_row($result);
echo $row[0];
?>