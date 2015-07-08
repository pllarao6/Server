<?php 
// Connect to MySql
$username = "b8_15951173";
$password = "Vankayala123";
$hostname = "sql107.byethost8.com";
$dbhandle = mysqli_connect($hostname, $username, $password);

// Connect to database
$db_selected = mysqli_select_db($dbhandle,"b8_15951173_test_user");
?>