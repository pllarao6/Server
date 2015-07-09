<?php
require_once('global.php');

$json=$_REQUEST['json'];
$data=json_decode($json);

$user=$data->KEY_USER;
$email=$data->KEY_EMAIL;
$password=$data->KEY_PASSWORD;
$mobile=$data->KEY_MOBILE;		  
$regid=$data->KEY_REGID;		  		  			

if($user==NULL || $email==NULL || $password==NULL || $mobile==NULL)
{
$r["re"]="Fill the all fields!!!";
print(json_encode($r));
}

else
{		   
$s="select Email,Mobile from user where Mobile='".$mobile."' or Email='".$email."'";  
$res=mysqli_query($dbhandle,$s);		   
$num_rows=mysqli_num_rows($res);
if($num_rows==0)
{
	mysqli_free_result($res);
	$q="INSERT INTO  user(UserName,Email,Password,Mobile,CloudRegId) values('".$user."','".$email."','".$password."','".$mobile."','".$regid."')";  
	$res= mysqli_query($dbhandle,$q); 
	if(!$res)
		{
			$r["re"]="Inserting problem in database";                  
			print(json_encode($r));
		}
	else
		{
			$r["re"]="Record inserted successfully";
			print(json_encode($r));
		}
}
else
{
	$r["re"]="Record is repeated";
	print(json_encode($r));
} 
}
mysqli_close($dbhandle);
?> 