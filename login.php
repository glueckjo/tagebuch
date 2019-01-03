<?php 
	session_start();
	require_once 'user.php';
	require_once 'lib_inc_db.php';
	require_once 'lib_inc.php';

	if (isset($_POST['uname']) && isset($_POST['passwd'])){
		if(User::checkPassword($_POST['uname'], $_POST['passwd'])){
			loginSuccess(User::createFromDB($_POST['uname']));
/*			$_SESSION['user'] = User::createFromDB($_POST['uname']);
			$_SESSION['login'] = true;
			$value = [
				'fname' => $_SESSION['user']->getFname(),
				'lname' => $_SESSION['user']->getLname(),
				'uname' => $_SESSION['user']->getUname(),
				'role'  => $_SESSION['user']->getRole()
			];
			//$value = implode(';', $value);
			setcookie('fname', $value['fname']);
			setcookie('lname', $value['lname']);
			setcookie('uname', $value['uname']);
			setcookie('role', $value['role']);
			setcookie('login', 'ok');*/
			echo ' - ' . $_SESSION['user']->getUname() . ' ';
			//echo $_SESSION['user']->getLname();
			
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