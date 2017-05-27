<?php date_default_timezone_set('Asia/Kolkata'); ?>
<!DOCTYPE html>
<html>
<head>
<title>See Yout Attendance | GNC</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <style>
        body {font-family: 'Poppins', sans-serif; font-weight:400; font-size: 12px;}
		.table:hover{
			box-shadow: 0 2px 2px 0 rgba(0,0,0,.15), 0 3px 1px -2px rgba(0,0,0,.32), 0 1px 5px 0 rgba(0,0,0,0.6);
		}
		</style>
	</head>
<body>
<?php
session_start();
$ipAddress=$_SERVER['REMOTE_ADDR'];
$macAddr=false;
$adminmac="b0-83-fe-65-d1-23";
$adminmac1="b0-83-fe-8a-5d-83";
$adminmac3="";
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
echo $macAddr;
$db="attendance";
$link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
mysqli_select_db($link,$db) or die("can not Login(Database Error.)");
$curmonth=date("m");
$resultall = mysqli_query($link,"select name,user from attendance"); 
$iall=0;
while($rowall=mysqli_fetch_array($resultall,MYSQLI_NUM)){
	$iall++;
	if($iall%3==1){
		echo "<div class='col-md-12'>";
	}?>
	<div class="col-md-4">
		<h3 align="center"><?php echo $rowall[0]; ?></h3>
		<table class="table table-bordered table-condensed" align=center style='border:solid 2px #3f729b;margin-bottom:0px;'>
			<tr style="background-color:#3f729b; color:white;"><th>DAY<th style="width: 78px !important;">Date<th> In Time<th> Out Time<th>Work<th>Hours Worked</tr>
			<?php  
			$result = mysqli_query($link,"select * from ".$rowall[1]);
			$dayscount=$totalworkhours=$totalworkingmins=0;
			while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
				if($row[2]!="" & $row[1]!=""){
					$hour=$hour1=$min=$min1=$sec=$sec1=0;
					$time = $row[1];
					$time1 = $row[2];
					list($hour, $min, $sec) = explode(':', $time);
					list($hour1, $min1, $sec1) = explode(':', $time1);
					if($min1<$min){
						$hour1--;
						$min1=$min1+60;
					}
					$dayhours = ($hour1-$hour);
					$daymins = ($min1-$min);
					$totalworkingmins = $totalworkingmins + $daymins;
					$totalworkhours = $totalworkhours + $dayhours;
					if($totalworkingmins>60){
						$totalworkhours++;
						$totalworkingmins=$totalworkingmins-60;
					}
					if($curmonth==substr($row[0],5,2)) {
						$dayscount++;
						echo "<tr><td>".$dayscount."<td>".$row[0]."<td>".$row[1]."<td>".$row[2]."<td>".$row[3]."<td align='center' style='width:50px;'>".$dayhours.":".$daymins;
					}
				}
				else {
					if(date("m")==substr($row[0],5,2)) {
						$dayscount++;
						echo "<tr><td>".$dayscount."<td>".$row[0]."<td>".$row[1]."<td>".$row[2]."<td>".$row[3]."<td>";
					}
				}
			}
			if($macAddr===$adminmac) {
				echo "<tr style='background-color:#3f729b; color:white;'><td><td>Total Days<td>".$dayscount."<td><td>Total Working Hours<td>".$totalworkhours.":".$totalworkingmins;
			} 
		echo "</table></div>";
	if($iall%3==0){
		echo "</div>";
	}
} ?>
</div>
<div style="width: 100%; display: table; bottom: 0px; padding-top: 30px;">
	<div style="height: 60px; margin-top: 30px; display: table-cell; vertical-align: middle; justify-content: center; bottom: 0px; color: white; background-color: #3f729b; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.3),0 2px 10px 0 rgba(0,0,0,0.12) !important; ">
		<div style="display: flex; justify-content: center;">
			<div>
				<h3>Jay - Sat - Chit - Anand</h3>
			</div>
		</div>
	</div>
</body>
</html>