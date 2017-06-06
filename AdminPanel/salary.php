<?php 
session_start();
$db="attendance";
$link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
mysqli_select_db($link,$db) or die("can not Login(Database Error.)");
$tbl = "";
if(isset($_GET["q"])){
	$q=$_GET["q"];
	if (strlen($q) > 0) {
		$result = mysqli_query($link,"SELECT * FROM `attendance` WHERE user='".$q."'");
		$row1=mysqli_fetch_array($result, MYSQLI_NUM);
		$mac = $row1[2];
		$result = mysqli_query($link,"SELECT * FROM `predefined` WHERE usernm='".$q."'");
		$row=mysqli_fetch_array($result, MYSQLI_NUM);
		$bassal=$row[2];
		$hours = $row[1];
		$strpass="";
		$strpass = $bassal.":".$hours.":".$mac;
		echo $strpass;
	}
}
else {
	header("location:./salary.php");
}
?>