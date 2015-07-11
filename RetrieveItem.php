<?php
require_once('global.php');
$json=$_REQUEST['json'];
$data=json_decode($json);
$merchant=$data->KEY_MERCHANT;
$diet=$data->KEY_DIET;	
$s="SELECT * FROM Item WHERE Merchant ='".$merchant."' and Diet='".$diet."'";
$res=mysqli_query($dbhandle,$s) or die ('Error: '.mysqli_error($dbhandle));	
$dishes = array();	
if(mysqli_num_rows($res)) {
      while($dish = mysqli_fetch_assoc($res)) {
         $dishes[] = array('dish'=>$dish);
      }
   }   
echo json_encode(array('dishes'=>$dishes));	
mysqli_close($dbhandle);
?>