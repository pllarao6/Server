<?php
session_start();
if(!isset($_SESSION['login_user']))
{
	header("location: index.php");
}
$db_host = "sql107.byethost8.com";
$db_uid = "b8_15951173";
$db_pass = "Vankayala123";
$db_name = "b8_15951173_test_user";
define('DB_HOST',$db_host);
define('DB_NAME',$db_name); 
define('DB_USER',$db_uid); 
define('DB_PASSWORD',$db_pass); 
$merchantid=$_SESSION['merchantId'];
$orderid=$_GET['orderid'];
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error());
$q="SELECT * FROM MyCart a,Item b,user c WHERE a.ItemId=b.id and a.CustomerId=c.UserId and MerchantId=".$merchantid." and Status=1 and Processed=0 and OrderId=".$orderid;
$res=mysqli_query($con,$q);
?>
<html>
	<header>
		<title>
			View Order Details
		</title>
<link href="style.css" rel="stylesheet" type="text/css">
	</header>
<body>
<h2>OrderId: <?php echo $orderid ?></h2></br>
<h2>Date:</h2></br>
<h2>Time:</h2></br>
<table border="1">
	<tr>
		<th>S.No</th>
		<th>Name</th>
		<th>Quantity</th>
		<th>MRP</th>
		<th>Total Item Price</th>
	</tr>
	<?php
		$count=0;
		$total=0;
		while($row=mysqli_fetch_assoc($res))
		{
		$count++;
		$total=$total+$row['ItemTotalPrice'];
	 ?>
		<tr>
				<td>
					<?php echo $count ?>
				</td>
				<td>
					<?php echo $row['Name'] ?>
				</td>
				<td>
					<?php echo $row['Quantity'] ?>
				</td>
				<td>
					<?php echo $row['Price'] ?>
				</td>
				<td>
					<?php echo $row['ItemTotalPrice'] ?>
				</td>				
		</tr>
	<?php
		}
	?>
</table>
<form method="post" action="processed.php">
<input type="hidden" name="orderid" value=<?php echo $orderid ?> />
<input type="submit" value="Done"/>
</form>
</body>
</html>