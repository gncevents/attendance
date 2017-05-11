<?php
require './cls_require.php';
$query = "select * from attendance";
$stmt = new connect();
//$result = $stmt->query($query);
	$row=$stmt->query($query);
	//while($row=$stmt->getdataassoc($result)){
		foreach($row as $key => $value){
			foreach($value as $key=>$value1){
				echo $key.":".$value1."<br />";
			}
			echo "<br />";
		}
		echo "<br />";
?>