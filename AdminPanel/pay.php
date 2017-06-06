<?php
session_start();
/*$ipAddress=$_SERVER['REMOTE_ADDR'];
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
{*/
	
	$db="attendance";
$link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
mysqli_select_db($link,$db) or die("can not Login(Database Error.)");

if(isset($_POST['salname']) & isset($_POST['Salary']) & isset($_POST['fixhours']) & isset($_POST['mac'])){
	//echo $_POST['Name']."<br />".$_POST['Salary']."<br />".$_POST['hours']."<br />".$_POST['mac']."<br />".strtolower(str_replace(" ","",$_POST['Name']));
	
	$sql1="update attendance set mac='".$_POST['mac']."' where user='".$_POST['salname']."'";
	echo $sql1."<br />";
	$sql2="update predefined set hours='".$_POST["fixhours"]."', bassal=".$_POST["Salary"]." where usernm='".$_POST['salname']."'";
	echo $sql2;
	$dateadd1 = mysqli_query($link, $sql1) or die(mysqli_errno($link) . ": " . mysqli_error($link));
	$dateadd2 = mysqli_query($link, $sql2) or die(mysqli_errno($link) . ": " . mysqli_error($link));
	header("location:edit.php");
}
else
{?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Material Design Lite -->
    <script src="./js/js/material.min.js"></script>
	    <script src="./js/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="./css/css/material.blue_grey-red.min.css" />
		<!-- Final Color <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-indigo.min.css" /> -->

    <!-- Material Design icon font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" href="./css/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./css/css/ghpages-materialize.css" />
	
<link type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
<script type="text/javascript" src="./js/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="./js/js/jquery-1.8.3.min.js"></script>
<script src="./js/js/materialize.js"></script>
    <style>
        body {font-family: 'Poppins', sans-serif; font-weight:400; font-size: 12px; background-color: #eee;}
</style>
<!-- Square card -->
<style>
.demo-card-square.mdl-card {
  width: 320px;
  height: auto;
}
.flex{
	display:flex;
	justify-content:flex-start;
}
.demo-card-square > .mdl-card__title {
  color: #fff;
  background:
    bottom right 15% no-repeat #ff5252;
}
.mdl-layout__drawer{
	width:300px !important;
	webkit-transform: translateX(-310px);
    transform: translateX(-310px);
}
a.mdl-layout__tab:hover, a.mdl-layout__tab:focus, a.mdl-layout__tab:active {
    text-decoration: none !important;
    color: white;
}
.input-field{
	color:black;
	font-size:12px;
	margin-top:0px !important;
}
.input-field>select>option:hover{
	background-color:
}
.mdl-textfield{
	padding: 5px !important;
}
select{
	border: 1px solid #ccc;
}
select:hover{
	box-shadow: 0 2px 2px 0 rgba(0,0,0,.08), 0 3px 1px -2px rgba(0,0,0,.1), 0 1px 5px 0 rgba(0,0,0,0.08);
}
.left{
	border-bottom:1px solid #EEE;
}
main{
	padding:10px !important;
}
.demo-layout-waterfall .mdl-layout__header-row .mdl-navigation__link:last-of-type  {
  padding-right: 0;
}
a:hover{
	text-decoration:none;
}
</style>
</head>
  <body>
  <div class="fixed-action-btn horizontal click-to-toggle"><a class="btn-floating btn-large waves-effect waves-light blue" href="salary.php"><i class="material-icons">keyboard_arrow_left</i></a></div>
	<div class="page-content">
			<div style="height:5px;"></div>
			 <div class="col-md-12 flex">
				<div class="text-left" style="float:left;">
				<form action="edit.php" method="POST" id="editform">

					<div class="col-md-4" id="colmd6">
						<div class="demo-card-square mdl-card mdl-shadow--2dp" id="namelist">
							<div class="mdl-card__title mdl-card--expand">
								<h2 class="mdl-card__title-text">Select a Name</h2>
							 </div>
							<div class="mdl-card__supporting-text" style="padding: 16px 16px 0px 16px !important;">
								 <?php  
                                $db="attendance";
                                $link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
                                mysqli_select_db($link,$db) or die("can not Login(Database Error.)");
    
                                $result = mysqli_query($link,"select * from attendance");
                                $i=0;    
                                while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
                                    $i++;
									echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='option-".$i."'>
                                      <input type='radio' id='option-".$i."' class='mdl-radio__button' onchange='changeoption()' name='salname' value='".$row[3]."'>
                                      <span class='mdl-radio__label'>".$row[1]."</span></label><div style='height:10px;'></div>";
                                }
								?>
							</div>
						</div>
					</div>
<div class="col-md-4" id="colmd3"></div>
					<div class="col-md-4" id="colmd3">
						<div class="demo-card-square mdl-card mdl-shadow--2dp" id="fillcard" style="display:block;">
							<div class="mdl-card__title mdl-card--expand">
								<h2 class="mdl-card__title-text">Salary Details</h2>
							 </div>
							<div class="mdl-card__supporting-text">

							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="Salary" id="salary">
                                <label class="mdl-textfield__label" for="salary">Salary</label>
                                <span class="mdl-textfield__error">Enter a number!</span>
                              </div>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="fixhours" id="fixhours">
                                <label class="mdl-textfield__label" for="incentive">Hours</label>
                                <span class="mdl-textfield__error">Enter is not a number!</span>
                              </div>

							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="mac" id="mac">
                                <label class="mdl-textfield__label" for="incentive">Mac Address</label>
                                <span class="mdl-textfield__error">Enter is not a number!</span>
                              </div>

							<div class="mdl-card__actions text-right">
                                <a class="btn-floating red add-button" href="javascript:submit()" style="width: 50px; height: 50px; line-height: 50px;"><i class="material-icons" style="line-height: 50px;">send</i></a>
                            </div>
							</div>
						</div>
					</div>
				</form>
				</div>
			</div>
		  </div>


<script type="text/javascript">
function changeoption() {
	var radios = document.getElementsByName('salname');
	for (var i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			strs = radios[i].value;
			break;
		}
	}
	if(strs!=""){ 
		if (window.XMLHttpRequest) {
			xmlhttp=new XMLHttpRequest();
		}
		xmlhttp.onreadystatechange=function() {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var strres = xmlhttp.responseText;
			var res = strres.split(":");
			document.getElementById("salary").value = res[0];
			document.getElementById("mac").value = res[2];
			document.getElementById("fixhours").value = res[1];
		}
	}
	xmlhttp.open("GET","editemp.php?q="+strs);
	xmlhttp.send();
}
}
function submit(){
	var form = document.getElementById('editform');
	form.submit();
}
	</script>
  </body>
</html>
<?php }
//}?>