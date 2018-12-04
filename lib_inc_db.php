<?php 

	function connectDB(string $dbName){
		try {
			$db = new PDO('mysql:host=localhost;dbname='.$dbName, 'root', '');
			return $db;
		} catch (PDOException $e) {
			//die('DB_ERROR: '.$e->getMessage());
			return false;
		}
	}

?>