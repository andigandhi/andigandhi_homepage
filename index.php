<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://unpkg.com/98.css" />
	<link rel="stylesheet" href="style.css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<title>andigandhi98</title>
</head>
	
<body onResize="positionTaskbar()">

	<div class="window" id="mainMenu">
		<div id="mainMenuSideBar"></div>
		<div id="menuUL">
			<img alt="" src="/img/index/andigandhi98.png" style="width: 150px" onload="positionTaskbar()">
		</div>
	</div>
	
	<!-- Creates the Taskbar -->
	<div class="window" id="taskbar">
		<button id="taskMenBtn" class="taskElement active" style="width: 30px; text-align: center" onClick="toggleMenu()"><img alt="" src="img/index/avatar.png" height="25px"></button>
	</div>

	<!-- Script to add the move listener to the window divs -->
	<script src="js/divMove.js"></script>
	
	<!-- Loads the different window divs and the menu -->
	<script src="js/siteLoader.js"></script>

	<!-- Mastodon Verification -->
	<a rel="me" href="https://defcon.social/@sonnenbrandi"></a>
</body>
</html>
