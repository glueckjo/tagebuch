<form action="login.php" method="POST" onsubmit="return login(this);">
	<table>
		<tr>
		<td><label for="uname">Username:</label></td>
		<td><input type="text" name="uname" id="uname"/></td>
		</tr>
		<tr>
		<td><label for="passwd">Password:</label></td>
		<td><input type="password" name="passwd" id="passwd"/></td>
		</tr>
		<tr>
		<td></td>
			<!--<td><input type="button" value="Anmelden" onclick="login()" /></td>-->
			<td><input type="submit" value="Anmelden"></td>
			<td></td>
		</tr>
	</table>
</form>
<label for="Neues Mitglied">Neu Hier?</label>
<button class="toggelBtn" onclick="showRegistration()">Registrieren</button>
<!--<button onclick="runEffect()">Verstecken</button>-->
