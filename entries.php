<?php 
	session_start();
	require_once 'lib_inc.php';
	require_once 'lib_inc_db.php';
	require_once 'entry.php';
	require_once 'entry_from_db.php';
	$db = connectDB('tagebuch');
	//file_put_contents('testfile.txt', 'hello1');
	//var_dump($_POST);

	if(isset($_GET['seluname']) ){
		if($_COOKIE['uname'] == $_GET['seluname']){
			$sql = 'SELECT entry_ID FROM tbl_entry WHERE uname = :uname  AND entryVisible = 1 ORDER BY entry_ID DESC';
			$user = $_GET['seluname'];
		}
		else {
			$sql = 'SELECT entry_ID FROM tbl_entry WHERE uname = :uname AND entryPublic = 1 AND entryVisible = 1 ORDER BY entry_ID DESC';
			$user = $_GET['seluname'];
		}
	}
	else {
		$sql = 'SELECT entry_ID FROM tbl_entry WHERE (uname = :uname OR entryPublic = 1) AND entryVisible = 1 ORDER BY entry_ID DESC';
		$user = $_COOKIE['uname'];
	}

	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':uname', $user);
	$stmt->execute();
	$ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt = null;

	$users = [];
	//$users_all = [];
	$sql_ua = 'SELECT * FROM tbl_user';
	$users_all = $db->query($sql_ua)->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($entries);
	//var_dump($_POST);
	$entries = [];
	foreach ($ids as $key => $value) {
		$entries[] = new Entry(Entry::readFromDB($value['entry_ID']));
		$users[] = User::createFromDB($entries[$key]->getUserName());
	}
	

	if (isset($_POST['uname']) && isset($_POST['content']) && $_POST['content'] != ""){ 
		$_POST['content'] = trim(strip_tags($_POST['content'], '<a><img>'));
		$entry = new Entry($_POST);	
		$entry->writeDB();
	}

	$db = null;
?>



<!-- Liste der User Hier müssen hier rein mit Links  Am besten nur die User namen dann reicht die Zeile immer -->
<div id="contentEntryAll" class="row">
	<div id="userList" >
	
		<?php foreach ($users_all as $key => $value): ?>
			<details>
				<summary><?php echo $value['uname']; ?></summary>
				<p>
					<a href="#" onclick="return selUserEntries('<?php echo $value['uname']; ?>')"><?php echo $value['fname'] . ' ' . $value['lname']; ?></a>
				</p>
			</details>
			
		<?php endforeach ?>
	
	</div>
	
	<!--Neuer Beitrag da muss noch ein Effect drauf mit ausblenden-->
	<div id="contentEntry" class="flex5">
		<div id="newEntryDiv">
			<textarea id="entryContent" placeholder="Hier können Sie einen Neuen Beitrag verfassen..."></textarea>
			<button id="entrySaveBtn" onclick="saveEntry()">Eintrag speichern</button>
			<input type="checkbox" name="entryPublic" id="entryPublic"><label for="entryPublic">Öffentlich</label>
			<input type="checkbox" name="entryVisible" id="entryVisible" checked><label for="entryVisible">Sichtbar</label>
		</div >
		<div>
			<button id="newEntryBtn" onclick="newEntryShow()" >Neuer Eintrag</button>
		</div>



		<!--Entry nichts Verändert-->
		<div>
			<?php if (isset($entries)): ?>
				<?php foreach ($entries as $key => $value): ?>
					<?php if ($value->getUserName() == $_COOKIE['uname']): ?>
						<div id="<?php echo $value->getEntryID() ?>" class="entryComplete" onclick="editEntry(<?php echo $value->getEntryID() ?>)">
					<?php else: ?>
						<div id="<?php echo $value->getEntryID() ?>" class="entryComplete">
					<?php endif ?>
					
						<div class="userDetails">
							<table>
								<tr>
									<td><?php echo $value->getEntryID() ?></td>
								</tr>
								<tr>
									<td><?php echo $users[$key]->getFname() . ' ' . $users[$key]->getLname() . ' (' . $users[$key]->getUname() . ')' ?></td>
								</tr>
								<?php if ($users[$key]->getUname() == $_COOKIE['uname']): ?>
									<tr>
										<td>
											<?php if ($value->getEntryPublic()): ?>
												<strong><?php echo 'Öffentlicher Eintrag' ?></strong>
											<?php else: ?>
												<strong><?php echo 'Privater Eintrag' ?></strong>
											<?php endif ?>
										</td>
									</tr>
								<?php endif ?>
							</table>
						</div>
						<div class="entryContent">
							
								<?php echo nl2br($value->getContent()) ?>
							
						</div>
					</div>
				<?php endforeach ?>
			<?php endif ?>
		</div>
	</div>
</div>
