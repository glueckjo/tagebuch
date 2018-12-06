<?php 
	require_once 'user.php';
	require_once 'entry.php';
	//include_once 'lib_inc_db.php';
	require_once 'entry_from_db.php';


	$user1 = new User('Super', 'Admin', '1Passwort!');
	var_dump($user1->getFname());
	var_dump($user1->getUname());
	var_dump($user1->getLname());
	//var_dump($user1->getPWordTestingOnly());

	$entry1 = new Entry('Das ist ein Test-Eintrag', 'adminsu', true, true);
	var_dump($entry1->getContent());
	$entry1->writeDB('tagebuch');

	$entry2 = new EntryFromDB();
	//$entry2->readFromDB();

 ?>
