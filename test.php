<?php 
	session_start();
	
	require_once 'user.php';
	require_once 'entry.php';
	include_once 'lib_inc_db.php';
	//require_once 'entry_from_db.php';
	//unset($_SESSION['login']);
	/*var_dump($_SESSION);
	var_dump($_POST);
	var_dump($_COOKIE);
	die;

	$user1 = new User('Zweiter', 'Tester', '1Passwort');

	$user2 = new User('Super', 'Admin', '2Passwort');
	$user2->setRole(2);
	$user2->writeToDB();
	var_dump($user1->getFname());
	var_dump($user1->getUname());
	var_dump($user1->getLname());
	//var_dump($user1->getPWordTestingOnly());
	$user1->writeToDB();*/

	$entry1 = new Entry($entries = ['content' => 'MYSQL UND BOOL...4ter Versuch', 'uname' => 'adminsu', 'entryPublic' => true]);
	//var_dump($entry1->getContent());
	echo $entry1->getContent();
	echo $entry1->getUserName() . '<br/>';
	var_dump($entry1->getVisible());
	var_dump($entry1->getEntryPublic());
	$entry1->writeDB();

/*
	$entry2 = new Entry(Entry::readFromDB(1));
	var_dump($entry2->getContent());
	var_dump($entry2->getEntryID());
	var_dump($entry2->getUserName());
	//$entry2->readFromDB();
*/
 ?>
