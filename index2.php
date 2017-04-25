<?php date_default_timezone_set('Asia/Kolkata'); 
	if(isset($_GET['data'])){
		
		echo "<!DOCTYPE html>
<html>
<title>GNC Attendance System</title>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<link rel=\"stylesheet\" href=\"./w3.css\">
<link href=\"https://fonts.googleapis.com/css?family=Poppins\" rel=\"stylesheet\">
  <style>
        * {
			font-family: Poppins !important;
		}
  </style>
<body>
<div class=\"w3-container\">";

session_start();
$name="";
$tbl="";
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

	$result = sqlsrv_query($link,"select * from attendance where mac='".$_GET['data']."'");
	if( $result === false) {
		print_r( sqlsrv_errors(), true);
	}

	while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
		$name=$row['name'];
		$tbl=$row['username'];
	}
	if($tbl!=""){$btns = sqlsrv_query($link,"select * from ".$tbl." where Date='".date("Y-m-d")."'");
		while($btnrow=sqlsrv_fetch_array($btns,SQLSRV_FETCH_ASSOC)) { 
			//echo "H".$btnrow[0]."H".$btnrow[1]."H".$btnrow[2]."H";
			if($btnrow['date']=="")
			{
				$dateadd = sqlsrv_query($link, "insert into ".$tbl." (`date`) values ('".date("Y-m-d")."')");
			}
		}
	}

echo "<div style=\"display:flex;justify-content:center;\">
<h2>Attendance System</h2></div>
<div style=\"height:30px;\"></div>
	<div style=\"display:flex;justify-content:center;\">
  <div class=\"w3-card-8 w3-dark-grey\" style=\"width:26%;margin-right:1%;\">

    <div class=\"w3-container w3-center\">
      <h3><?php echo date(\"d-m-Y\"); ?></h3>
      <img src=\"./avatar3.png\" alt=\"Avatar\" style=\"width:50%\">
      <h2>".$name."</h2>
	<form action=\"present.php\" method=\"post\">	
      <div class=\"w3-section\">

		<button class=\"w3-btn w3-green\" name=\"present\" value=\"in\" style=\"margin-right:50px;width:130px;height:50px;\"";
		if($tbl!=""){
			$btns = sqlsrv_query($link,"select * from ".$tbl." where Date='".date("Y-m-d")."'"); 
			while($btnrow=sqlsrv_fetch_array($btns,SQLSRV_FETCH_ASSOC)) { 
				if($name==""){echo "disabled";}
				else if($btnrow[1]!="") {echo "disabled";}
			}
		}
		else{echo "disabled";}
		echo ">In</button><button class=\"w3-btn w3-red\" name=\"present\" value=\"out\" style=\"width:150px;height:50px;\"";
		if($tbl!=""){
			$btns = sqlsrv_query($link,"select * from ".$tbl." where Date='".date("Y-m-d")."'");
			while($btnrow=sqlsrv_fetch_array($btns,SQLSRV_FETCH_ASSOC)) {
				if($name==""){echo "disabled";} 
				else if($btnrow[2]!="") {echo "disabled";} 
			}
		}
		else{echo "disabled";} 
		echo " >Out</button>
		<input type=hidden name=\"tblnm\" value=\"".$tbl."\">
		<input type=hidden name=\"usrnm\" value=\"".$name."\">

		<textarea name=\"worktext\" cols=\"50\" rows=\"5\" placeholder=\"Describe You've done work for the day.\"";
		if($tbl!=""){$btns1 = sqlsrv_query($link,"select * from ".$tbl." where Date='".date("Y-m-d")."'"); 
			while($btnrow1=sqlsrv_fetch_array($btns1,SQLSRV_FETCH_ASSOC)) {
				if($name==""){echo "style='margin-top: 10px; display:none; !important'";}
				else if($btnrow1[1]=="" && $btnrow1[2]=="") {echo "style='margin-top: 10px; display:none; !important' ";}
				else if($btnrow1[1]!="" && $btnrow1[2]!="") {echo "style='margin-top: 10px; display:none; !important' ";}
				else	{echo "style='margin-top: 10px; display:block; !important'  required='required'";}
			}
		}
		else{echo "style='margin-top: 10px; display:none; !important' ";} 
		echo "></textarea></div></form></div>
  </div>

</div>
<footer style=\"bottom:0px;margin-bottom:0px;padding-bottom:0px;width:100%;position:absolute;left:0;\">
<div style=\"display:flex;justify-content:center;background-color:#3f729b;\"><h5 style=\"color:#fff;\">&copy;2016 logicroom, All rights Reserved.</h5></div>
</footer>


</div>
</body>
</html>";
	}
?>