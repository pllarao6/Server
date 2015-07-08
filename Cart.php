<?php
$db_host= "sql107.byethost8.com";

$db_uid= "b8_15951173";

$db_pwd= 'Vankayala123';

$db_name= "b8_15951173_test_user";

$db_con=mysql_connect($db_host,$db_uid,$db_pwd) or die("Error");

mysql_select_db($db_name,$db_con);


$item=$_POST['ItemId'];
$quantity=$_POST['Quant'];
$merchant=$_POST['MerchantId'];
$customer=$_POST['CustomerId'];
$total_price=$_POST['TotalItemPrice'];
$status=0;

$q="SELECT * FROM MyCart WHERE ItemId=".$item." and MerchantId=".$merchant." and CustomerId=".$customer." and Status=".$status;


$res=mysql_query($q);


if(mysql_num_rows($res))
{	
	//update
	$update_query="update MyCart set Quantity=".$quantity.",ItemTotalPrice=".$total_price." WHERE ItemId=".$item ." and MerchantId=".$merchant." and CustomerId=".$customer." and Status=".$status;
	mysql_query($update_query);	
}

else
{	
	//insert new record
	$insert_query="INSERT INTO MyCart(ItemId,Quantity,MerchantId,CustomerId,ItemTotalPrice,Status) Values(".$item.",".$quantity.",".$merchant.",".$customer.",".$total_price.",".$status.")";	
	mysql_query($insert_query);	
}

mysql_close($db_con);
?>