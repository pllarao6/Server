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
	$lat=$_POST['KEY_LATITUDE'];
	$lng=$_POST['KEY_LONGITUDE'];
	//$lat=12.9518404;
	//$lng=77.7039837;
	$new_lat1=$lat-0.013322;
	$new_lat2=$lat+0.01322;
	$new_lng1=$lng-0.013322;
	$new_lng2=$lng+0.013322;	
	$q="SELECT * FROM addressInfo WHERE Lat BETWEEN '".$new_lat1."' and '".$new_lat2."' and Lng BETWEEN '".$new_lng1."' and '".$new_lng2."'";
	$res=mysql_query($q,$db_con) or die ('Error: '.mysql_error());
	echo mysql_num_rows($res,$db_con);
	$stores = array();
   if(mysql_num_rows($res)) {
      while($store = mysql_fetch_assoc($res)) {
         $stores[] = array('store'=>$store);
      }
   }   
   echo json_encode(array('stores'=>$stores));
?>