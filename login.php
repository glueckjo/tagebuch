<?php 
	session_start();
	require_once 'user.php';
	require_once 'lib_inc_db.php';

	if (isset($_POST['uname']) && isset($_POST['passwd'])){
		if(User::checkPassword($_POST['uname'], $_POST['passwd'])){
			$_SESSION['user'] = User::createFromDB($_POST['uname']);
			$_SESSION['login'] = true;
			
			echo ' - ' . $_SESSION['user']->getFname() . ' ';
			echo $_SESSION['user']->getLname();
			
			//echo '<button onclick="runEffect()">Verstecken</button>';
		}else{
			unset($_SESSION['user']);
			unset($_SESSION['login']);
			http_response_code(300);

		}
	}else{
		//echo 'Problem Formular';
		unset($_SESSION['user']);
		unset($_SESSION['login']);
		http_response_code(500);
	}
?>