<?php

$ipAddress=$_SERVER['REMOTE_ADDR'];
$macAddr=false;
$adminmac="";
$adminmac="b0-83-fe-65-d1-23";
$adminmac1="b0-83-fe-8a-5d-83";
$adminmac2="";
#run the external command, break output into lines
$arp=`arp -a $ipAddress`;
$lines=explode("\n", $arp);

#look for the output line describing our IP address
foreach($lines as $line)
{
   $cols=preg_split('/\s+/', trim($line));
   if ($cols[0]==$ipAddress)
   {
       $macAddr=$cols[1];
   }
}
if($macAddr===$adminmac)
{

$db="attendance";
$link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
mysqli_select_db($link,$db) or die("can not Login(Database Error.)");

if(isset($_POST['rnm'])){
	//echo $_POST['Name']."<br />".$_POST['Salary']."<br />".$_POST['hours']."<br />".$_POST['mac']."<br />".strtolower(str_replace(" ","",$_POST['Name']));
	//header("location:add.php");
	$sql2 = "delete from attendance where user='".$_POST['rnm']."'";
	$sql1 = "delete from predefined where usernm='".$_POST['rnm']."'";
	$sql3 = "drop table ".$_POST['rnm'];
	$dateadd1 = mysqli_query($link, $sql1) or die(mysqli_errno($link) . ": " . mysqli_error($link));
	$dateadd2 = mysqli_query($link, $sql2) or die(mysqli_errno($link) . ": " . mysqli_error($link));
	$dateadd3 = mysqli_query($link, $sql3) or die(mysqli_errno($link) . ": " . mysqli_error($link));
}
else
{?>
<!doctype html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="A portfolio template that uses Material Design Lite.">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<title>Remove an Emplyee</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
		<link rel="stylesheet" href="./css/css/material.blue_grey-red.min.css" />
			<!-- Final Color <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-indigo.min.css" /> -->
		<link rel="stylesheet" href="styles.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<!-- Compiled and minified CSS -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

	  <!-- Compiled and minified JavaScript -->
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
	  <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	  <script src="./js/js/materialize.js"></script>
	</head>

	<body>
	<div class="fixed-action-btn horizontal click-to-toggle"><a class="btn-floating btn-large waves-effect waves-light blue" href="salary.php"><i class="material-icons">keyboard_arrow_left</i></a></div>
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
			<div class="mdl-layout__drawer mdl-layout--small-screen-only">
				<nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
					<a class="mdl-navigation__link is-active" href="index.html">Portfolio</a>
					<a class="mdl-navigation__link" href="blog.html">Blog</a>
					<a class="mdl-navigation__link" href="about.html">About</a>
					<a class="mdl-navigation__link" href="contact.html">Contact</a>
				</nav>
			</div>
			<main class="mdl-layout__content">
				<div class="mdl-grid portfolio-max-width portfolio-contact">
					<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
						<div class="mdl-card__title">
							<h2 class="mdl-card__title-text">Remove an Employee</h2>
						</div>
						<div class="mdl-card__media" style="height:5px;">
						</div>
						<div class="mdl-card__supporting-text">
							<form action="remove.php" class="" method="POST">
								<div class="input-field col s12 m6" style="padding: 10px; width: 430px !important; display: flex; margin-right: 50px; padding-right: 50px;">
									<select class="icons" name="rnm" id="rnm" style="display: block; border: 1px #2196F3 solid; width: 300px; margin-right: 20px;" onchange="showUser()">
									<option value="No" disabled selected>Select Name</option>
									<?php 
										$link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
										mysqli_select_db($link,$db) or die("can not Login(Database Error.)");
										$result = mysqli_query($link,"select * from attendance");
										$i=0; 
										while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
											$i++;
											echo "<option value=".$row[3]." data-icon='images/sample-1.jpg' class='left circle'>".$row[1]."</option>";
										}
									?></select>
									<a class="btn-floating red add-button" href="javascript:void(0);" style="width: 50px; height: 50px; line-height: 50px;"><i class="material-icons" style="line-height: 50px;">clear</i></a>
									</div>
							</form>
						</div>
					</div>
				</div>
			</main>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
			   $(document).on("click",".add-button",function(){
				 var form = $(this).closest("form");
				 form.submit();
			   });
			});
		</script>
	</body>
	</html>
	<?php }
}

?>