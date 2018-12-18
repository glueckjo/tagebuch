<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="css/CSS.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript">
	
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
	  $("button").toggle();
    };
 
    // Set effect from select menu value
    /*$( "button" ).on( "click", function() {
      runEffect();
    });*/
	//});
	</script>
	
	</head>
<body>
	<div id="wrap">
		<div class="row">
			<div class="flex3"><h1>Digitales Tagebuch</h1></div>
			<div id="effect" >
				<form action="#" method="POST" >
					<table>
						<tr>
						<td><label for="uname">Username:</label></td>
						<td><input type="text" for="uname"/></td>
						</tr>
						<tr>
						<td><label for="passwd">Password:</label></td>
						<td><input type="password" for="passwd"/></td>
						</tr>
						<tr>
						<td></td>
							<td><input type="button" value="Anmelden" /></td>
						</tr>
					</table>
				</form>
			</div>
			<button onclick="runEffect()">Login</button>
				
		
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
