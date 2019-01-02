<?php 
	session_start();
	if(!isset($_SESSION['login'])){
?>
<script type="text/javascript"></script>
<form method="POST" action="#">
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
			<td><label for="password">Passwort</label></td>
			<td><input type="password" name="password" id="password"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Registrieren"></td>
		</tr>
	</table>
	
	

</form>















<?php
	}else{
?>



<?php		
	}
 ?>