<html>
<head>
<title>Get Current Position - Latitude & Longitude using HTML 5</title>
<script>
if(!navigator.geolocation){
	alert('Your Browser does not support HTML5 Geo Location. Please Use Newer Version Browsers');
}
navigator.geolocation.getCurrentPosition(success, error);
function success(position){
	var latitude  = position.coords.latitude;	
	var longitude = position.coords.longitude;	
	var accuracy  = position.coords.accuracy;
	document.getElementById("lat").value  = latitude;
	document.getElementById("lng").value  = longitude;
	document.getElementById("acc").value  = accuracy;
		
	
}
function error(err){
	alert('ERROR(' + err.code + '): ' + err.message);
}
</script>
<body>
<form method="POST" action="http://myproject.byethost8.com/Location.php">
<input type="text" id="name" name="name" placeholder="Name"/><br/>
<input type="text" id="addr1" name="addr1" placeholder="Address Line1"/><br />
<input type="text" id="addr2" name="addr2" placeholder="Address Line2" /><br />
<input type="text" id="pincode" name="pincode" placeholder="Pincode" /><br />
<input type="text" id="email" name="email" placeholder="Email" /><br />
<input type="text" id="phone" name="phone" placeholder="Phone" /><br />
<input type="text" id="lat" name="lat" placeholder="Latitude"/><br />
<input type="text" id="lng" name="lng" placeholder="Longitude"/><br />
<input type="text" id="acc" placeholder="More or Less"/> Meters.
<input type="submit" value="submit" name="Submit"/>
</form>
</body>
</html>
<?php
  if(isset($_POST['Submit']))
  {
	$con = mysql_connect("sql107.byethost8.com","b8_15951173","Vankayala123");
         if (!$con)
           {
             die('Could not connect: ' . mysql_error());
           }

           mysql_select_db("b8_15951173_test_user", $con);
	$name=$_POST['name'];
	$addr1=$_POST['addr1'];
	$addr2=$_POST['addr2'];
	$pincode=$_POST['pincode'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
	$addr=$addr1.",".$addr2;
	echo $name." ".$phone;
	$q="INSERT INTO addressInfo(StoreName,Address,Pincode,Email,Phone,Lat,Lng) values('".$name."','".$addr."','".$pincode."','".$email."','".$phone."','".$lat."','".$lng."')";
	$result=mysql_query($q,$con) or die('Error:' . mysql_error());
	echo $result;
	mysql_close($con);
  }
?>