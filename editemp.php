<?php 
session_start();
require './conn.1.php';
require './cls_require.php';
$tbl = "";
if(isset($_GET["q"])){
	$q=$_GET["q"];
	if (strlen($q) > 0) {
		$stmt = new connect();
		$sqlq = "SELECT * FROM attendance WHERE username='".$q."'";
		$usrs = $stmt->query($link2,$sqlq);
		foreach($usrs as $key => $value){
			$mac = $value['mac'];
			$bassal=$value['salary'];
			$hours = $value['hours'];
		}
		$strpass="";
		$strpass = $bassal.":".$hours.":".$mac;
		echo $strpass;
	}
}
else {
	header("location:./salary.php");
}
?>