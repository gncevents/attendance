<?
$q=$_GET["q"];
$con = mysql_connect('localhost', 'root', '');
mysql_select_db("test", $con);
$sql="SELECT * FROM client_mast WHERE id = '".$q."'";
$result = mysql_query($sql);
echo "<table border='1'>
<tr>
<th>Id</th>
<th>Name</th>
<th>Email</th>
<th>City</th>
</tr>";
while($row = mysql_fetch_row($result)) {
  echo "<tr>";
  foreach($row as $value){
  echo "<td>";
  echo $value;	
  echo "</td>";
  }
  echo "</tr>";
  }
echo "</table>";
mysql_close($con);
?>