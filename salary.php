<?php
session_start();
require './conn.1.php';
require './cls_require.php';
$ipAddress=$_SERVER['REMOTE_ADDR'];
$macAddr=false;
$adminmac="";
$adminmac="b0-83-fe-65-d1-23";
$adminmac1="b0-83-fe-8a-5d-83";
$adminmac2="";
$arp=`arp -a $ipAddress`;
$lines=explode("\n", $arp);
foreach($lines as $line)
{
   $cols=preg_split('/\s+/', trim($line));
   if ($cols[0]==$ipAddress)
   {
       $macAddr=$cols[1];
   }
}
//if($macAddr===$adminmac)
//{?>
<!DOCTYPE html>
<html>
  <head>
    <script src="./js/material.min.js"></script>
	    <script src="./adminpanel/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="./css/material.red-blue.min.css" />
		<!-- Final Color <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-indigo.min.css" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" href="./css/bootstrap.min.css" />
	<link rel="stylesheet" href="./css/ghpages-materialize.css" />	
<link type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
<script type="text/javascript" src="./adminpanel/js/jquery.js"></script>
<script src="./adminpanel/js/materialize.js"></script>
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
  <div class="fixed-action-btn horizontal click-to-toggle active">
<a class="btn-floating btn-large red">
  <i class="material-icons">menu</i>
</a>
<ul>
  <li><a class="btn-floating green" href="add.php"><i class="material-icons">add</i></a></li>
  <li><a class="btn-floating blue" href="edit.php"><i class="material-icons">edit</i></a></li>
  <li><a class="btn-floating red" href="remove.php"><i class="material-icons">clear</i></a></li>
</ul>
</div>


    <!-- Simple header with fixed tabs. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row" style="height: 16px !important;">
          <!-- Title -->
        </div>
        <!-- Tabs -->
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
			<!--<a href="#fixed-tab-1" class="mdl-layout__tab is-active">Attendance</a>-->
			<a href="#fixed-tab-2" class="mdl-layout__tab">Add Paid Salary</a>
			<a href="#fixed-tab-3" class="mdl-layout__tab">History</a>
		</div>
      </header>
      <main class="mdl-layout__content">
        <!--<section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
          <div class="page-content">-->
				<!--<iframe src="./admin.php" width="100%" height="100%" style="position:absolute;top:0px;left:0px;right:0px;bottom:0px;overflow:hidden; width:100%; height:100%;" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>-->
		  <!--</div>
        </section>-->
        <section class="mdl-layout__tab-panel is-active" id="fixed-tab-2">
          <div class="page-content">
			<div style="height:5px;"></div>
			 <div class="col-md-12 flex">
				<div class="text-left" style="float:left;">
				<form action="pay.php" method="POST">

					<div class="col-md-4" id="colmd6">
						<div class="demo-card-square mdl-card mdl-shadow--2dp" id="namelist">
							<div class="mdl-card__title mdl-card--expand">
								<h2 class="mdl-card__title-text">Name of List for Payout</h2>
							 </div>
							<div class="mdl-card__supporting-text" style="padding: 16px 16px 0px 16px !important;">
								 <?php  
                                /*$db="attendance";
                                $link2 = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
                                mysqli_select_db($link2,$db) or die("can not Login(Database Error.)");
    
                                $result = mysqli_query($link2,"select * from attendance");*/
                                $i=0;    
                                //while($row=mysqli_fetch_array($result,MYSQLI_NUM)){*/
																

																$stmt = new connect();
																$attquer = "select * from attendance";
																$attdata=$stmt->query($link2,$attquer);
																
																foreach($attdata as $key => $value){
																	$i++;
																	echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='option-".$i."'>
                                      <input type='radio' id='option-".$i."' class='mdl-radio__button' onchange='changeoption()' name='salname' value='".$value['username']."'>
                                      <span class='mdl-radio__label'>".$value['name']."</span></label><div style='height:10px;'></div>";
                                }
								?>
							</div>
							<div class="input-field col s12 m6" style="padding: 10px;">
                                <label>Choose Month for Salary</label><br /><br />
                                <select class="icons" name="salmonth" id="salmonth" style="display:block;" onchange="changeoption()">
                                  <option value="" disabled selected>Choose Month</option>
                                  <option value="01" data-icon="images/sample-1.jpg" class="left circle">January</option>
                                  <option value="02" data-icon="images/office.jpg" class="left circle">February</option>
                                  <option value="03" data-icon="images/yuna.jpg" class="left circle">March</option>
                                  <option value="04" data-icon="images/yuna.jpg" class="left circle">April</option>
                                  <option value="05" data-icon="images/office.jpg" class="left circle">May</option>
                                  <option value="06" data-icon="images/yuna.jpg" class="left circle">June</option>
                                  <option value="07" data-icon="images/yuna.jpg" class="left circle">July</option>
                                  <option value="08" data-icon="images/office.jpg" class="left circle">August</option>
                                  <option value="09" data-icon="images/yuna.jpg" class="left circle">September</option>
                                  <option value="10" data-icon="images/office.jpg" class="left circle">October</option>
                                  <option value="11" data-icon="images/yuna.jpg" class="left circle">November</option>
                                  <option value="12" data-icon="images/yuna.jpg" class="left circle">December</option>
                                </select>
                              </div>
                              <div class="input-field col s12 m6" style="padding: 10px;">
                                <select class="icons" name="salyear" id="salyear" style="display: block; margin-top: 5px;" onchange='changeoption()'>
                                  <option value="" disabled selected>Choose Year</option>
                                  <option value="2017" data-icon="images/office.jpg" class="left circle">2017</option>
                                  <option value="2018" data-icon="images/yuna.jpg" class="left circle">2018</option>
                                  <option value="2019" data-icon="images/yuna.jpg" class="left circle">2019</option>
                                  <option value="2020" data-icon="images/office.jpg" class="left circle">2020</option>
                                </select>										
                              </div>
							<!-- <div class="text-right">
							<input type="hidden" name="hiddenField" id="hiddenField" value="" /></div> -->
						</div>
					</div>

					<div class="col-md-4" id="colmd3">
						<div class="demo-card-square mdl-card mdl-shadow--2dp" id="fillcard" style="display:block;">
							<div class="mdl-card__title mdl-card--expand">
								<h2 class="mdl-card__title-text">Salary Details</h2>
							 </div>
							<div class="mdl-card__supporting-text">

							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="calsalary" id="fsal">
                                <label class="mdl-textfield__label" for="salary">Fixed Salary</label>
                                <span class="mdl-textfield__error">Enter a number!</span>
                              </div>

							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="calsalary" id="calsal">
                                <label class="mdl-textfield__label" for="salary">Calculated Salary</label>
                                <span class="mdl-textfield__error">Enter a number!</span>
                              </div>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="fixhours" id="fixhours">
                                <label class="mdl-textfield__label" for="incentive">Fixed Hours</label>
                                <span class="mdl-textfield__error">Enter is not a number!</span>
                              </div>

							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="whours" id="workhours">
                                <label class="mdl-textfield__label" for="incentive">Hours Worked</label>
                                <span class="mdl-textfield__error">Enter is not a number!</span>
                              </div>

							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="days" id="days" disabled>
                                <label class="mdl-textfield__label" for="incentive">Days Worked</label>
                                <span class="mdl-textfield__error">Enter is not a number!</span>
                              </div>

							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield" id="extrahours" style="display:none;">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="ehours" id="ehours">
                                <label class="mdl-textfield__label" for="incentive">Extra Hours Worked</label>
                                <span class="mdl-textfield__error">Enter is not a number!</span>
                              </div>
							</div>
						</div>
					</div>

					
                    <div class="col-md-4" id="colmd3">
                        <div class="demo-card-square mdl-card mdl-shadow--2dp" id="finaldetails" style="display:block;">
                          <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text">Salary Paid</h2>
                          </div>
                          <div class="mdl-card__supporting-text">
                            <!-- Numeric Textfield -->
                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="salary" id="salary">
                                <label class="mdl-textfield__label" for="salary">Salary Amount</label>
                                <span class="mdl-textfield__error">Enter a number!</span>
                              </div>
                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded is-dirty" data-upgraded=",MaterialTextfield">
                                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" name="incentive" id="incentive" value="0">
                                <label class="mdl-textfield__label" for="incentive">Incentive</label>
                                <span class="mdl-textfield__error">Enter is not a number!</span>
                              </div>                              
                            </div>							  
                          <div class="mdl-card__actions mdl-card--border text-right">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="letter-spacing:1.5px;">
                                    Pay Salary
                                </button>
                            </div>
                        </div>
                    </div>
				</form>
				</div>
			</div>
		  </div>
		  <div style="height: 50px !important;"></div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-3">
          <div class="page-content">
			<div class="col-md-12" style="display:flex; justify-content:center;">

			  <div class="input-field col s12 m6" style="padding: 10px; width: 300px !important;">
				<select class="icons" name="hnm" id="hnm" style="display: block;" onchange="showUser()"><option value="No" selected>All Name</option>
				<?php  
					/*$db="attendance";
					$link2 = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
					mysqli_select_db($link2,$db) or die("can not Login(Database Error.)");
					$result = mysqli_query($link2,"select * from attendance");*/
					$i=0; 
					//while($row=mysqli_fetch_array($result,MYSQLI_NUM)){*/
						$stmt = new connect();
						$attquer = "select * from attendance";
						$row=$stmt->query($link2,$attquer);
						
						foreach($row as $key => $value){
							$i++;
							echo "<option value=".$value['username']." data-icon='images/sample-1.jpg' class='left circle'>".$value['name']."</option>";
						}
				?></select>
				</div>
			  <div class="input-field col s12 m6" style="padding: 10px; width:300px !important;">
				<select class="icons" name="hmonth" id="hmonth" style="display:block;" onchange="showUser()">
				  <option value="No" selected>All Month</option>
				  <option value="01" data-icon="images/sample-1.jpg" class="left circle">January</option>
				  <option value="02" data-icon="images/office.jpg" class="left circle">February</option>
				  <option value="03" data-icon="images/yuna.jpg" class="left circle">March</option>
				  <option value="04" data-icon="images/yuna.jpg" class="left circle">April</option>
				  <option value="05" data-icon="images/office.jpg" class="left circle">May</option>
				  <option value="06" data-icon="images/yuna.jpg" class="left circle">June</option>
				  <option value="07" data-icon="images/yuna.jpg" class="left circle">July</option>
				  <option value="08" data-icon="images/office.jpg" class="left circle">August</option>
				  <option value="09" data-icon="images/yuna.jpg" class="left circle">September</option>
				  <option value="10" data-icon="images/office.jpg" class="left circle">October</option>
				  <option value="11" data-icon="images/yuna.jpg" class="left circle">November</option>
				  <option value="12" data-icon="images/yuna.jpg" class="left circle">December</option>
				</select>										
			  </div>
			  <div class="input-field col s12 m6" style="padding: 10px; width: 300px !important;">
				<select class="icons" name="hyear" id="hyear" style="display: block;" onchange="showUser()">
				  <option value="No" selected>All Year</option>
				  <option value="2017" data-icon="images/office.jpg" class="left circle">2017</option>
				  <option value="2018" data-icon="images/yuna.jpg" class="left circle">2018</option>
				  <option value="2019" data-icon="images/yuna.jpg" class="left circle">2019</option>
				  <option value="2020" data-icon="images/office.jpg" class="left circle">2020</option>
				</select>										
			  </div>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-8" style="display:flex; justify-content:center;">
			  <span id="hresultspan">
			  <?php 
					/*$db="attendance";
					
					$link2 = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
					mysqli_select_db($link2,$db) or die("can not Login(Database Error.)");*/
					$tbl = "";
					$query="SELECT * FROM salary where deletedon=''";
					$stmt = new connect();
						//$attquer = "select * from attendance";
						$salrow=$stmt->query($link2,$query);
						
					//$result = mysqli_query($link2,$query);
					echo "<table style='border: 1px solid #ccc;  box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12); '><tr style='background: bottom right 15% no-repeat #ff5252; '><th>No.</th><th>Name</th><th>Fixed<br />Hours</th><th>Hours<br />Worked<th>Days<br />worked<th>Fixed<br />Salary<th>Calculated<br />Salary<th>Incentive<th>Salary<br />Paid<th>Month<th>Delete</tr>";
					$i=$j=0;
					foreach($salrow as $hiskey => $hisvalue){
							
							$i++;
					//while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
					
						$histquery = "select hours,salary from attendance where username like '".$hisvalue['username']."'";
						$result2 = $stmt->query($link2,$histquery); //mysqli_query($link2,);
						//while($row2=mysqli_fetch_array($result2,MYSQLI_NUM)){
							foreach($result2 as $key => $hisrow){
								$basssalw = $hisrow['salary'];
								$hoursd = $hisrow['hours'];
							}
						$monthNum = substr($hisvalue['month'],0,2);
						$year = substr($hisvalue['month'],3);
						$mondays=cal_days_in_month(CAL_GREGORIAN,$monthNum,$year);
						echo "<tr><td style='border:1px solid #ccc;'>".$i."</td>";
						echo "<td style='border:1px solid #ccc;'>".$hisvalue['name']."</td>";
						echo "<td style='border:1px solid #ccc;'>".$hoursd."</td>";
						echo "<td style='border:1px solid #ccc;'>".$hisvalue['workhours']."</td>";
						if(floor(($hisvalue['workhours']*$mondays)/$hoursd)>$mondays){
							echo "<td style='border:1px solid #ccc;'>".$mondays."</td>";
						}
						else {
							echo "<td style='border:1px solid #ccc;'>".floor(($hisvalue['workhours']*$mondays)/$hoursd)."</td>";
						}
						echo "<td style='border:1px solid #ccc;'>".$basssalw."</td>";
						echo "<td style='border:1px solid #ccc;'>".$hisvalue['calsal']."</td>";
						echo "<td style='border:1px solid #ccc;'>".$hisvalue['incentive']."</td>";
						echo "<td style='border:1px solid #ccc;'>".$hisvalue['salpaid']."</td>";
						$dateObj   = DateTime::createFromFormat('!m', $monthNum);
						$monthName = $dateObj->format('F'); // March
						echo "<td style='border:1px solid #ccc;'>".$monthName.", ".$year."</td>";
						echo "<td style='border:1px solid #ccc;'><a href='calsalary.php?d=".$hisvalue['ID']."' style='text-decoration:none;'>Delete</a></td>";
					}
					echo "</table>";
				?>
			  </span>
		    </div>
			<div class="col-md-2"></div>
		  </div>
        </section>
      </main>
    </div>
<script type="text/javascript">

function changeoption() {
	
	document.getElementById("incentive").value = "0";
	var radios = document.getElementsByName('salname');
	for (var i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			strs = radios[i].value;
			break;
		}
	}
	var sel = document.getElementById('salmonth');
	var opt;
	for ( var i = 0, len = sel.options.length; i < len; i++ ) {
		opt = sel.options[i];
		if ( opt.selected === true ) {
			break;
		}
	}

	sel = document.getElementById('salyear');
	var opt2;
	for ( var i = 0, len = sel.options.length; i < len; i++ ) {
		opt2 = sel.options[i];
		if ( opt2.selected === true ) {
			break;
		}
	}
	var sstr = strs + ":" + opt.value + ":" + opt2.value;

	if(strs!=""){ 
		if(opt.value!=""){
			if(opt2.value!=""){
				if (window.XMLHttpRequest) {
					xmlhttp=new XMLHttpRequest();
				}
				xmlhttp.onreadystatechange=function() {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var strres = xmlhttp.responseText;
					var res = strres.split(":");
					document.getElementById("calsal").value = res[0];
					document.getElementById("salary").value = res[0];
					document.getElementById("workhours").value = res[1];
					document.getElementById("fixhours").value = res[2];
					document.getElementById("fsal").value = res[3];
					document.getElementById("days").value = res[4];
					if(res.length>5){
						document.getElementById("extrahours").style.display='block';
						document.getElementById("ehours").value = res[5];
					}
					if(res.length<=5){
						if(document.getElementById("extrahours").style.display=='block' & document.getElementById("ehours").value!=""){
							document.getElementById("extrahours").style.display='none';
							document.getElementById("ehours").value = "";
						}
					}
				}
			  }
			xmlhttp.open("GET","calsalary.php?q="+sstr);
			xmlhttp.send();
		}
	}
}
}
function showUser() {	
	var hsel = document.getElementById('hnm');
	var hopt="";
	for ( var i = 0, len = hsel.options.length; i < len; i++ ) {
		hopt = hsel.options[i];
		if ( hopt.selected === true ) {
			break;
		}
	}
	hsel = document.getElementById('hmonth');
	var hopt2;
	for ( var i = 0, len = hsel.options.length; i < len; i++ ) {
		hopt2 = hsel.options[i];
		if ( hopt2.selected === true ) {
			break;
		}
	}
	hsel = document.getElementById('hyear');
	var hopt3;
	for ( var i = 0, len = hsel.options.length; i < len; i++ ) {
		hopt3 = hsel.options[i];
		if ( hopt3.selected === true ) {
			break;
		}
	}
	if(hopt.value==""){ hopt.value="No"; }
	if(hopt2.value==""){ hopt2.value="No"; }
	if(hopt3.value==""){ hopt3.value="No"; }
	var str = hopt.value + ":" + hopt2.value + ":" + hopt3.value;
	if (str=="") {
	  document.getElementById("txtHint").innerHTML="";
	  return;
	} 
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	}
	xmlhttp.onreadystatechange=function() {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("hresultspan").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","calsalary.php?h="+str);
	xmlhttp.send();
}
	</script>
  </body>
</html>
<?php //}?>