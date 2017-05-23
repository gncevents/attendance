<?php date_default_timezone_set('Asia/Kolkata'); 

if(isset($_POST["present"])){
	require './cls_require.php';
	session_start();
		
	if($_POST["present"]=="in")
	{
		$sql="update ".$_POST["tblnm"]." set intime='".date("H:i:s")."' where date='".date("Y-m-d")."'";
		$stmt = new connect();
		if($stmt->onlyquery($link,$sql)){
			header("location:http://192.168.60.79:88/attendance");
		}
		else{
			echo "Try to In Again. !!!";
		}
	}
	else if($_POST["present"]=="out")
	{
		$sql="update ".$_POST["tblnm"]." set outtime='".date("H:i:s")."', work='".$_POST["worktext"]."' where date='".date("Y-m-d")."'";
		$stmt = new connect();
		if($stmt->onlyquery($link,$sql)){
			header("location:http://192.168.60.79:88/attendance");
		}
		else{
			echo "Try to Out Again. !!!";
		}
	}
}
else
{
	header("location:./");
}
?>