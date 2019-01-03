<?php 
	require_once 'lib_inc_db.php';
	class User
	{
		/* Erzeugung von PDO sollte ausgelagert werden*/
		//include_once 'lib_inc_db.php';
		protected $fname = '';
		protected $lname = '';
		protected $uname = '';
		protected $pword = '';
		protected $role = 1;

		function __construct(array $userArray)
		{
			//$this->uname = checkUname(createUname($fname, $lname));
			//$this->uname = createUname($fname, $lname);
			//$this->uname = $lname.$fname;
			if(!isset($userArray['uname'])){
				$this->uname = $this->checkUname($this->createUname($userArray['fname'], $userArray['lname']));
			}else{
				$this->uname = $userArray['uname'];
			}
			if(isset($userArray['passwd'])){
				$this->pword = password_hash($userArray['passwd'], PASSWORD_DEFAULT);
			}elseif (isset($userArray['pword'])) {
				$this->pword = $userArray['pword'];
			}

			// Passwort-Hash in Methode auslagern?
			

			$this->fname = $userArray['fname'];
			$this->lname = $userArray['lname'];

			if(isset($userArray['role'])){
				$this->role = $userArray['role'];
			}else{
				$this->role = 1;
			}
			
			
			
		}


		public function getFname(){
			return $this->fname;
		}
		public function getLname(){
			return $this->lname;
		}
		public function getUname(){
			return $this->uname;
		}
		public function getRole(){
			return $this->role;
		}

		/*!**** entfernen, wenn writeToDB() implementiert wurde ****!*/
		public function getPWordTestingOnly(){						//
			return $this->pword;									//
		}															//
		/*!**** entfernen, wenn writeToDB() implementiert wurde ****!*/


		public function setRole(int $role){
			$this->role = $role;
		}

		public function toArray() {
			$array =  [
				'fname'	=>	$this->fname,
				'lname'	=>	$this->lname,
				'uname'	=>	$this->uname,
				'role'	=>	$this->role,
				'passwd'=>	$this->pword
			];
			return $array;
		}



		private function createUname(string $fname, string $lname){

			$umlaut = array('Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß');
			$ersatz = array('Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss');
			$lname = str_replace($umlaut, $ersatz, $lname);
			$fname = str_replace($umlaut, $ersatz, $fname);

			/* Erste 6 Buchstaben des Nachnamens und die ersten 2 des Vornamens konkatenieren
			Falls Name(n) zu kurz: ganze(n) Namen konkatenieren */
			if (!$unameL = substr($lname, 0, 6)){
				$unameL = $lname;
			}
			if(!$unameF = substr($fname, 0, 2)){
				$unameF = $fname;
			}

			$uname = $unameL.$unameF;
			
			return strtolower($uname);


			

			
		}

		private function checkUname(string $uname){
			try {
				$db = connectDB('tagebuch');
				if($db){
					$query = 'SELECT uname FROM tbl_user WHERE uname = :uname';
					$stmt = $db->prepare($query);
					$stmt->bindValue(':uname', $uname);
					$stmt->execute();

					/* fetch reicht, ein Eintrag bedeutet, dass die While-Schleife durchlaufen wird. */
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
				}
				
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$db = null;
				$stmt = null;
			}
		}

		public function writeToDB(){
			try {
				$db = connectDB('tagebuch');

				$sql_i = 'INSERT INTO tbl_user (uname, fname, lname, pword, role) VALUES (:uname, :fname, :lname, :pword, :role)';
				$sql_u = 'UPDATE tbl_user SET role = :role WHERE uname = :uname';
				$sql_q = 'SELECT * FROM tbl_user WHERE uname = :uname';
				$stmt = $db->prepare($sql_q);
				$stmt->bindValue(':uname', $this->uname);
				$stmt->execute();
				if ($stmt->fetch()){
					$sql = $sql_u;
				}else {
					$sql = $sql_i;
				}
				$stmt = $db->prepare($sql);
				$stmt->bindValue(':uname', $this->uname);
				$stmt->bindValue(':fname', $this->fname);
				$stmt->bindValue(':lname', $this->lname);
				$stmt->bindValue(':pword', $this->pword);
				$stmt->bindValue(':role', $this->role);
				$stmt->execute();

			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$db = null;
				$stmt = null;
			}
		}

		public static function checkPassword(string $uname, string $password) {
			try {
				$db = connectDB('tagebuch');
				$sql = 'SELECT pword FROM tbl_user WHERE uname = :uname';
				$stmt = $db->prepare($sql);
				$stmt->bindValue(':uname', $uname);
				$stmt->execute();
				$pwd_hash = $stmt->fetch(PDO::FETCH_NUM)[0];
				if(isset($pwd_hash) && password_verify($password, $pwd_hash)){
					//echo "success";
					return true;
				}else{
					//echo "failure";
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}finally{
				$db = null;
				$stmt = null;
			}
		}

		public static function createFromDB(string $uname){
			try {
				$db = connectDB('tagebuch');
				$sql = 'SELECT uname, fname, lname, role , pword FROM tbl_user WHERE uname = :uname';
				$stmt = $db->prepare($sql);
				$stmt->bindValue(':uname', $uname);
				$stmt->execute();
				$userArray = (array) $stmt->fetch(PDO::FETCH_ASSOC);
				$user = new User($userArray);
				return $user;
				//return $userArray;

			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}

	}
?>
