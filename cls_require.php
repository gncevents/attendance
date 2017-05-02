<?php
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

function query($quer){
    $stmt = sqlsrv_query($link, $quer);
    if( $stmt === false) {
		return sqlsrv_errors();
	}
    else{
        return $stmt;
    }
}
function getdataassoc($stmt){
    $row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
    return $row;
}
$stmt = query("select * from attendance");
if($stmt==false){
	echo $stmt;
}else{
	while($row=getdataassoc($stmt)){
		foreach($row as $key => $value){
			echo $key.":".$value."<br />";
		}
		echo "<br />";
	}
}
?>