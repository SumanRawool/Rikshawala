<?php
include_once("condb.php");

if(isset($_GET["requestid"]))
{
    $requestid=$_GET["requestid"];
    $result=mysqli_query($con,"select request_status from request where request_id=".$requestid);
    $row=mysqli_fetch_row($result);
    echo $row[0];
}
?>