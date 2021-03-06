<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Digitales Tagebuch</title>
	<link rel="stylesheet" href="css/CSS.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript">

		function checkBesucherCookie(){
			var a = new Date();
			a = new Date(a.getTime() +1000*60*60*24*365)
			if(checkCookie("cookieBesucht") == ""){
				$( "#cookie" ).click(function() {
 					if ( $( "div:first" ).is( ":hidden" ) ) {
  						$( "#cookie" ).show( "slow" );
  					} else {
    					$( "#cookie" ).slideUp();
    					document.cookie = 'cookieBesucht=1; expires='+a.toGMTString()+';';
  					}
				});	
			}else{
				$("#cookie").hide();
				document.cookie = 'cookieBesucht=1; expires='+a.toGMTString()+';';
				 
			}	
		}
	
	
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
	     // var selectedEffect = '';
	 
	      // Most effect types need no options passed by default
	      //var options = {};
	      // some effects have required parameters
	     /* if ( selectedEffect === "scale" ) {
	        options = { percent: 50 };
	      } else if ( selectedEffect === "size" ) {
	        options = { to: { width: 200, height: 60 } };
	      }
	 */
	      // Run the effect
	      $( "#effect" ).toggle( 'fast' );
		  $("#effectBtn").toggle();
		  showLogin();
	    };
	 
	    // Set effect from select menu value
	    /*$( "button" ).on( "click", function() {
	      runEffect();
	    });*/
		//});


		

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
					loadContent('entries');
					document.title = checkCookie('fname') + ' ' + checkCookie('lname');
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
					loadContent('entries');
					document.title = checkCookie('fname') + ' ' + checkCookie('lname');
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
					loadContent('goodbye');
					document.title = 'Digitales Tagebuch';
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
				document.title = checkCookie('fname') + ' ' + checkCookie('lname');
				document.getElementById('effect').style.display = 'none';
				document.getElementById('effectBtn').style.display = 'none';
				document.getElementById('logoutBtn').style.display = 'block';
				loadContent('entries');


			}else{
				document.title = 'Digitales Tagebuch';
				document.getElementById('effectBtn').style.display = 'block';
				document.getElementById('logoutBtn').style.display = 'none';
				if(checkCookie('logout') == 'yes'){
					loadContent('goodbye');
				}else{
					loadContent('welcome');
				}

			}
			checkBesucherCookie();
		}

		function loadContent (typeOfContent) {
			var file = typeOfContent + '.php';
			//console.log(file);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200){
					document.getElementById('content').innerHTML = this.responseText;
				}
			};
			xhttp.open('GET', file, true);
			xhttp.send();
		}
		function saveEntry () {
			var entryContent = document.getElementById('entryContent').value;
			//console.log(entryContent);
			var entryUser = checkCookie('uname');
			//console.log(entryUser);
			var xhttp = new XMLHttpRequest();
			if(document.getElementById('entryVisible').checked){
				var entryVisible = 1;
			}else{
				var entryVisible = 0;
			}
			if(document.getElementById('entryPublic').checked){
				var entryPublic = 1;
			}else{
				var entryPublic = 0;
			}
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200){
					loadContent('entries');
				}
				
			};
			xhttp.open('POST', 'entries.php', true);
			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhttp.send('uname='+ entryUser + '&content='+ entryContent + '&entryVisible=' + entryVisible + '&entryPublic=' + entryPublic);
			
		}
		function selUserEntries(str){
			//alert(str);
			var query = 'entries.php?seluname=' + str;
			//alert(query);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200){
					document.getElementById('content').innerHTML = this.responseText;
				}	
			};
			xhttp.open('GET', query, true);
			xhttp.send();

			return false;
		}
		function newEntryShow () {
			$('#newEntryDiv').toggle();
			$('#newEntryBtn').hide();
		}
		function editEntry (entry_ID) {
			var query = 'editEntry.php?entry_ID=' + entry_ID;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200){
					document.getElementById(entry_ID).innerHTML = this.responseText;
					document.getElementById(entry_ID).removeAttribute('onclick');
					document.getElementById(entry_ID).class = 'entryEditor'; 
					var ents = document.getElementsByClassName('entryComplete');
					for (var i = ents.length - 1; i >= 0; i--) {
						ents[i].removeAttribute('onclick');
					}
				}
			};
			xhttp.open('GET', query, true);
			xhttp.send();
		}
		function changeEntry (entry_ID) {
			//alert(entry_ID);
			var content = document.getElementById('changeContent').value;
			//alert(content);
			var user = checkCookie('uname');
			if(document.getElementById('changeVisible').checked){
				var entryVisible = 1;
			}else{
				var entryVisible = 0;
			}
			if(document.getElementById('changePublic').checked){
				var entryPublic = 1;
			}else{
				var entryPublic = 0;
			}
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if(this.readyState == 4 && this.status == 200){
					loadContent('entries');
				}
			};
			xhttp.open('POST', 'editEntry.php', true);
			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhttp.send('uname='+ user + '&content='+ content + '&entryVisible=' + entryVisible + '&entryPublic=' + entryPublic + '&entry_ID=' + entry_ID);
		}
	</script>
	
	</head>
<body onload="checkLogin()">
	<div id="cookie">Diese Website verwendet Cookies. Mit der Nutzung dieser Seite stimmst du unserer Verwendung von Cookies zu.</div>
	<div id="wrap">
		<div class="row">
			<div class="flex3" ><h1 id="title">Digitales Tagebuch</h1></div>
			
				<div id="effect" >
					
				
				</div>
				
					<button id="effectBtn" onclick="runEffect()" display="none">Login</button>
				
					<button id="logoutBtn" onclick="logout()" display="none">Abmelden</button>
				
			
				
			
		
		</div>
		
		<div id="content">
			
		</div>
		
	</div>
</body>
</html>
