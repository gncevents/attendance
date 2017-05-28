<?php 
$link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
$db="attendance";
mysqli_select_db($link,$db) or die("can not Login(Database Error.)");

$tbl="salary";
	
if(isset($_POST['salname'])){
	if(isset($_POST['salary'])){
		if(isset($_POST['incentive'])){
			if(isset($_POST['salmonth'])){
				if(isset($_POST['salyear'])){
					if(isset($_POST['whours'])){
						$salpaid=$_POST['salary'] + $_POST['incentive'];
						$rec = mysqli_query($link, "insert into ".$tbl." (`name`, `username`, `salpaid`, `incentive`, `month`, `workhours`, `calsal`) values ( (select `Name` from attendance where `user`='".$_POST['salname']."'), '".$_POST['salname']."', ".$salpaid.", ".$_POST['incentive'].", '".$_POST['salmonth'].", ".$_POST['salyear']."', ".$_POST['whours'].", ".$_POST['salary'].")") or die(mysqli_errno($link) . ": " . mysqli_error($link));
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