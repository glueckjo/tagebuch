<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="css/CSS.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript">

		function showLogin() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					document.getElementById('effect').style.display = 'block';
					document.getElementById('effect').innerHTML = this.responseText;
					document.getElementById('effectBtn').style.display = 'none';
					//document.getElementById('logoutBtn').style.display = 'block';
				}
			};
			xhttp.open("GET", "loginform.php", true);
			xhttp.send();
		}	
	    // run the currently selected effect
	    function runEffect() {
	      // get effect type from
	      var selectedEffect = $( "#effectTypes" ).val();
	 
	      // Most effect types need no options passed by default
	      var options = {};
	      // some effects have required parameters
	      if ( selectedEffect === "scale" ) {
	        options = { percent: 50 };
	      } else if ( selectedEffect === "size" ) {
	        options = { to: { width: 200, height: 60 } };
	      }
	 
	      // Run the effect
	      $( "#effect" ).toggle( selectedEffect, options, 500 );
		  $("#effectBtn").toggle();
		  showLogin();
	    };
	 
	    // Set effect from select menu value
	    /*$( "button" ).on( "click", function() {
	      runEffect();
	    });*/
		//});


		//	TODO:
		//		* Funktion um login-Status beim Laden der Seite zu prüfen und entsprechende Buttons, Überschriften etc. anzupassen
		//		* toggle effect 
		//		* sinnvolle Inhalte im effect-div bei eingeloggtem User
		//		* Vor Login: Willkommen, nach Logout: auf Wiedersehen, nach Login: Eigene Einträge, Such-/Filter-Elemente
		//		* register.php fertigschreiben

		function login(oFormElement) {
			//var uname = document.getElementById('uname').value;
			//var passwd = document.getElementById('passwd').value;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200) {
					//document.reload();
					document.getElementById('title').innerHTML += this.responseText;
					document.getElementById('effect').style.display = 'none';
					document.getElementById('logoutBtn').style.display = 'block';
				}
			};
			xhttp.open(oFormElement.method, oFormElement.action, true);
			//xhttp.setRequestHeader("Content-type", "apllication/x-www-form-urlencoded");
			xhttp.send(new FormData(oFormElement));
			return false;
		}

		function showRegistration(){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					document.getElementById('effect').style.display = 'block';
					document.getElementById('effect').innerHTML = this.responseText;
					document.getElementById('effectBtn').style.display = 'none';
					//document.getElementById('logoutBtn').style.display = 'block';
				}
			};
			xhttp.open("GET", "register.php", true);
			xhttp.send();
		}

		function registerUser(oFormElement) {
			var xhttp = new XMLHttpRequest();

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					//var user = this.responseText;
					var user = JSON.parse(this.response);
					//alert(user);
					document.getElementById('title').innerHTML += ' - ' + user['uname'];
					document.getElementById('effect').style.display = 'none';
					document.getElementById('logoutBtn').style.display = 'block';
				}
			};

			xhttp.open(oFormElement.method, oFormElement.action, true);
			//xhttp.setRequestHeader('Content-type', 'multipart/form-data');
			xhttp.send(new FormData(oFormElement));
			return false;
		}

		function logout(){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200){
					//alert('Logout erfolgreich');
					//$( "#effect" ).toggle();
					//location.reload();
					document.getElementById('logoutBtn').style.display = 'none';
					document.getElementById('title').innerHTML = 'Digitales Tagebuch';
					document.getElementById('effect').style.display = 'none';
					document.getElementById('effectBtn').style.display = 'block';
					

				}	
			};
			xhttp.open("GET", "logout.php", true);
			xhttp.send();

		}

		function checkCookie(cname){
			var name = cname + '=';
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for (var i = 0; i < ca.length; i++){
				var c = ca[i];
				while (c.charAt(0) == ' '){
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return '';
		}

		function checkLogin(){
			/*document.getElementById('logoutBtn').style.display = 'none';
			document.getElementById('effectBtn').style.display = 'none';
			document.getElementById('effect').style.display = 'none';*/
			if(checkCookie('login') == 'ok'){
				document.getElementById('title').innerHTML += ' - ' + checkCookie('uname');
				document.getElementById('effect').style.display = 'none';
				document.getElementById('effectBtn').style.display = 'none';
				document.getElementById('logoutBtn').style.display = 'block';

			}else{
				document.getElementById('effectBtn').style.display = 'block';
				document.getElementById('logoutBtn').style.display = 'none';

			}
		}
		
	</script>
	
	</head>
<body onload="checkLogin()">
	<div id="wrap">
		<div class="row">
			<div class="flex3" ><h1 id="title">Digitales Tagebuch</h1></div>
			
				<div id="effect" >
					
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
					
						
					<button onclick="showRegistration()">Registrieren</button>
					<!--<button onclick="runEffect()">Verstecken</button>-->
				</div>
				
					<button id="effectBtn" onclick="runEffect()" display="none">Login</button>
				
					<button id="logoutBtn" onclick="logout()" display="none">Abmelden</button>
				
			
				
			
		
		</div>
		
		<div>
		<h2>Willkommen</h2>
			<p>
				Lorem ipsum dolor sit amet, ea delenit utroque quo, audiam denique pri eu. Pro homero alterum no, qui amet assentior an, duo solum tation decore ea. Possim dolorum comprehensam no sea. Cum vitae iriure ut, consul referrentur in nec.
				Cu quidam impedit nec, tritani corrumpit scriptorem ne pro, quot augue regione no sit. Nullam aliquid graecis ne per. Eam placerat conclusionemque id. Vix id brute dictas forensibus. Sonet delenit duo ex, vocent complectitur sed ad. An odio saperet vel.
				Quis sonet argumentum an nam. Quem assentior intellegebat per id, nec no tota ubique ancillae. Cu tempor ridens copiosae mea. Mel detracto maiestatis no, falli error an vim. Ut pri ignota epicuri interpretaris, assum maiorum aliquando no nam. Ut movet dolorum minimum has.
				Pro in fugit offendit voluptatibus. Utamur persius indoctum te nam. Pri porro assentior temporibus ut, cetero aperiam partiendo et eam. Ut vim idque fuisset.
				Copiosae sadipscing vel at, vel dissentiunt accommodare at, vim elit modus animal et. Sed mucius electram ei, et sed diam offendit. Mei odio reprimique necessitatibus eu, vix et utamur ancillae facilisis, cu dolores dissentias vel. Fastidii theophrastus an quo, splendide rationibus no per. Vim dicat molestiae assentior ei, cum et laudem postulant. Per ad natum doctus deseruisse.
			</p>
		</div>
		<div>
			<h2>Auf Wiedersehen</h2>
			<p>
				Lorem ipsum dolor sit amet, ea delenit utroque quo, audiam denique pri eu. Pro homero alterum no, qui amet assentior an, duo solum tation decore ea. Possim dolorum comprehensam no sea. Cum vitae iriure ut, consul referrentur in nec.
				Cu quidam impedit nec, tritani corrumpit scriptorem ne pro, quot augue regione no sit. Nullam aliquid graecis ne per. Eam placerat conclusionemque id. Vix id brute dictas forensibus. Sonet delenit duo ex, vocent complectitur sed ad. An odio saperet vel.
				Quis sonet argumentum an nam. Quem assentior intellegebat per id, nec no tota ubique ancillae. Cu tempor ridens copiosae mea. Mel detracto maiestatis no, falli error an vim. Ut pri ignota epicuri interpretaris, assum maiorum aliquando no nam. Ut movet dolorum minimum has.
				Pro in fugit offendit voluptatibus. Utamur persius indoctum te nam. Pri porro assentior temporibus ut, cetero aperiam partiendo et eam. Ut vim idque fuisset.
				Copiosae sadipscing vel at, vel dissentiunt accommodare at, vim elit modus animal et. Sed mucius electram ei, et sed diam offendit. Mei odio reprimique necessitatibus eu, vix et utamur ancillae facilisis, cu dolores dissentias vel. Fastidii theophrastus an quo, splendide rationibus no per. Vim dicat molestiae assentior ei, cum et laudem postulant. Per ad natum doctus deseruisse.
			</p>
		</div>
	</div>
</body>
</html>
