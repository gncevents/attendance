<?php
class connect1{
    private $stmt = NULL;
    public function query($link,$quer){
        $rows = null;
        $stmt = sqlsrv_query($link, $quer);
        if( $stmt === false) {
            return sqlsrv_errors();
        }
        else{
            $i=0;
            while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                if($row!=""){
                    $rows[$i]=$row;
                    $i++;
                }
                else{
                    break;
                }
            }
            return $rows;
        }
        sqlsrv_close($link);
    }
    public function onlyquery($link,$quer){
        $stmt = sqlsrv_query($link, $quer);
        if( $stmt === false) {
            return sqlsrv_errors();
        }
        else
        {
            return true;
        }
        sqlsrv_close($link);
    }
}
?>