<?php
	require ('inventorylink.php');
	echo date("l, F d, Y");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CarteMart</title>
	</head>
	<body>
		<br />
		<form method='POST'>
			Username:
			<input type='text' maxlength='50' id='uname' Placeholder='Username' name='uname' required>
			<br />
			Password:
			<input type='password' maxlength='50' id='pword' Placeholder='Password' name='pword' required>
			<br />
			<button type='submit' name='signin'>Signin</button>
		</form>
	</body>
</html>
<?php
	if (isset($_POST['signin'])){
		$un=$_POST['uname']; $pw=$_POST['pword'];
		$search=mysqli_query($link,"SELECT *
		FROM users
		WHERE BINARY uname='$un' AND BINARY pword='$pw'");
		$usernum=mysqli_num_rows($search);
		if($usernum==1){
			$uinfo=mysqli_fetch_row($search);
			$uname=$uinfo[1]; $alvl=$uinfo[3];
			session_start();
			$_SESSION["uname"]=$uname; $_SESSION["alvl"]=$alvl;
			if($alvl == 0){
				echo ("<script> window.location.href=('AdminHome.php'); </script>");
			}
			if($alvl == 1){
				echo ("<script> window.location.href=('ManagerHome.php'); </script>");
			}
			if($alvl == 2){
				echo ("<script> window.location.href=('CustomerHome.php'); </script>");
			}
		}
		else
			echo ("<script> alert('Invalid Username or Password! Please try again.'); </script>");
	}
	
?>
