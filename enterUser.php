<?php 

	session_start();

	require_once 'user.php';
	require_once 'lib_inc.php';
	if(!isset($_SESSION['login'])) {
		

		if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['passwd'])){
			//var_dump($_POST);
			$user = new User($_POST);
			//var_dump($user->toArray());
			$user->writeToDB();
			$user2 = User::createFromDB($user->getUname());
			$uArray=$user2->toArray();
			unset($uArray['passwd']);
			loginSuccess($user2);
			//print_r($uArray);
			//header('Content-Type: application/json; charset=UTF-8');
			echo json_encode($uArray);
		}
		
	}


 ?>