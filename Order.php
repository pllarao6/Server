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
$q="SELECT OrderId,OrderTime,Count(*),Sum(ItemTotalPrice) as tot_rows FROM MyCart WHERE CustomerId=".$customer." GROUP BY OrderId ORDER BY OrderTime DESC";
$res=mysql_query($q);
$orders=array();
$status=1;
$process=1;
while($row=mysql_fetch_array($res))
{
	$pay_status=0;
	$process_status=0;	
	$temp_order=$row[0];	
	$temp_timestamp=$row[1];
	$x=$row[2];
	$r="SELECT Count(*) FROM MyCart WHERE CustomerId=".$customer." and OrderId=".$temp_order." and Status=".$status;
	$ses=mysql_query($r);
	$sow=mysql_fetch_array($ses);
	$y=$sow[0];
	$s="SELECT Count(*) FROM MyCart WHERE CustomerId=".$customer." and OrderId=".$temp_order." and Processed=".$process;
	$tes=mysql_query($s);
	$tow=mysql_fetch_array($tes);
	$z=$tow[0];
	if($x==$y)
	{
		$pay_status=1;
	}
	if($y==$z)
	{
		$process_status=1;
	}	
	$temp=explode(" ",$temp_timestamp,2);	
	$temp_total=$row[3];
	$orders[]=array("orderid"=>$temp_order,"orderdate"=>$temp[0],"ordertime"=>$temp[1],"pay_status"=>$pay_status,"process_status"=>$process_status,"total"=>$temp_total);
}
echo json_encode(array("orders"=>$orders));
mysql_close($db_con);
?>
	