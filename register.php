<?php 
	session_start();
	if(!isset($_SESSION['login'])){

?>
<script type="text/javascript"></script>
<form method="POST" action="enterUser.php" onsubmit="return registerUser(this);">
	<table>
		<tr>
			<td><label for="fname">Vorname</label></td>
			<td><input type="text" name="fname" id="fname"></td>
		</tr>
		<tr>
			<td><label for="lname">Nachname</label></td>
			<td><input type="text" name="lname" id="lname"></td>
		</tr>
		<tr>
			<td><label for="passwd">Passwort</label></td>
			<td><input type="password" name="passwd" id="passwd"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Registrieren"></td>
		</tr>
	</table>
	
	

</form>
<!--<button onclick="runEffect()">Verstecken</button>-->
<button onclick="showLogin()">Anmelden</button>















<?php
	}
 ?>