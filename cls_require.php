<?php
class connect{
    private $stmt = NULL;   
    public function query($quer){
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
        $stmt = sqlsrv_query($link, $quer);
        if( $stmt === false) {
            return sqlsrv_errors();
        }
        else{
            $i=0;
            while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                $rows[$i]=$row;
                $i++;
            }
            return $rows;
        }
    }
}
?>