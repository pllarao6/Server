<?php
session_start();
if(!isset($_SESSION['login_user']))
{
	header("location: index.php");
}
 function sendPushNotificationToGCM($registatoin_ids, $message) {
		//Google cloud messaging GCM-API url
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );       
		// Google Cloud Messaging GCM API Key
	define("GOOGLE_API_KEY", "AIzaSyBqUqSRpNhVqzKd6MmD9v4Wxs3H9liv5ZQ"); 		
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);	
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);				
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
$db_host = "sql107.byethost8.com";
$db_uid = "b8_15951173";
$db_pass = "Vankayala123";
$db_name = "b8_15951173_test_user";
$connection = mysqli_connect($db_host,$db_uid,$db_pass);
define('DB_HOST',$db_host);
define('DB_NAME',$db_name); 
define('DB_USER',$db_uid); 
define('DB_PASSWORD',$db_pass); 
$orderid=$_POST['orderid'];
$merchantid=$_SESSION['merchantId'];
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error());
$q="UPDATE  MyCart SET Processed=1 WHERE MerchantId=".$merchantid." and OrderId=".$orderid;
$res=mysqli_query($con,$q);
$query="SELECT * FROM user a,MyCart b,addressInfo c WHERE a.UserId=b.CustomerId and c.Id=b.MerchantId and b.Processed=1 and b.Status=1 and OrderId=".$orderid." and b.MerchantId=".$merchantid;
$r=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($r);
$gcmRegID =$row['CloudRegId'];
$store=$row['StoreName'];
$datetime=$row['OrderTime'];
$arr=explode(' ',$datetime);
$date=$arr[0];
$time=$arr[1];
if (isset($gcmRegID) && isset($store)) {		
			$gcmRegIds = array($gcmRegID);
			$message = array("OrderId"=>$orderid,"Store"=>$store,"Date"=>$date,"Time"=>$time);	
			$pushStatus = sendPushNotificationToGCM($gcmRegIds, $message);
                        header('location:merchant.php');
	}		
?>	