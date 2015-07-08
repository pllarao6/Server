<?php
date_default_timezone_set("Asia/Kolkata");
$date_time=date("Y-m-d H:i:s");
$order_date=explode(' ',$date_time)[0];
$order_time=explode(' ',$date_time)[1];
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
$q1="SELECT MAX(OrderId) FROM MyCart";
$res1=mysql_query($q1);
$row1=mysql_fetch_array($res1);
$max=$row1[0];
$max=$max+1;
$json=$_POST['json'];
$data=json_decode($json);
$item_list=$data->Items;
$userid=$data->CustomerId;
$new_status=1;
foreach ($item_list as $item)
{	
		$q2="UPDATE MyCart SET OrderTime='".$date_time."',Status=".$new_status.",OrderId=".$max."  WHERE CustomerId=".$userid." and MerchantId=".$item->MerchantId." and ItemId=".$item->ItemId." and Status=0";
		$res2=mysql_query($q2);
}
echo json_encode(array("orderId"=>$max,"orderDate"=>$order_date,"orderTime"=>$order_time));
mysql_close($db_con);
?>