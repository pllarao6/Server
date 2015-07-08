<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$db_host = "sql107.byethost8.com";
$db_uid = "b8_15951173";
$db_pass = "Vankayala123";
// PHP variable to store the Database name
$db_name = "b8_15951173_test_user";
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect($db_host,$db_uid,$db_pass);
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($connection,$username);
$password = mysqli_real_escape_string($connection,$password);
echo $username;
echo $password;
// Selecting Database
$db = mysqli_select_db($connection,$db_name);
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($connection,"select * from addressInfo where password='$password' AND UserId_Store='$username'");
$rows = mysqli_num_rows($query);
echo "num rows:";
echo $rows;
if ($rows == 1) {
$row=mysqli_fetch_assoc($query);
$_SESSION['login_user']=$username; // Initializing Session
$_SESSION['merchantId']=$row['Id'];
header("location: merchant.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($connection); // Closing Connection
}
}
?>