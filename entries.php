<?php 
	require_once 'lib_inc.php';
	require_once 'lib_inc_db.php';
	require_once 'entry.php';
	require_once 'entry_from_db.php';
	$db = connectDB('tagebuch');
	$user = $_COOKIE['uname'];
	$sql = 'SELECT entry_ID FROM tbl_entry WHERE uname = :uname';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':uname', $user);
	$stmt->execute();
	$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<textarea id="entryContent"></textarea>
<button onclick="saveEntry()">Eintrag speichern</button>

<?php if (isset($_POST['uname']) && isset($_POST['content'])): 
	$entry = new Entry($_POST);
	$entry->writeDB();

	

?>
	
<?php endif ?>