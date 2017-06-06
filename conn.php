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
$conn_str = "Data Source=tcp:gncattendance.database.windows.net,1433;Initial Catalog=attendance;Integrated Security=False;User ID=gncadmin@gncattendance;Password=Admin@GNC;Connect Timeout=15;Encrypt=False;TrustServerCertificate=True;ApplicationIntent=ReadWrite;MultiSubnetFailover=False"; //getenv('SQLAZURECONNSTR_attendance');
$dbConn = connStrToArray($conn_str);
$serverName = substr($dbConn["Data Source"],4,34);
$connectionInfo = array( "Database"=>$dbConn["Initial Catalog"], "UID"=>$dbConn["User ID"], "PWD"=>$dbConn["Password"]);
$link = sqlsrv_connect( $serverName, $connectionInfo );
?>