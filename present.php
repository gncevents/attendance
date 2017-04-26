<?php date_default_timezone_set('Asia/Kolkata'); 

if(isset($_POST["present"])){
	session_start();
	function connStrToArray($connStr){
		$connArray = array();
		$parts = explode(";", $connStr);
		foreach($parts as $part){
			$temp = explode("=", $part);
			$connArray[$temp[0]] = $temp[1];
		}
		return $connArray;
	}
	$conn_str = getenv('SQLAZURECONNSTR_attendance');
	$dbConn = connStrToArray($conn_str);
	
	$serverName = substr($dbConn["Data Source"],4,34);
	
	$connectionInfo = array( "Database"=>$dbConn["Initial Catalog"], "UID"=>$dbConn["User ID"], "PWD"=>$dbConn["Password"]); 

 	$link = sqlsrv_connect( $serverName, $connectionInfo ) or die("Can not Login");
	
	if($_POST["present"]=="in")
	{
		$sql="update ".$_POST["tblnm"]." set `in time`='".date("H:i:s")."' where Date='".date("Y-m-d")."'";
		if(sqlsrv_query($link, $sql)){
			sqlsrv_close($link);
			header("location:./");
		}
		else{
			echo "Try Again. !!!";
		}
	}
	else if($_POST["present"]=="out")
	{
		$sql="update ".$_POST["tblnm"]." set `out time`='".date("H:i:s")."', Work='".$_POST["worktext"]."' where Date='".date("Y-m-d")."'";
		if(sqlsrv_query($link, $sql)){
			sqlsrv_close($link);
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