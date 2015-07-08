<?php
session_start();

date_default_timezone_set('Asia/Kolkata');

require_once('global.php');

$timestamp =$_GET['timestamp'];

//$timestamp='2015-05-06 01:06:09';

$lastId = isset( $_GET['lastId'] ) && !empty( $_GET['lastId'] ) ? $_GET['lastId'] : 0;

if( empty( $timestamp ) ){
	die( json_encode( array( 'status' => 'error' ) ) );
}

$merchantId=$_SESSION['merchantId'];

$time_wasted = 0;

$lastIdQuery = '';

if( !empty( $lastId ) ){
	$lastIdQuery = ' AND ID > ' . $lastId;
}

$query="SELECT * FROM MyCart WHERE  OrderTime>='".$timestamp."' and MerchantId=".$merchantId." and Status=1 and Processed=0 group by OrderId order by OrderTIme";

$new_messages_check = mysqli_query($dbhandle,$query);

$num_rows = mysqli_num_rows( $new_messages_check );
if( $num_rows <= 0 ){
	while( $num_rows <= 0 ){
		if( $num_rows <= 0 ){
			
			// 40 Seconds are enough to forbid the request and send another one
			if( $time_wasted >= 60 ){
				die( json_encode( array( 'status' => 'no-results', 'lastId' => 0, 'timestamp' => date('Y-m-d G:i:s') ) ) );
				exit;
			}
			
			sleep( 1 );
			$new_messages_check = mysqli_query($dbhandle,$query);
			$num_rows = mysqli_num_rows( $new_messages_check );
			$time_wasted += 1;
		}
	}
}

$new_messages = array();
if( $num_rows >= 1):
while ( $row = mysqli_fetch_array( $new_messages_check, MYSQL_ASSOC ) ):
			$temp=explode(' ',$row['OrderTime']);
			$date=$temp[0];
			$time=$temp[1];
	$new_messages[] = array( 'id' => $row['OrderId'], 'date' => $date , 'time' => $time );
endwhile;
endif;
$last_msg = end( $new_messages );
$last_id = $last_msg['id'];

die( json_encode( array( 'status' => 'results', 'timestamp' => date('Y-m-d G:i:s'), 'lastId' => $last_id, 'data' => $new_messages ) ) );
?>
