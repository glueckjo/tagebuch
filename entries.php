<?php 
	require_once 'lib_inc.php';
	require_once 'lib_inc_db.php';
	require_once 'entry.php';
	require_once 'entry_from_db.php';
	$db = connectDB('tagebuch');
	$user = $_COOKIE['uname'];


	$sql = 'SELECT entry_ID FROM tbl_entry WHERE uname = :uname OR entryPublic = true ORDER BY entry_ID DESC';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':uname', $user);
	$stmt->execute();
	$ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt = null;
	$users = [];
	//var_dump($entries);
	//var_dump($_POST);
	$entries = [];
	foreach ($ids as $key => $value) {
		$entries[] = new Entry(Entry::readFromDB($value['entry_ID']));
		$users[] = User::createFromDB($entries[$key]->getUserName());
	}
	
	if (isset($_POST['uname']) && isset($_POST['content'])): 
		//var_dump($_POST);
		$_POST['content'] = strip_tags($_POST['content'], '<a>');
		$entry = new Entry($_POST);

		/*$entries[] = $entry;
		$users[] = $_POST['uname'];*/
	
		$entry->writeDB();
	endif
	
?>

<textarea id="entryContent"></textarea>
<button onclick="saveEntry()">Eintrag speichern</button>

<?php 
	
?>


	<div>
		<?php if (isset($entries)): ?>
			<?php foreach ($entries as $key => $value): ?>
				<div class="entryComplete">
					<div class="userDetails">
						<table>
							<tr>
								<td><?php echo $value->getEntryID() ?></td>
							</tr>
							<tr>
								<td><?php echo $users[$key]->getFname() . ' ' . $users[$key]->getLname() . ' (' . $users[$key]->getUname() . ')' ?></td>
							</tr>
						</table>
					</div>
					<div class="entryContent">
						<p>
							<?php echo nl2br($value->getContent()) ?>
						</p>
							
						
						
					</div>
				</div>
				
			<?php endforeach ?>
		<?php endif ?>

	</div>


