<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Random Login Form</title>
  
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-blue.min.css" /> 
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <style>
body{
	margin: 0;
	padding: 0;
	background: #fff;
	overflow: hidden;
	color: #fff;
	font-family: Arial;
	font-size: 12px;
}
.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background-image: url(http://ginva.com/wp-content/uploads/2012/07/city-skyline-wallpapers-008.jpg);
	background-size: cover;
	-webkit-filter: blur(5px);
	z-index: 0;
}
.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}
.header{
	position: absolute;
	top: calc(50% - 35px);
	left: calc(50% - 255px);
	z-index: 2;
}
.header div{
	float: left;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 35px;
	font-weight: 200;
}
.header div span{
	color: #5379fa !important;
}
.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}
::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}
::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
    </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
<body>
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Add<span>Login</span></div>
		</div>
		<div class="login">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample1" name="nam">
				<label class="mdl-textfield__label" for="sample3" style="color:white;">Name</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample2" name="usrnm">
				<label class="mdl-textfield__label" for="sample3" style="color:white;">User Name</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="sample3" name="mac">
				<label class="mdl-textfield__label" for="sample3" style="color:white;">Mac</label>
			</div>
			<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" style="float:right;">
				<i class="material-icons">add</i>
			</button>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>