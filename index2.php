<?php date_default_timezone_set('Asia/Kolkata'); 
	if(isset($_GET['data'])){
		require './cls_require.php';
		require './cls_require.1.php';
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

function connStrToArray2($connStr){
    $connArray = array();
    $parts = explode(";", $connStr);
    foreach($parts as $part){
        $temp = explode("=", $part);
        $connArray[$temp[0]] = $temp[1];
    }
    return $connArray;
}
$conn_str2 = getenv('SQLAZURECONNSTR_attendance1');
$dbConn2 = connStrToArray($conn_str2);
$serverName2 = substr($dbConn2["Data Source"],4,35);
$connectionInfo2 = array( "Database"=>$dbConn2["Initial Catalog"], "UID"=>$dbConn2["User ID"], "PWD"=>$dbConn2["Password"]);
$link2 = sqlsrv_connect( $serverName2, $connectionInfo2);

	$query = "select * from attendance where mac='".$_GET['data']."'";
	$stmt = new connect1();
	$row=$stmt->query($link2,$query);
	foreach($row as $key => $value){
		foreach($value as $key=>$value1){
			if($key == "name"){
				$name = $value1;
			}
			if($key == "username"){
				$tbl = $value1;
			}
		}
	}
	if($tbl==""){
		echo $_GET['data'];
		exit;
	}
	
	if($tbl!=""){
	    $btns="something";
	    
	    $selectdate = "select * from ".$tbl." where date='".date("Y-m-d")."'";
		//$row=$stmt->query($query);
		$btns=$stmt->query($link,$selectdate);
		if($btns == ""){
			$stmt->onlyquery($link,"insert into ".$tbl." (date) values ('".date("Y-m-d")."')");
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
	<form action=\"https://gncattendance.azurewebsites.net/present.php\" method=\"post\">	
      <div class=\"w3-section\">

		<button class=\"w3-btn w3-green\" name=\"present\" value=\"in\" style=\"margin-right:50px;width:130px;height:50px;\" ";
		if($tbl!="" && $btns!=""){
			$inbtn=$stmt->query($link,"select * from ".$tbl." where date='".date("Y-m-d")."'");
			
			if($inbtn!=null && $inbtn!=""){	    
				foreach($inbtn as $key => $value){
					foreach($value as $key1=>$value1){
						if($name==""){echo "disabled";}
						else if($key1 == "intime"){
							if($value1 != ""){
								echo "disabled";
							}
						}
					}
					//else if($btns1['intime']!="") {echo "disabled";}
				}
			}
			/*$btns = sqlsrv_query($link,"select * from ".$tbl." where date='".date("Y-m-d")."'"); 
			while($btnrow=sqlsrv_fetch_array($btns,SQLSRV_FETCH_ASSOC)) { 
				if($name==""){echo "disabled";}
				else if($btnrow['intime']!="") {echo "disabled";}
			}*/
		}
		else if ($btns!=""){echo "disabled='disabled'";}
		echo ">In</button><button class=\"w3-btn w3-red\" name=\"present\" value=\"out\" style=\"width:150px;height:50px;\" ";
		if($tbl!=""){
		    $outbtns=$stmt->query($link,"select * from ".$tbl." where date='".date("Y-m-d")."'");
			if($outbtns!=null | $outbtns!=""){
				if(is_array($outbtns)){
					foreach($outbtns as $key => $value){
						foreach($value as $key=>$value1){
							if($name==""){echo "disabled";}
							else if($key == "outtime"){
								if($value1 != ""){
									echo "disabled";
								}
							}
							else if($key == "intime"){
								if($value1 == ""){
									echo "disabled";
								}
							}
						}
					}
				}
			}
/*
			while($btnrow=sqlsrv_fetch_array($btns,SQLSRV_FETCH_ASSOC)) {
				if($name==""){echo "disabled";}
				else if($btnrow['outtime']!="") {echo "disabled";}
				else if($btnrow['intime']=="") {echo "disabled";}
			}*/
		}
		else{echo "disabled";} 
		echo " >Out</button>
		<input type=hidden name=\"tblnm\" value=\"".$tbl."\">

		<textarea name=\"worktext\" cols=\"50\" rows=\"5\" placeholder=\"Describe You've done work for the day.\"";
		$intime = $outtime = "";
		if($btns==""){
		    echo "style='margin-top: 10px; display:none; !important' ";
		}
		else if($tbl!=""){
			$btns1=$stmt->query($link,"select * from ".$tbl." where date='".date("Y-m-d")."'");
			if($btns1!=null | $btns1!=""){
				if(is_array($btns1)){
					foreach($btns1 as $key => $value){
						foreach($value as $key=>$value1){
							if($name==""){echo "style='margin-top: 10px; display:none; !important'";}
							else {
								if($key == "intime"){
									$intime = $value1;
								}
								else if($key == "outtime"){
									$outtime = $value1;
								}
							}
							/*else if ($key == "intime" || $key == "outtime"){
								if(($key == "intime" && $value1!="") || ($key == "outtime" && $value1!="")){
									echo "style='margin-top: 10px; display:none; !important' ";
								}
							}
							//else if($btns1['intime']=="" && $btns1['outtime']=="") {echo "style='margin-top: 10px; display:none; !important' ";}
							//else if($btns1['intime']!="" && $btns1['outtime']!="") {echo "style='margin-top: 10px; display:none; !important' ";}
							else { echo "style='margin-top: 10px; display:block; !important'  required='required'";}*/
						}
					}
				}
			}
		}
		/*if ($key == "intime" || $key == "outtime"){
			if(($key == "intime" && $value1!="") || ($key == "outtime" && $value1=="")){
				echo "style='margin-top: 10px; display:block; !important' ";
			}
		}*/

		if($intime!="" && $outtime==""){
			echo "style='margin-top: 10px; display:block; !important' required";
		}

		/*if($tbl!=""){$btns1 = sqlsrv_query($link,"select * from ".$tbl." where date='".date("Y-m-d")."'"); 
			while($btnrow1=sqlsrv_fetch_array($btns1,SQLSRV_FETCH_ASSOC)) {
				if($name==""){echo "style='margin-top: 10px; display:none; !important'";}
				else if($btnrow1['intime']=="" && $btnrow1['outtime']=="") {echo "style='margin-top: 10px; display:none; !important' ";}
				else if($btnrow1['intime']!="" && $btnrow1['outtime']!="") {echo "style='margin-top: 10px; display:none; !important' ";}
				else	{echo "style='margin-top: 10px; display:block; !important'  required='required'";}
			}
		}*/
		else{echo "style='margin-top: 10px; display:none; !important' ";} 
		echo "></textarea></div></form></div>
  </div></div>
</div>
</body>
</html>";
	}
?>