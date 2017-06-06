<?php 
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
$dbConn2 = connStrToArray2($conn_str2);
$serverName2 = substr($dbConn2["Data Source"],4,35);
$connectionInfo2 = array( "Database"=>$dbConn2["Initial Catalog"], "UID"=>$dbConn2["User ID"], "PWD"=>$dbConn2["Password"]);
$link2 = sqlsrv_connect( $serverName2, $connectionInfo2);
?>