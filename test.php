<?php
require './cls_require.php';
$query = "select * from attendance";
$stmt = new connect();
$row=$stmt->query($query);
foreach($row as $key => $value){
	foreach($value as $key=>$value1){
		echo $key.":".$value1."<br />";
	}
	echo "<br />";
}
echo "<br />";
?>