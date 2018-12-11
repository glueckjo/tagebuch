<?php 

	function connectDB(string $dbName){
		$lines = file('db_pwd.txt');
		$pwd = $lines[0];
		try {
			$db = new PDO('mysql:host=localhost;dbname='.$dbName, 'root', $pwd);
			return $db;
		} catch (PDOException $e) {
			//die('DB_ERROR: '.$e->getMessage());
			return false;
		}
	}

?>