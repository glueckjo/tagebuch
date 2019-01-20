<?php 
	session_start();
	require_once 'lib_inc.php';
	require_once 'lib_inc_db.php';
	require_once 'entry.php';

	

	if (isset($_GET['entry_ID'])){
		$entry = new Entry(Entry::readFromDB($_GET['entry_ID']));

?>

<textarea id="changeContent" >
	<?php echo trim($entry->getContent()) ?>
</textarea>
<button id="entryChangeBtn" onclick="changeEntry(<?php echo $_GET['entry_ID'] ?>)">Eintrag speichern</button>
<input type="checkbox" name="entryPublic" id="changePublic" <?php if($entry->getEntryPublic() == 1) echo 'checked'; ?>><label for="entryPublic">Öffentlich</label>
<input type="checkbox" name="entryVisible" id="changeVisible" <?php if($entry->getVisible() == 1) echo 'checked'; ?>><label for="entryVisible">Sichtbar</label>
<button id="backBTN" onclick="loadContent('entries');">Abbrechen</button>
<?php } 
		elseif (isset($_POST)) {
			$updatedEntry = new Entry($_POST);
			$updatedEntry->updateDB();
	}?>