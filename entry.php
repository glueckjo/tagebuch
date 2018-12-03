<?php
	class entry{

		protected $entryID = "";
		protected $content = "";
		protected $userName = "";
		protected $visible =  "";
		protected $entryPublic = "";

		function __construct($content, $userName, $visible, $entryPublic){
			$this->content = $content;
			$this->userName = $userName;
			$this->visible = $visible;
			$this->entryPublic = $entryPublic;
		}

		function setEntryID($entryID){
			$this->entryID = $entryID;
		}

		function setViseble($visible){
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
	}
?>
