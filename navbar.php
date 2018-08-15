<!DOCTYPE html>
<html>
	<head>
		<title>CarteMart</title>
	</head>
	<body>
<?php
	if($_SESSION["alvl"] == 1){
		echo("
			<nav>
				<a href='Managerhome.php'>Home</a>
				<a href='Profile.php'>Profile</a>
				<a href='AllProducts.php'>Products</a>
				<a href='Promos.php'>Promos</a>
				<a href='Settings.php'>Settings</a>
				<a href='Signout.php'>Signout</a>
			</nav>
		");
	}
	else if($_SESSION["alvl"] == 2){
		echo("
			<nav>
				<a href='Customerhome.php'>Home</a>
				<a href='Profile.php'>Profile</a>
				<a href='viewslists.php'>Shopping List</a>
				<a href='AllProducts.php'>Products</a>
				<a href='Promos.php'>Promos</a>
				<a href='Settings.php'>Settings</a>
				<a href='Signout.php'>Signout</a>
			</nav>
		");
	}
?>
	
