<?php 

	function connectDB(string $dbName){
		$lines = file('db_pwd.txt');
		if(!empty($lines)){
			$pwd = $lines[0];
		} else {
			$pwd = '';
		}
		
		
		try {
			$db = new PDO('mysql:host=localhost;dbname='.$dbName, 'root', $pwd);
			return $db;
		} catch (PDOException $e) {
			//die('DB_ERROR: '.$e->getMessage());
			return false;
		}
	}

?>