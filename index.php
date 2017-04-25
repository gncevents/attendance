<?php date_default_timezone_set('Asia/Kolkata'); 
header('Access-Control-Allow-Origin: https://gncattendance.azurewebsites.net');
header('Access-Control-Allow-Methods: POST');
$ipAddress=$_SERVER['REMOTE_ADDR'];
$macAddr=false;

$arp=`arp -a $ipAddress`;
$lines=explode("\n", $arp);

foreach($lines as $line)
{
   $cols=preg_split('/\s+/', trim($line));
   if ($cols[0]==$ipAddress)
   {
       $macAddr=$cols[1];
   }
}
?>
<!DOCTYPE html>
<html>
<title>GNC Attendance System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./w3.css">
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <style>
        * {
			font-family: Poppins !important;
		}
  </style>
<body>
<div id="attcard"></div>
<script>
var data = "<?php echo $macAddr; ?>";
$.ajax({
	type: "GET",
	async : true,
	url: "https://gncattendance.azurewebsites.net/index2.php?data="+data,
	success: function(data1) {
		console.log(data1);
		$("#attcard").html(data1);
	}
});
</script>
</body>
</html>