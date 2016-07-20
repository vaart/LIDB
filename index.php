<?php 
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Liquor Database </title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
	 <?php
	 if(isset($_SESSION['sessionID'])){
	 	echo "<nav>
				<ul>
					<a href='index.php'><li id='activeLink'>HOME</li></a>
					<a href='#'><li>PROFILE</li></a>
					<a href='ratings.php'><li>RATINGS</li></a>
					<a href='shops.php'><li>SHOPS</li></a>
					<a href='events.php'><li>EVENTS</li></a>
					<a href='places.php'><li>PLACES</li></a>
					<a href='info.php'><li>INFO</li></a>
					<a id='logoutLink' href='#'><li>LOGOUT</li></a>
				</ul>
			</nav>";
	 	include("partials/profile.php");
	 }else{
	 	echo '<nav>
		<ul>
			<a href="index.php"><li id="activeLink">HOME</li></a>
			<a id="loginBtn" href="#"><li>SIGN IN</li></a>
			<a id="RegisterBtn" href="#"><li>REGISTER</li></a>
			<a href="ratings.php"><li>RATINGS</li></a>
			<a href="shops.php"><li>SHOPS</li></a>
			<a href="events.php"><li>EVENTS</li></a>
			<a href="places.php"><li>PLACES</li></a>
			<a href="info.php"><li>INFO</li></a>
		</ul>
	</nav>';
	 	include("partials/registration.php");
	 	include("partials/login.php");
	 }
		
	 ?>



	<script src="js/jquery.2.2.4.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>