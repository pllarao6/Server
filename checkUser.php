<?php
require_once('global.php');

$json=$_POST['json'];
$data=json_decode($json);
$email=$data->KEY_EMAIL;
$password=$data->KEY_PASSWORD;
$regid=$data->KEY_REGID;

$s="SELECT * FROM user WHERE Email='".$email."' and Password='".$password."'";

$res = mysqli_query($dbhandle,$s);

$q="UPDATE user set CloudRegId='".$regid."' WHERE Email='".$email."'";

$flag=0;

$output=array();

if(mysqli_num_rows($res))
{
	$flag=1;
	$row=mysqli_fetch_array($res);
	$output['id']=$row[0];
	$output['name']=$row[1];
}
else
{
	$output['id']=-1;
        $output['name']="";
}
 if($flag==1)
 {
	 $output['re']='ok';
 }
 else
 {
	 $output['re']='fail';
 }
mysqli_free_result($res);
$res=mysqli_query($dbhandle,$q);
print(json_encode($output));
mysqli_close($dbhandle);
?>		