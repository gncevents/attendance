<?php 
session_start();
require './conn.php';
require './conn.1.php';
require './cls_require.php';
$tbl = "";
if(isset($_GET['q'])){
	$q=$_GET["q"];
	if (strlen($q) > 0) {
		list($usrnm, $mon, $year) = explode(':', $q);
		$stmt = new connect();
		$row=$stmt->query($link,"SELECT * FROM ".$usrnm." WHERE Date like '".$year."-".$mon."___' and outtime not like ''");
		//$result = mysqli_query($link,"SELECT * FROM `".$usrnm."` WHERE Date like '".$year."-".$mon."___' and `Out Time` not like ''");
		$dayscount=$totalworkhours=$totalworkingmins=0;
		foreach($row as $key => $value){
			$dayscount++;
			if($value['intime']!="" & $value['outtime']!=""){
				$hour=$hour1=$min=$min1=$sec=$sec1=0;
				$time = $value['intime'];
				$time1 = $value['outtime'];
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
		//$stmt = new connect();
		//$result = $stmt->query($link,"SELECT * FROM attendance WHERE usernm='".$usrnm."'");

		$stmt = new connect();
		$row=$stmt->query($link2,"SELECT * FROM attendance WHERE username='".$usrnm."'");

		//$row=mysqli_fetch_array($result, MYSQLI_NUM);
		foreach($row as $key => $basvalue){
			$bassal=$basvalue['salary'];
			$hours = $basvalue['hours'];
		}
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
		$query="SELECT * FROM salary";
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
		$stmt = new connect();
		$row=$stmt->query($link2,$query);
		//$result = mysqli_query($link,$query);
		echo "<table style='border: 1px solid #ccc;  box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12); '><tr style='background: bottom right 15% no-repeat #ff5252; '><th>No.</th><th>Name</th><th>Fixed<br />Hours</th><th>Hours<br />Worked<th>Days<br />worked<th>Fixed<br />Salary<th>Calculated<br />Salary<th>Incentive<th>Salary<br />Paid<th>Month<th>Delete</tr>";
		$i=$j=0;
		foreach($row as $key => $salvalue){
			$result2=$stmt->query($link2,"select hours,salary from attendance where username like '".$salvalue['username']."'");
			//$result2 = mysqli_query($link,"select hours,bassal from predefined where usernm like '".$salvalue['username']."'");
			//while($row2=mysqli_fetch_array($result2,MYSQLI_NUM)){
			foreach($result2 as $key => $salvalue2){
				$basssalw = $salvalue2['salary'];
				$hoursd = $salvalue2['hours'];
			}
			$monthNum = substr($salvalue['month'],0,2);
			$year = substr($salvalue['month'],3);
			$mondays=cal_days_in_month(CAL_GREGORIAN,$monthNum,$year);
		
			if($salvalue['deletedon']==""){
				$i++;
				echo "<tr><td style='border:1px solid #ccc;'>".$i."</td>";
				echo "<td style='border:1px solid #ccc;'>".$salvalue['name']."</td>";
				echo "<td style='border:1px solid #ccc;'>".$hoursd."</td>";
				echo "<td style='border:1px solid #ccc;'>".$salvalue['workhours']."</td>";
				if(floor(($salvalue['workhours']*$mondays)/$hoursd)>$mondays){
					echo "<td style='border:1px solid #ccc;'>".$mondays."</td>";
				}
				else {
					echo "<td style='border:1px solid #ccc;'>".floor(($salvalue['workhours']*$mondays)/$hoursd)."</td>";
				}
				echo "<td style='border:1px solid #ccc;'>".$basssalw."</td>";
				echo "<td style='border:1px solid #ccc;'>".$salvalue['calsal']."</td>";
				echo "<td style='border:1px solid #ccc;'>".$salvalue['incentive']."</td>";
				echo "<td style='border:1px solid #ccc;'>".$salvalue['salpaid']."</td>";
				
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				$monthName = $dateObj->format('F'); // March
				echo "<td style='border:1px solid #ccc;'>".$monthName.", ".$year."</td>";
				echo "<td style='border:1px solid #ccc;'><a href='calsalary.php?d=".$salvalue['ID']."' style='text-decoration:none;'>Delete</a></td>";
			}
		}
	}
	echo "</table>";
}
else if(isset($_GET["d"])){
	$del=$_GET["d"];
	$dateObj   = DateTime::createFromFormat('!m', date("m"));
	$monthName = $dateObj->format('F');
	$stmt = new connect();
	$query = "update salary set deletedon='".date("d")."-".$monthName."' where ID=".$del;
	$row=$stmt->onlyquery($link2,$query);
	header("location:./salary.php");
}
else {
	header("location:./salary.php");
}
?>