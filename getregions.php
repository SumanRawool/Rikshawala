<?php
include_once("condb.php");
$result=mysqli_query($con,"select region_id,region_name from region");
echo "<select name='region' class='form-control'>";
while($row=mysqli_fetch_row($result))
{
    echo "<option value='".$row[0]."'>".$row[1]."</option>";
}
echo "</select>";
?>