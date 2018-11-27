<?php 
	$stnd_pwd = array(	'Teilnehmer' 	=> 	'teilnehmer',
						'Dozent' 		=>	'dozent',
						'Admin'			=>	'admin');

	function create_user(string $table, string $vname, string $nname, array $stnd_pwd){
		
		$db = connect_db();

		//User-ID erzeugen
		//1. Umlaute ersetzen:
		$umlaut = array('Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß');
		$ersatz = array('Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss');
		$nname = str_replace($umlaut, $ersatz, $nname);
		$vname = str_replace($umlaut, $ersatz, $vname);

		//Erste 6 Buchstaben des Nachnamens und die ersten 2 des Vornamens konkatenieren
		//Falls Name(n) zu kurz: ganze(n) Namen konkatenieren
		if (!$u_id_n = substr($nname, 0, 6)){
			$u_id_n = $nname;
		}
		if(!$u_id_v = substr($vname, 0, 2)){
			$u_id_v = $vname;
		}

		$u_id = $u_id_n.$u_id_v;

		// Falls UID bereits vergeben: Letzten Buchstaben durch Zahl ersetzen
		$query = 'SELECT U_ID FROM tbl_user WHERE U_ID = :u_id';
		$stmt = $db->prepare($query);
		$stmt->bindValue(':u_id', $u_id);
		$stmt->execute();
		$entry_exists = $stmt->fetch();	
		$count = 1;
		while($entry_exists){
			if($count>9){
				$u_id = substr($u_id, 0 , 6).$count;
			}else{
				$u_id = substr($u_id, 0, 7).$count;
			}
			$stmt->bindValue(':u_id', $u_id);
			$stmt->execute();
			$entry_exists = $stmt->fetch();
			$count++;
		}
		//User in User-Tabelle einfügen und die erzeugte ID zurückgeben
		add_user($u_id, $table, $stnd_pwd);
		return $u_id;
	}

	function add_user(string $u_id, string $table, array $stnd_pwd){
		$db = connect_db();
		//User in tbl_user einfügen; Einfügen in tbl_dozent/tbl_teilnehmer erfolgt in den entsprechenden Skripten
		$stmt = $db->prepare('INSERT INTO tbl_user (U_ID, UPasswd, Role) VALUES(:u_id, :passwd, :role)');
		$stmt->bindValue(':u_id', $u_id);
		
		// Je nach Tabelle werden Rolle und Standard-Passwort zugewiesen
		switch (strtolower($table)) {
			case 'tbl_teilnehmer':
				$role = $db->query('SELECT Role FROM tbl_roles WHERE RBezeichnung = "Teilnehmer"')->fetch();
				$pwd = password_hash($stnd_pwd['Teilnehmer'], PASSWORD_DEFAULT);
				break;
			
			case 'tbl_dozent':
				$role = $db->query('SELECT Role FROM tbl_roles WHERE RBezeichnung = "Dozent"')->fetch();
				$pwd = password_hash($stnd_pwd['Dozent'], PASSWORD_DEFAULT);
				break;

			case 'tbl_adm':
				$role = $db->query('SELECT Role FROM tbl_roles WHERE RBezeichnung = "Admin"')->fetch();
				$pwd = password_hash($stnd_pwd['Admin'], PASSWORD_DEFAULT);
				break;
		}

		$stmt->bindValue(':passwd', $pwd);
		$stmt->bindValue(':role', $role[0]);
		$stmt->execute();

		
	}


	function connect_db()  {
		try {
			$db = new PDO('mysql:host=localhost;dbname=srh', 'root', 'toor');
			return $db;
		} catch (PDOException $e) {
			//die('DB_ERROR: '.$e->getMessage());
			return false;
		}
	}
	
	function get_dozenten($constraint_name){
		$sql_dzl = 'SELECT tbl_dozent.DoNr, DoVorname, DoNachname, KuNr FROM tbl_dozent LEFT JOIN tbl_kurs ON tbl_dozent.DoNr = tbl_kurs.DoNr WHERE DoNachname LIKE :name ORDER BY DoNachname;';
		$stmt = $db->prepare($sql_dzl);
		$name = '';
		if (isset($constraint_name) || $constraint_name != '') {
			$stmt->bindValue(':name', $_POST['constraint_name'].'%');
			
			//echo $_POST['constraint_name'];
			$name .= $_POST['constraint_name'];
		}else{
			$stmt->bindValue(':name', '%');
			//$stmt->bindValue(':kurs', '%');
		}
		$stmt->execute();
		$dzl = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $dzl;
	}
	//$db = connect_db();
	function del_user($uids, $table){
		$users = '';
		$db = connect_db();
		switch ($table) {
			case 'tbl_adm':
				$colname = 'ADM_ID';
				$name = 'Admins';
				break;
			case 'tbl_dozent':
				$colname = 'DoNr';
				$name = 'Dozenten';
				break;
			case 'tbl_teilnehmer':
				$colname = 'TeNr';
				$name = 'Teilnehmer';
				break;
			
			default:
				break;
		}
		if(!empty($uids)){
			
			foreach ($uids as $uid) {
				$sql = 'DELETE FROM ' . $table . ' WHERE '. $colname . ' = :uid;UPDATE tbl_user SET Role = 99 WHERE U_ID = :uid';
				$stmt = $db->prepare($sql);
				$stmt->bindValue(':uid', $uid);
				if($stmt->execute()){
					$users .= $uid.PHP_EOL;

				}
				
			}
			return 'Gelöschte '. $name .':' . PHP_EOL . $users;
		}
		

	}	
	function suggest_lo($suggest){
		$db = connect_db();
		$sql_s = 'SELECT * FROM tbl_dozent WHERE DoNachname LIKE :suggest;' ;
		$stmt = $db->prepare($sql_s);
		$stmt->bindValue(':suggest', $suggest.'%');
		$stmt->execute();
		$lo_sugg = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $lo_sugg;
	}
	function calc_hms($seconds){

		$hours = (int)($seconds / 3600);	
		$min = (int)($seconds / 60) % 60;
		$sec = $seconds % 60;

		return $hours . 'h' . $min . 'm' . $sec . 's';
	}

?>
