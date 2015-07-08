<?php
// PHP variable to store the host address
$db_host = "sql107.byethost8.com";
// PHP variable to store the username
$db_uid = "b8_15951173";
// PHP variable to store the password
$db_pass = "Vankayala123";
// PHP variable to store the Database name
$db_name = "b8_15951173_test_user";
// PHP variable to store the result of the PHP function 'mysql_connect()' which establishes the PHP & MySQL connection
$db_con = mysql_connect($db_host,$db_uid,$db_pass) or die('could not connect');
	mysql_select_db("b8_15951173_test_user", $db_con);
		
	$itemid=$_POST['ItemId'];
	$status=$_POST['Status'];
	$quant=$_POST['Quant'];
	$customer=$_POST['Key_Customer'];
	$merchant=$_POST['Key_Merchant'];
	$totalitemprice=$_POST['Key_TotalItemPrice'];	
	$lat=$_POST['Key_Lat'];
	$lng=$_POST['Key_Lon'];
	$new_lat1=$lat-0.013322;
	$new_lat2=$lat+0.013322;
	$new_lng1=$lng-0.013322;
	$new_lng2=$lng+0.013322;
	
	$q="Update MyCart SET Quantity=".$quant.", ItemTotalPrice=".$totalitemprice." Where ItemId=".$itemid." and CustomerId=".$customer." and MerchantId=".$merchant." and Status=".$status;
	
	$res=mysql_query($q);
		
	
	$status=0;
	
	$query="SELECT * FROM MyCart a,Item b,addressInfo c Where a.ItemId=b.Id and CustomerId=".$customer." and Status=".$status." and Lat Between ".$new_lat1." and ".$new_lat2." and Lng Between ".$new_lng1." and ".
									$new_lng2." and a.MerchantId=c.Id";
	
	$result=mysql_query($query) or die ('Error: '.mysql_error());	
	
	$carts = array();	
	
   if(mysql_num_rows($result)) {
      while($cart = mysql_fetch_assoc($result)) {
         $carts[] = array('cart'=>$cart);
      }
   }   
   echo json_encode(array('carts'=>$carts));	
   mysql_close($db_con);
?>