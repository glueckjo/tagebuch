<?php 
	session_start();
		/*$_SESSION['user'] == null;
		$_SESSION['login'] == false;*/
	unset($_SESSION);

	session_destroy();
	
	



 
?>