<?php 
	
	/**
	 * Einträge, die aus der DB gelesen wurden
	 */
	class EntryFromDB extends Entry
	{
		
		function __construct()
		{
			$this->readFromDB();
			/*	
			$this->content = $content;
			$this->userName = $userName;
			$this->visible = $visible;
			$this->entryPublic = $entryPublic;
			$this->entryID = $entryID;
			*/
		}
		
		public function readFromDB(){
			//var_dump($db = connectDB('tagebuch'));
			if($db = connectDB('tagebuch')){
				$stmt = $db->prepare()
			}
		}
	}

 ?>