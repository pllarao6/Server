<?php

require_once("global.php");

$userid=$_GET['UserId'];

$q="SELECT * FROM user where UserId=".$userid;

$res=mysqli_query($dbhandle,$q);

$row=mysqli_fetch_array($res);

echo json_encode(array("Name"=>$row[1],"Email"=>$row[2],"Mobile"=>strval($row[4])));
?>