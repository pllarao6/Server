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
$orderid=$_POST['Key_Order'];
$userid=$_POST['Key_Customer'];
$q="SELECT * FROM MyCart a,Item b WHERE a.ItemId=b.Id and a.CustomerId=".$userid." and a.OrderId=".$orderid;
$res=mysql_query($q);
$carts=array();
while($row=mysql_fetch_assoc($res))
{
	$carts[]=$row;
}
print json_encode(array("carts"=>$carts));
mysql_close($db_con);