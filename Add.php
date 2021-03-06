<?php
header("Access-Control-Allow-Origin: *");
if(isset($_POST['nam'])){
	function connStrToArray($connStr){
		$connArray = array();
		$parts = explode(";", $connStr);
		foreach($parts as $part){
			$temp = explode("=", $part);
			$connArray[$temp[0]] = $temp[1];
		}
		return $connArray;
	}
	$conn_str = getenv('SQLAZURECONNSTR_attendance1');
	$dbConn = connStrToArray($conn_str);
	
	$serverName = substr($dbConn["Data Source"],4,35);
	
	$connectionInfo = array( "Database"=>$dbConn["Initial Catalog"], "UID"=>$dbConn["User ID"], "PWD"=>$dbConn["Password"]); 

 	$link = sqlsrv_connect( $serverName, $connectionInfo ) or die(print_r(sqlsrv_errors()));


	 $conn_str2 = getenv('SQLAZURECONNSTR_attendance');
	$dbConn2 = connStrToArray($conn_str2);
	
	$serverName2 = substr($dbConn2["Data Source"],4,34);
	
	$connectionInfo2 = array( "Database"=>$dbConn2["Initial Catalog"], "UID"=>$dbConn2["User ID"], "PWD"=>$dbConn2["Password"]); 

 	$link2 = sqlsrv_connect( $serverName2, $connectionInfo2 ) or die(print_r(sqlsrv_errors()));

	$result = sqlsrv_query($link,"insert into attendance (name, mac, username, hours, salary) values ('".$_POST['nam']."', '".$_POST['mac']."', '".$_POST['usrnm']."', '".$_POST['hours']."', '".$_POST['salary']."')");
	$result = sqlsrv_query($link2,"create table ".$_POST['usrnm']." (date varchar(12) UNIQUE, intime varchar(10), outtime varchar(10), work varchar(100))");
	sqlsrv_close($link);
	sqlsrv_close($link2);
} ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add User</title>
  
  <link rel="stylesheet" href="./css/material.red-blue.min.css" />
  <script defer src="./js/material.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <style>
body{
	margin: 0;
	padding: 0;
	background: #fff;
	overflow: hidden;
	color: #fff;
	font-family: Arial;
	font-size: 12px;
}
.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background-image: url(./city-skyline-wallpapers-008.jpg);
	background-size: cover;
	-webkit-filter: blur(5px);
	z-index: 0;
}
.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}
.header{
	position: absolute;
	top: calc(50% - 35px);
	left: calc(50% - 255px);
	z-index: 2;
}
.header div{
	float: left;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 35px;
	font-weight: 200;
}
.header div span{
	color: #5379fa !important;
}
.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}
::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}
::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
    </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
<body>
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Add<span>User</span></div>
		</div>
		<div class="login">
			<form action="" method="POST">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample1" name="nam">
				<label class="mdl-textfield__label" for="sample3" style="color:white;">Name</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample2" name="usrnm">
				<label class="mdl-textfield__label" for="sample3" style="color:white;">User Name</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3" name="mac">
				<label class="mdl-textfield__label" for="sample3" style="color:white;">Mac</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample4" name="hours">
				<label class="mdl-textfield__label" for="sample3" style="color:white;">Hours</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample5" name="salary">
				<label class="mdl-textfield__label" for="sample3" style="color:white;">Salary</label>
			</div>
			<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" style="float:right;">
				<i class="material-icons">add</i>
			</button>
			</form>
		</div>
  <script src='./js/jquery.min.js'></script>
</body>
</html>