<?php 
require './conn.1.php';
require './cls_require.php';

$tbl="salary";
$stmt = new connect();
	
if(isset($_POST['salname'])){
	if(isset($_POST['salary'])){
		if(isset($_POST['incentive'])){
			if(isset($_POST['salmonth'])){
				if(isset($_POST['salyear'])){
					if(isset($_POST['whours'])){
						$salpaid=$_POST['salary'] + $_POST['incentive'];
						$query = "insert into ".$tbl." (name, username, salpaid, incentive, month, workhours, calsal, deletedon) values ( (select Name from attendance where username='".$_POST['salname']."'), '".$_POST['salname']."', ".$salpaid.", ".$_POST['incentive'].", '".$_POST['salmonth'].", ".$_POST['salyear']."', ".$_POST['whours'].", ".$_POST['salary'].", '')";
						$rec = $stmt->query($link2, $query) or die("Try Again !!!");
					}
					else
					{
						header("location:./salary.php");
					}
				}
				else
				{
					header("location:./salary.php");
				}
			}
			else
			{
				header("location:./salary.php");
			}
		}
		else
		{
			header("location:./salary.php");
		}
	}
	else
	{
		header("location:./salary.php");
	}
}
else
{
	header("location:./salary.php");
}
header("location:./salary.php");
?>