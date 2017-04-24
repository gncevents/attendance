<?php date_default_timezone_set('Asia/Kolkata'); 

if(isset($_POST["present"])){
	session_start();
	$db="attendance";
	$link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
	mysqli_select_db($link,$db) or die("can not Login(Database Error.)");
	if($_POST["present"]=="in")
	{
		$sql="update ".$_POST["tblnm"]." set `in time`='".date("H:i:s")."' where Date='".date("Y-m-d")."'";
		if(mysqli_query($link, $sql)){
			mysqli_close($link);
			header("location:./");
		}
		else{
			echo "Try Again. !!!";
		}
	}
	else if($_POST["present"]=="out")
	{
		$sql="update ".$_POST["tblnm"]." set `out time`='".date("H:i:s")."', Work='".$_POST["worktext"]."' where Date='".date("Y-m-d")."'";
		if(mysqli_query($link, $sql)){
			mysqli_close($link);
			header("location:./");
		}
		else{
			echo "Try Again. !!!";
		}
	}
}
else
{
	header("location:./");
}
?>