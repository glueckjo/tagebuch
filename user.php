<?php 
	
	class User
	{
		protected $fname = '';
		protected $lname = '';
		protected $uname = '';
		protected $pword = '';
		protected $role = 1;

		function __construct(string $fname, string $lname, string $pword)
		{
			$this->uname = checkUname(createUname($fname, $lname));
			$this->pword = password_hash($pword, PASSWORD_DEFAULT);
			$this->fname = $fname;
			$this->lname = $lname;
		}


		function getFname(){
			return $this->fname;
		}
		function getLname(){
			return $this->lname;
		}
		function getUname(){
			return $this->uname;
		}
		function getRole(){
			return $this->role;
		}

		function setRole(int $role){
			$this->role = $role;
		}

		function createUname(string $fname, string $lname){

			$umlaut = array('Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß');
			$ersatz = array('Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss');
			$lname = str_replace($umlaut, $ersatz, $nname);
			$fname = str_replace($umlaut, $ersatz, $vname);

			//Erste 6 Buchstaben des Nachnamens und die ersten 2 des Vornamens konkatenieren
			//Falls Name(n) zu kurz: ganze(n) Namen konkatenieren
			if (!$unameL = substr($lname, 0, 6)){
				$unameL = $lname;
			}
			if(!$unameF = substr($fname, 0, 2)){
				$unameF = $fname;
			}

			$uname = $unameL.$unameF;
			
			//TODO return



			

			
		}

		function checkUname(string $uname){
			try {
				$db = new PDO('mysql:host=localhost;dbname=tagebuch', 'root', '');
				$query = 'SELECT uname FROM tbl_user WHERE uname = :uname';
				$stmt = $db->prepare($query);
				$stmt->bindValue(':uname', $uname);
				$stmt->execute();
				$entry_exists = $stmt->fetch();	
				$count = 1;
				while($entry_exists){
					if($count>9){
						$uname = substr($uname, 0 , 6).$count;
					}else{
						$uname = substr($uname, 0, 7).$count;
					}
					$stmt->bindValue(':uname', $uname);
					$stmt->execute();
					$entry_exists = $stmt->fetch();
					$count++;
				}
				return $uname;
			} catch (PDOException $e) {
				die('DB-Error: '.$e->getMessage())
			}
		}

	}
?>
