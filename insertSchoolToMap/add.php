<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="author" content="Christos Prassas - ΠΔΕ Θεσσαλίας - 2012"/>
<?php
include ('connect.php'); 
function getIP() {
$ip;
if (getenv("HTTP_CLIENT_IP"))
$ip = getenv("HTTP_CLIENT_IP");
else if(getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("REMOTE_ADDR"))
$ip = getenv("REMOTE_ADDR");
else
$ip = "UNKNOWN";
return $ip;
} 
$ip=getIP();
echo "Η IP σας είναι: ".$ip ;

$lat=$_POST['lat'];
$lon=$_POST['lon'];
$school_id=$_POST['school_id'];


		
$query = "UPDATE map SET ip='$ip', lat='$lat', lng='$lon' WHERE school_id='$school_id'";
			$result = mysql_query($query);
			if (mysql_affected_rows() == 0) {
			echo "</br> <p> ΟΥΠΣ..... Δεν υπάρχει σχολείο με κωδικό '$school_id' !</p>"; 
			echo "<img src='/gps/error.png'>";
				}
		
		//	if (!$result) 
			//	echo "Invalid query: " . mysql_error();
   		else	{
				echo "<p>Το Σχολείο με κωδικό ".$school_id." έχει πλέον συντεταγμένες ".$lat." και ".$lon."</p>";
				echo "<p>Σας ευχαριστούμε που χρησιμοποιήσατε το πρόγραμμα!</p>";
				echo "<img src='/gps/success.png'>";
				
		}		
?>
</head>
<body>
</body>
</html> 