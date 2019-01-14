<?php 
	session_start();
		/*$_SESSION['user'] == null;
		$_SESSION['login'] == false;*/
	//unset($_COOKIE['lname']);
	foreach ($_COOKIE as $key => $value) {
		if ($key != 'PHPSESSID'){
			setcookie($key, '', time() - 60);
		}
	}
	unset($_SESSION);
	setcookie('logout', 'yes');

	session_destroy();
	
	



 
?>