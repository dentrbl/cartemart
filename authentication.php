<?PHP
	if(empty($_SESSION["uname"])){
		session_destroy();
		header('Location: signin.php');
	}
?>