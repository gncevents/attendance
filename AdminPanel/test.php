<!DOCTYPE html>
<html>
  <head>
    <!-- Material Design Lite -->
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="./js/materialize.min.js"></script>
		<script src="./js/materialize.js"></script>
<link rel="stylesheet" type="text/css" href="https://code.getmdl.io/1.3.0/material.blue_grey-red.min.css" />
<link rel="stylesheet" type="text/css" href="./css/materialize.css" />
<link rel="stylesheet" type="text/css" href="./css/materialize.min.css" />

<!-- Final Color    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-indigo.min.css" /> -->


    <!-- Material Design icon font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="http://materializecss.com/css/ghpages-materialize.css" />
	
<link type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="http://cdn.transifex.com/live.js"></script>
<link type="text/css" href="http://materializecss.com/css/prism.css" rel="stylesheet" />

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

<div class="input-field col s12 m6">
                <div class="select-wrapper icons"><span class="caret"></span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-7d7c8ea9-0880-401c-e20d-a52e2deb1a33" value="Choose your option"><ul id="select-options-7d7c8ea9-0880-401c-e20d-a52e2deb1a33" class="dropdown-content select-dropdown" style="width: 520px; position: absolute; top: 0px; left: 0px; opacity: 1; display: none;"><li class="disabled"><span>Choose your option</span></li><li class=""><img alt="" src="images/sample-1.jpg" class="left circle"><span>example 1</span></li><li class=""><img alt="" src="images/office.jpg" class="left circle"><span>example 2</span></li><li class=""><img alt="" src="images/yuna.jpg" class="left circle"><span>example 3</span></li></ul><select class="icons initialized">
                  <option value="" disabled="" selected="">Choose your option</option>
                  <option value="" data-icon="images/sample-1.jpg" class="left circle">example 1</option>
                  <option value="" data-icon="images/office.jpg" class="left circle">example 2</option>
                  <option value="" data-icon="images/yuna.jpg" class="left circle">example 3</option>
                </select></div>
                <label>Images in select</label>
              </div>

			  <script type="text/javascript">
				$(document).ready(function() {
					$('select').material_select();
				  });
			  </script>
			  </body>
			  </html>