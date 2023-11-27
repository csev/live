<?php
require_once "setup.php";

$date1 = new DateTime($live);
$now = new DateTime();
$difference_in_seconds = $date1->format('U') - $now->format('U');

// Add a skew based on IP address so they don't flood my server
$skew = 0;
if ( isset($_SERVER['REMOTE_ADDR']) ) {
	$addr = $_SERVER['REMOTE_ADDR'];
	$sha = sha1($addr,true);
	$skew = ord($sha[0]) % 20;
}

$difference_in_seconds = $difference_in_seconds + $skew;

if ( $difference_in_seconds < 1 ) {
        header("Location: ".$url);
        return;
}

$refresh = ($difference_in_seconds * 1000) / 2;
if ( $refresh > 5*60*1000 ) $refresh = 5*60*1000;
if ( $refresh < 10*1000 ) $refresh = 10*1000;

// Add up to 10 seconds so they don't hit my server all at the same time
$refresh = $refresh + rand(0,10*1000);

?>
<!DOCTYPE html>
<html>
<head>
<title>Dr. Chuck Live</title>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QW9Z3MX240"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QW9Z3MX240');
</script>

		<link rel="stylesheet" href="compiled/flipclock.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

          <script src="compiled/flipclock.js"></script>
</head>
<style>
body {
  background: url(bgbg.jpg) no-repeat center center fixed; 
  background-color: gray;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  margin: 0;
  padding: 0;
  font: 16px;
  line-height: 1.5;
  color: white;
  font-family: lato, Monaco, "Bitstream Vera Sans Mono", "Lucida Console", Terminal, monospace;
}

.container {
  margin-top: 10vh;
  margin-left: 10vh;
  margin-right: 10vh;
}

a {
    color:white;
}

.clock {
  width: 80% ;
  margin-left: auto ;
  margin-right: auto ;
}


.flip-clock-label {
display:none;
}
</style>
	</head>
	<body style="font-family: sans-serif;">
<div class="container">
<?php if ( $leftvideo ) { ?>
<div style="margin-left: 10px; float:right">
<iframe width="400" height="225" src="<?= $leftvideo ?>" frameborder="0" allowfullscreen></iframe>
</div>
<?php } ?>
	<h1><?= htmlentities($title) ?></h1>
	<p>Next Scheduled Event: <?= $live ?> (Eastern Time USA)</p>
<p>
<?= $description ?>
</p>
	<p>This page will refresh and automatically send you to 
	the event URL when the event is about 
	to start.</p>
	<div class="clock"></div>
	<div class="message"></div>
	<script type="text/javascript">

		function refresh() {
			window.location.reload();
		}

		window.console && console.log("Refresh <?= $refresh ?>");
		setTimeout(refresh, <?= $refresh ?>);

		var clock;
		
		$(document).ready(function() {
			var clock;

			clock = $('.clock').FlipClock({
		        clockFace: 'DailyCounter',
		        autoStart: false,
		        callbacks: {
		        	stop: function() {
		        		refresh();
		        	}
		        }
		    });

				    
		    clock.setTime(<?= $difference_in_seconds ?>);
		    clock.setCountdown(true);
		    clock.start();

		});
	</script>
<!--
<a href="https://flipclockjs.com/" target="_blank">Uses FlipClock.js</a>
-->
</div>
	
</body>
</html>
