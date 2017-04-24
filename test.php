<!DOCTYPE html>
<?php 

$conn_str = getenv('SQLAZURECONNSTR_attendance');
$dbConn = connStrToArray($conn_str);
foreach($dbConn as $key => $value){
        echo "<br />".$key.":".$value;
}
$serverName = substr($dbConn["Data Source"],4,34);
$connectionInfo = array( "Database"=>$dbConn["Database"], "UID"=>$dbConn["User Id"], "PWD"=>$dbConn["Password"]); 
$link = sqlsrv_connect( $serverName, $connectionInfo ) or die("Can not Login");
$result = sqlsrv_query($link,"select * from attendance");
if( $result === false) { 
    die( print_r( sqlsrv_errors(), true) );
}
echo "<table>";
while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
    echo "<tr>";
    foreach($row as $key => $value){
        echo "<td>".$value."</td>";
    }
    echo "</tr>";
}
?>