<?php 
	include_once 'user.php';


	$user1 = new User('Super', 'Admin', '1Passwort!');
	var_dump($user1->getFname());
	var_dump($user1->getUname());
	var_dump($user1->getLname());
	var_dump($user1->getPWordTestingOnly());

 ?>