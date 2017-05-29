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
$link = sqlsrv_connect( $serverName, $connectionInfo );
?>