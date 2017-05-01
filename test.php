<?php
include 'cls_require.php';
$stmt = query("select * from attendance");
while($row=getdataassoc($stmt)){
		foreach($row as $key => $value){
			echo $key.":".$value."<br />";
		}
		echo "<br />";
	}
	if($tbl==""){
		echo $_GET['data'];
		exit;
	}
?>