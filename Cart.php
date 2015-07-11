<?php
require_once('global.php');
$json=$_REQUEST['json'];
$data=json_decode($json);
$item=$data->ItemId;
$quantity=$data->Quant;
$merchant=$data->MerchantId;
$customer=$data->CustomerId;
$total_price=$data->TotalItemPrice;
$status=0;

$s="SELECT * FROM MyCart WHERE ItemId=".$item." and MerchantId=".$merchant." and CustomerId=".$customer." and Status=".$status;

$res=mysqli_query($dbhandle,$s);

if(mysqli_num_rows($res))
{	
	//update
	$update_query="UPDATE MyCart SET Quantity=".$quantity.",ItemTotalPrice=".$total_price." WHERE ItemId=".$item ." and MerchantId=".$merchant." and CustomerId=".$customer." and Status=".$status;
	mysqli_query($update_query);	
}

else
{	
	//insert new record
	$insert_query="INSERT INTO MyCart(ItemId,Quantity,MerchantId,CustomerId,ItemTotalPrice,Status) Values(".$item.",".$quantity.",".$merchant.",".$customer.",".$total_price.",".$status.")";	
	mysqli_query($insert_query);	
}
mysqli_close($dbhandle);
?>