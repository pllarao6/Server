<?php
$con = mysqli_connect("sql107.byethost8.com","b8_15951173","Vankayala123");
if (!$con)
           {
             die('Could not connect: ' . mysql_error());
           }

mysqli_select_db($con,"b8_15951173_test_user");
$regid=$_REQUEST['regid'];
$mail=$_REQUEST['mail'];
$q="UPDATE user SET CloudRegId='".$regid."' WHERE Email='".$mail."'";
$res=mysqli_query($con,$q);
$re['re']=$mail;
print(json_encode($re));
mysqli_close($con);
?>