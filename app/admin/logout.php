<?php 
	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();

	setcookie('key_admin', '', time() - (86400 * 30));
	setcookie('key1_admin', '', time() - (86400 * 30));

	header("Location: login.php");
	exit;


 ?>