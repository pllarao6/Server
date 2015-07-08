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
	$merchant=$_POST['KEY_MERCHANT'];
	$diet=$_POST['KEY_DIET'];	
	$q="SELECT * FROM Item WHERE Merchant ='".$merchant."' and Diet='".$diet."'";
	$res=mysql_query($q,$db_con) or die ('Error: '.mysql_error());	
	$dishes = array();	
   if(mysql_num_rows($res)) {
      while($dish = mysql_fetch_assoc($res)) {
         $dishes[] = array('dish'=>$dish);
      }
   }   
   echo json_encode(array('dishes'=>$dishes));	
   mysql_close($db_con);
?>