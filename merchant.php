<?php
date_default_timezone_set('Asia/Kolkata');		
session_start();
if(!isset($_SESSION['login_user']))
{
	header("location: index.php");
}
else
{
$db_host = "sql107.byethost8.com";
$db_uid = "b8_15951173";
$db_pass = "Vankayala123";
$db_name = "b8_15951173_test_user";
$merchantId=$_SESSION['merchantId'];
$con=mysqli_connect($db_host,$db_uid,$db_pass) or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysqli_select_db($con,$db_name) or die("Failed to connect to MySQL: " . mysql_error());
$q="SELECT * FROM MyCart WHERE MerchantId=".$merchantId." and Status=1 and Processed=0 group by OrderId order by OrderTime";
$res=mysqli_query($con,$q);
$n=mysqli_num_rows($res);
?>
<html>
	<header>
		<title>
			Merchant Version
		</title>								
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>		
		<link href="style.css" rel="stylesheet" type="text/css">		
		<script>
			function order(orderid)
			{				
				window.location.href="merchant.php?orderid="+orderid;
			}
		</script>	
	</header>
<body>	
	<div class="main">
	<div class="left_pane">		
	<?php
		if($n>0)
		{
		while($row=mysqli_fetch_assoc($res))
		{
			$temp=explode(' ',$row['OrderTime']);
			$date=$temp[0];
			$time=$temp[1];
	?>	
	<div class="row" id=<?php echo $row['OrderId'] ?>  onclick="order(this.id)" >
		<span class="orderid">OrderId <?php echo $row['OrderId']?> </span><br/>
		<span class="date">Date <?php echo $date?></span>
		<span class="time">Time <?php echo $time?></span>		
		</div><br/>	
		<?php
		}
		}
		else
		{
			?>
			<span class="no-items">You have No orders Yet.</span>
		<?php	
		}
		?>						
	</div>
	<div class="right_pane">
		<?php
			if(isset($_GET['orderid']))
			{
				$orderid=$_GET['orderid'];
				$r="SELECT * FROM MyCart a,Item b,user c WHERE a.ItemId=b.id and a.CustomerId=c.UserId and MerchantId=".$merchantId." and Status=1 and Processed=0 and OrderId=".$orderid;
				$ses=mysqli_query($con,$r);
			?>
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
		while($row=mysqli_fetch_assoc($ses))
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
		<?php
			}
		?>
	</div>
	</div>
<?php
	}
	mysqli_close($con);
?>
<script>
jQuery( function(){
	function messages_longpolling( timestamp, lastId ){
		var t;		
		if( typeof lastId == 'undefined' ){			
			lastId = 0;
		}
				
		jQuery.ajax({
			url: 'stream.php',
			type: 'GET',
			data: 'timestamp=' + timestamp + '&lastId=' + lastId,
			dataType: 'json',
			success: function( payload ){				
				clearInterval( t );							
				if( payload.status == 'results' || payload.status == 'no-results' ){
					t=setTimeout( function(){
						messages_longpolling( payload.timestamp, payload.lastId );
					}, 1000 );
					if( payload.status == 'results' ){
						jQuery.each( payload.data, function(i,msg){							
							if( jQuery('.no-items').size() == 1 ){
								jQuery('.items').empty();
								jQuery('.no-items').empty();
							}
						if( jQuery('#' + msg.id).size() == 0 ){							
					jQuery('.left_pane').append( '<div class="row" id="'+ msg.id + '" onclick="order(this.id)">'+'<span class="orderid">OrderId ' +msg.id+ '</span><br/>'+
					'<span class="date">Date'+msg.date+'</span>'+
					'<span class="time">Time'+msg.time+'</span></div><br/>');
					}					
						});
					}
				} else if( payload.status == 'error' ){
					alert('We got confused, Please refresh the page!');
				}
			},
			error: function(){
				clearInterval( t );
				t=setTimeout( function(){
					messages_longpolling( payload.timestamp, payload.lastId );
				}, 15000 );
			}
		});
	}
	messages_longpolling( '<?php echo date('Y-m-d G:i:s'); ?>' );
});
</script>
</body>
</html>