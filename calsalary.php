<?php 
session_start();
$db="attendance";
$link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
mysqli_select_db($link,$db) or die("can not Login(Database Error.)");
$tbl = "";
if(isset($_GET['q'])){
	$q=$_GET["q"];
	if (strlen($q) > 0) {
		list($usrnm, $mon, $year) = explode(':', $q);
		$result = mysqli_query($link,"SELECT * FROM `".$usrnm."` WHERE Date like '".$year."-".$mon."___' and `Out Time` not like ''");
		$dayscount=$totalworkhours=$totalworkingmins=0;
		while($row=mysqli_fetch_array($result, MYSQLI_NUM)){
			$dayscount++;
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
			}
		}

		//$result = mysqli_query($link,"insert into ");
		
		$calsal=0;
		$result = mysqli_query($link,"SELECT * FROM `predefined` WHERE usernm='".$usrnm."'");
		$row=mysqli_fetch_array($result, MYSQLI_NUM);

		$bassal=$row[2];
		$hours = $row[1];
		$mondays=cal_days_in_month(CAL_GREGORIAN,$mon,$year);
		$caldays=0;
		if($hours>0){
		if(floor(($totalworkhours*$mondays)/$hours)>$mondays){
			$caldays=$mondays;
		}
		else {
			$caldays=floor(($totalworkhours*$mondays)/$hours);
		}}
		$calsal=0;
		$strpass="";
		//$strpass = trim(floor($calsal).":".$totalworkhours.":".$hours);
		if($totalworkhours > $hours){
			$calsal=$bassal;
			$strpass = trim(floor($calsal).":".$totalworkhours.":".$hours.":".$bassal.":".$caldays.":".($totalworkhours-$hours));
		}
		else
		{
			$calsal=(($totalworkhours*$bassal)/$hours);
			$strpass = trim(floor($calsal).":".$totalworkhours.":".$hours.":".$bassal.":".$caldays);
		}
		echo $strpass;
	}
}
else if(isset($_GET["h"])){
	$h=$_GET["h"];
	if (strlen($h) > 0) {
		list($hnm, $hmon, $hyear) = explode(':', $h);
		$query="SELECT * FROM `salary`";
		if($hnm!="No" | $hmon!="No" | $hyear!="No"){
			$query.= " WHERE ";
		}
		if($hnm!="No"){
			$query.= " username like '".$hnm."'";
		}
		if($hmon!="No" & $hyear=="No"){
			if($hnm!="No"){
				$query.= " and";
			}
			$query.= " month like '".$hmon."______'";
		}
		if($hyear!="No"){
			if($hnm!="No"){
				$query.= " and";
			}
			if($hmon!="No"){				
				$query.= " month like '".$hmon.", ".$hyear."'";
			}
			else{
				$query.= " month like '____".$hyear."'";
			}
		}
		$result = mysqli_query($link,$query);
		echo "<table style='border: 1px solid #ccc;  box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12); '><tr style='background: bottom right 15% no-repeat #ff5252; '><th>No.</th><th>Name</th><th>Fixed<br />Hours</th><th>Hours<br />Worked<th>Days<br />worked<th>Fixed<br />Salary<th>Calculated<br />Salary<th>Incentive<th>Salary<br />Paid<th>Month<th>Delete</tr>";
		$i=$j=0;
			while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
				$i++;
				$result2 = mysqli_query($link,"select hours,bassal from predefined where usernm like '".$row[2]."'");
				while($row2=mysqli_fetch_array($result2,MYSQLI_NUM)){
					$basssalw = $row2[1];
					$hoursd = $row2[0];
				}
				$monthNum = substr($row[5],0,2);
				$year = substr($row[5],3);
				$mondays=cal_days_in_month(CAL_GREGORIAN,$monthNum,$year);
				
				}
				echo "<tr><td style='border:1px solid #ccc;'>".$i."</td>";
				echo "<td style='border:1px solid #ccc;'>".$row[1]."</td>";
				echo "<td style='border:1px solid #ccc;'>".$hoursd."</td>";
				echo "<td style='border:1px solid #ccc;'>".$row[6]."</td>";
				if(floor(($row[6]*$mondays)/$hoursd)>$mondays){
					echo "<td style='border:1px solid #ccc;'>".$mondays."</td>";
				}
				else {
					echo "<td style='border:1px solid #ccc;'>".floor(($row[6]*$mondays)/$hoursd)."</td>";
				}
				echo "<td style='border:1px solid #ccc;'>".$basssalw."</td>";
				echo "<td style='border:1px solid #ccc;'>".$row[7]."</td>";
				echo "<td style='border:1px solid #ccc;'>".$row[4]."</td>";
				echo "<td style='border:1px solid #ccc;'>".$row[3]."</td>";
				
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				$monthName = $dateObj->format('F'); // March
				echo "<td style='border:1px solid #ccc;'>".$monthName.", ".$year."</td>";
				echo "<td style='border:1px solid #ccc;'><a href='calsalary.php?d=".$row[0]."' style='text-decoration:none;'>Delete</a></td>";
			}
			echo "</table>";
			mysqli_close($link);
	}

else if(isset($_GET["d"])){
	$del=$_GET["d"];
	$result3 = mysqli_query($link,"delete from salary where id=".$del);
	header("location:./salary.php");
}
else {
	header("location:./salary.php");
}
?>