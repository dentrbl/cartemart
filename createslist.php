<?php
	require ('inventorylink.php');
	session_start();
	require ('authentication.php');
	$uname=$_SESSION["uname"];
	include('navbar.php');
?>
	<form method='post'>
		Enter budget:<br />
		<input type='number' step='0.01' placeholder = 'amount' name = 'budget' required>
		<button type='submit' name='cbudget'>Enter</button>
	</form>
	</body>
</html>