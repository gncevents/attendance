<?php
session_start();
$ipAddress=$_SERVER['REMOTE_ADDR'];
$macAddr=false;
$adminmac="";
$adminmac1="b0-83-fe-65-d1-23";
$adminmac3="b0-83-fe-8a-5d-83";
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
//if($macAddr===$adminmac)
{?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Material Design Lite -->
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-indigo.min.css" /> 

<!-- Final Color    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-indigo.min.css" /> -->


    <!-- Material Design icon font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://materializecss.com/css/ghpages-materialize.css" />
	
<link type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

    <style>
        body {font-family: 'Poppins', sans-serif; font-weight:400; font-size: 12px; background-color: #eee;}
	.mdl-layout.is-upgraded .mdl-layout__tab.is-active::after{
		    background: rgb(255, 255, 255) !important;
	}
</style>
<!-- Square card -->
<style>
.demo-card-square.mdl-card {
  width: 320px;
  height: auto;
}
.flex{
	display:flex;
	justify-content:center;
}
.demo-card-square > .mdl-card__title {
  color: #fff;
  background:
    url('../assets/demos/dog.png') bottom right 15% no-repeat #46B6AC;
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
</style>



  </head>
  <body>
    <!-- Simple header with fixed tabs. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">Salary Gateway</span>
        </div>
        <!-- Tabs -->
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
			<a href="#fixed-tab-1" class="mdl-layout__tab is-active">Attendance</a>
			<a href="#fixed-tab-2" class="mdl-layout__tab">Add Paid Salary</a>
			<a href="#fixed-tab-3" class="mdl-layout__tab">History</a>
		</div>


		
        
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Salary Account</span>
      </div>
      <main class="mdl-layout__content">
        <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
          <div class="page-content">
				<iframe src="./admin.php" width="100%" height="100%" style="position:absolute;top:0px;left:0px;right:0px;bottom:0px;overflow:hidden; width:100%; height:100%;" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
		  </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-2">
          <div class="page-content">
			<div style="height:20px;"></div>
			 <div class="col-md-12 flex">
			 <!-- <div class="col-md-8"> -->
				<form action="pay.php" method="POST">

					<div class="col-md-4">
						<div class="demo-card-square mdl-card mdl-shadow--2dp" id="namelist">
							<div class="mdl-card__title mdl-card--expand">
								<h2 class="mdl-card__title-text">Name of List for Payout</h2>
							 </div>
							<div class="mdl-card__supporting-text">
								 <?php  
                                $db="attendance";
                                $link = mysqli_connect('localhost', 'root', 'NoPassword') or die("can not Login.");
                                mysqli_select_db($link,$db) or die("can not Login(Database Error.)");
    
                                $result = mysqli_query($link,"select * from attendance");
                                $i=0;
    
                                while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
                                    $i++;
                                    echo "<label class='mdl-radio mdl-js-radio mdl-js-ripple-effect' for='option-".$i."'>
                                      <input type='radio' id='option-".$i."' class='mdl-radio__button' name='salname' value='".$row[3]."'>
                                      <span class='mdl-radio__label'>".$row[1]."</span></label><div style='height:10px;'></div>";
                                }
								?>
							</div>
							<!-- Colored FAB button with ripple --><div class="text-right">
							<button type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="nameselect" onclick="filldetails()" style="margin-right: 15px !important; margin-bottom: 15px !important;">
							  <i class="material-icons">chevron_right</i>
							</button> <input type="hidden" name="hiddenField" id="hiddenField" value="" /></div>
							<!-- <div class="mdl-card__actions mdl-card--border text-right">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="letter-spacing:1.5px;">
                                    Go Ahead
                                </button>
                            </div> -->
						</div>
					</div>
					<div class="col-md-2"></div>
                    <div class="col-md-3">
                        <div class="demo-card-square mdl-card mdl-shadow--2dp" id="fillcard" style="display:none;">
                          <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text">Salary</h2>
                          </div>
                          <div class="mdl-card__supporting-text">
                            <!-- Numeric Textfield -->
                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="salary">
                                <label class="mdl-textfield__label" for="salary">Salary Amount</label>
                                <span class="mdl-textfield__error">Enter a number!</span>
                              </div>
                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="incentive">
                                <label class="mdl-textfield__label" for="incentive">Incentive</label>
                                <span class="mdl-textfield__error">Enter is not a number!</span>
                              </div>

                              <div class="input-field col s12 m6">
                                <label>Choose Month for Salary</label><br /><br />
                                <select class="icons" name="salmonth" style="display:block;">
                                  <option value="" disabled selected>Choose Month</option>
                                  <option value="January" data-icon="images/sample-1.jpg" class="left circle">January</option>
                                  <option value="February" data-icon="images/office.jpg" class="left circle">February</option>
                                  <option value="March" data-icon="images/yuna.jpg" class="left circle">March</option>
                                  <option value="April" data-icon="images/yuna.jpg" class="left circle">April</option>
                                  <option value="May" data-icon="images/office.jpg" class="left circle">May</option>
                                  <option value="June" data-icon="images/yuna.jpg" class="left circle">June</option>
                                  <option value="July" data-icon="images/yuna.jpg" class="left circle">July</option>
                                  <option value="August" data-icon="images/office.jpg" class="left circle">August</option>
                                  <option value="September" data-icon="images/yuna.jpg" class="left circle">September</option>
                                  <option value="October" data-icon="images/office.jpg" class="left circle">October</option>
                                  <option value="November" data-icon="images/yuna.jpg" class="left circle">November</option>
                                  <option value="December" data-icon="images/yuna.jpg" class="left circle">December</option>
                                </select>										
                              </div>
                              <div class="input-field col s12 m6">
                                <select class="icons" name="salyear" style="display: block; margin-top: 5px;">
                                  <option value="" disabled selected>Choose Year</option>
                                  <option value="2016" data-icon="images/sample-1.jpg" class="left circle">2016</option>
                                  <option value="2017" data-icon="images/office.jpg" class="left circle">2017</option>
                                  <option value="2018" data-icon="images/yuna.jpg" class="left circle">2018</option>
                                  <option value="2019" data-icon="images/yuna.jpg" class="left circle">2019</option>
                                  <option value="2020" data-icon="images/office.jpg" class="left circle">2020</option>
                                </select>										
                              </div>
                              
                              
                            </div>							  
                          <div class="mdl-card__actions mdl-card--border text-right">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="letter-spacing:1.5px;">
                                    Pay Salary
                                </button>
                            </div>
                        </div>
                    </div>
					<div class="col-md-2"></div>
				</form>
				<div class="col-md-2"></div>
			</div>
		  </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-3">
          <div class="page-content">History</div>
        </section>
      </main>
    </div>

	<script>
		function filldetails(){
			var radios = document.getElementsByName('salname');
			for (var i = 0, length = radios.length; i < length; i++) {
				if (radios[i].checked) {
					// do whatever you want with the checked radio
					//alert(radios[i].value);
					document.getElementById("fillcard").style.display='block';
					document.getElementById("hiddenField").value=radios[i].value;
//					document.getElementById("namelist").style.disabled = true;
					for (var j = 0, length = radios.length; j < length; j++) {
						radios[j].disabled=true;
					}
					// only one radio can be logically checked, don't check the rest
					break;
				}
			}
		}
	</script>
  </body>
</html>
<?php }?>