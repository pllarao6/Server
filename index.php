<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: merchant.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main_div">
<div id="login">
<h2>Login to your account</h2>
<form action="" method="post">
<input id="name" name="username" placeholder="Username" type="text">
<input id="password" name="password" placeholder="Password" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>