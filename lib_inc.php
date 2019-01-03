<?php 
	require_once 'user.php';
	require_once 'lib_inc_db.php';
	require_once 'entry.php';
	
	function loginSuccess(User $user){
		$_SESSION['user'] = $user;
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
		setcookie('login', 'ok');
	}

?>