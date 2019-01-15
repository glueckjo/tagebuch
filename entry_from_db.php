<?php 
	
	/**
	 * Einträge, die aus der DB gelesen wurden
	 */
	require_once 'entry.php';
	class EntryFromDB extends Entry
	{
		
		function __construct(int $entry_ID)
		{
			$entryArray = Entry::readFromDB($entry_ID);
			$this->entryID = $entryArray['entry_ID'];
			$this->content = $entryArray['content'];
			$this->entryPublic = $entryArray['entryPublic'];
			$this->userName = $entryArray['uname'];
			$this->visible = $entryArray['entryVisible'];
			/*	
			$this->content = $content;
			$this->userName = $userName;
			$this->visible = $visible;
			$this->entryPublic = $entryPublic;
			$this->entryID = $entryID;
			*/
		}
		
		/*private function readFromDB(int $entry_ID){
			//var_dump($db = connectDB('tagebuch'));
			if($db = connectDB('tagebuch')){
				try {
					$stmt = $db->prepare('SELECT * FROM tbl_entry WHERE entry_ID = :entry_ID');
					$stmt->bindValue(':entry_ID', $entry_ID);
					$stmt->execute();
					return $entryArray = $stmt->fetch(PDO::FETCH_ASSOC);
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
				

			}
		}*/


	}

 ?>