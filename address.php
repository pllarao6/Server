<?php
require_once('global.php');
$json=$_REQUEST['json'];
$data=json_decode($json);
$lat=$data->KEY_LATITUDE;
$lng=$data->KEY_LONGITUDE;	
$latitude=$lat+0.0;
$longitude=$lng+0.0;	
$s= "SELECT *,(((acos(sin((".$latitude."*pi()/180)) * sin((Lat*pi()/180))+cos((".$latitude."*pi()/180)) * cos((Lat*pi()/180)) * cos(((".$longitude."- Lng)*pi()/180))))*6372.0)) as distance FROM addressInfo having distance <= 1";
$res=mysqli_query($dbhandle,$s) or die ('Error: '.mysqli_error($dbhandle));
$stores = array();
if(mysqli_num_rows($res)) {
  while($store = mysqli_fetch_assoc($res)) {
	 $stores[] = array('store'=>$store);
  }
}   
echo json_encode(array('stores'=>$stores));
mysqli_close($dbhandle);
?>