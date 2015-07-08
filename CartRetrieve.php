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
		
	$customer=$_POST['KEY_CUSTOMER'];
	$status=$_POST['Status'];	
	$lat=$_POST['Key_Lat'];
	$lng=$_POST['Key_Lon'];
	$new_lat1=$lat-0.013322;
	$new_lat2=$lat+0.013322;
	$new_lng1=$lng-0.013322;
	$new_lng2=$lng+0.013322;
	
	$q="SELECT * FROM MyCart a,Item b,addressInfo c Where a.ItemId=b.Id and CustomerId=".$customer." and Status=".$status." and Lat Between ".$new_lat1." and ".$new_lat2." and Lng Between ".$new_lng1." and ".
									$new_lng2." and a.MerchantId=c.Id";
	
	$res=mysql_query($q,$db_con) or die ('Error: '.mysql_error());	
	
	$carts = array();	
	
   if(mysql_num_rows($res)) {
      while($cart = mysql_fetch_assoc($res)) {
         $carts[] = array('cart'=>$cart);
      }
   }   
   echo json_encode(array('carts'=>$carts));	
   mysql_close($db_con);
?>