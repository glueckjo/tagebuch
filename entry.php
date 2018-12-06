<?php
	require_once 'lib_inc_db.php';

	class Entry{

		//bla
		protected $entryID;
		protected $content = "";
		protected $userName = "";
		protected $visible = true;
		protected $entryPublic = false;

		//Erzeugen eines Entry-Objektes beim Eintragen
		function __construct(string $content, string $userName, bool $visible, bool $entryPublic){
			$this->content = $content;
			$this->userName = $userName;
			$this->visible = $visible;
			$this->entryPublic = $entryPublic;
		}

		/* Erzeugen eines Entry-Objektes aus der DB: in PHP gibt es kein Überladen von Funktionen / Methoden, da müssen wir uns noch was überlegen (eigene entryFromDB Klasse?)
		function __construct(string $content, string $userName, bool $visible, bool $entryPublic, int entryID){
			$this->content = $content;
			$this->userName = $userName;
			$this->visible = $visible;
			$this->entryPublic = $entryPublic;
		}
		*/


		public function setEntryID($entryID){
			$this->entryID = $entryID;
		}
		

		//Visible
		function setVisible($visible){
			$this->visible = $visible;
		}

		function setEntryPublic($entryPublic){
			$this->entryPublic = $entryPublic;
		}

		function getContent(){
			return $this->content;
		}

		function getEntryID(){
			return $this->entryID;
		}

		function getUserName(){
			return $this->userName;
		}

		function getEntryPublic(){
			return $this->entryPublic;
		}

		function getVisible(){
			return $this->visible;
		}

		function writeDB(string $dbName){
			
			if($db = connectDB($dbName)){
				try {
					$stmt = $db->prepare('INSERT INTO tbl_entry (uname, content, entryPublic, entryVisible) VALUES (:uname, :content, :entryPublic, :entryVisible)');
					$stmt->bindValue(':uname', $this->userName);
					$stmt->bindValue(':content', $this->content);
					$stmt->bindValue(':entryPublic', $this->entryPublic);
					$stmt->bindValue(':entryVisible', $this->visible);
					$stmt->execute();
				} catch (PDOException $e) {
					echo 'DB_ERROR: ' . $e->getMessage();
				} finally {
					$db = null;
					$stmt = null;
				}
				
			}
			
		}
	}
?>
