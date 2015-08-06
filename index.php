<html>
	<head>
		<link rel="stylesheet" href="compiled/flipclock.css">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

		<script src="compiled/flipclock.js"></script>
	</head>

	<body style="font-family: sans-serif;">
<?php
date_default_timezone_set('America/Detroit');

$next = "2015-08-07 10:00:00";

$date1 = new DateTime($next);
$now = new DateTime();
$difference_in_seconds = $date1->format('U') - $now->format('U');
?>
	<h1>Dr. Chuck's Live Office Hours</h1>
	<p>Next Scheduled Office Hours: <?= $next ?></p>
	<p>This page will refresh and automatically send you to the the live office hours 
	URL when the office hours are about to start.</p>
	<div class="clock" style="margin:2em;"></div>
	<div class="message"></div>

	<script type="text/javascript">

		function refresh() {
			// alert("bing");
			window.location.reload();
		}

		setTimeout(refresh, 5*60*1000);
			
		
		var clock;
		
		$(document).ready(function() {
			var clock;

			clock = $('.clock').FlipClock({
		        clockFace: 'DailyCounter',
		        autoStart: false,
		        callbacks: {
		        	stop: function() {
		        		$('.message').html('The clock has stopped!')
		        	}
		        }
		    });

				    
		    clock.setTime(<?= $difference_in_seconds ?>);
		    clock.setCountdown(true);
		    clock.start();

		});
	</script>
<!--
<a href="http://flipclockjs.com/" target="_blank">Uses FlipClock.js</a>
-->

<p>While you wait, you can watch some of my recorded
<a href="https://www.youtube.com/watch?v=wXrDopq8pVw&index=1&list=PLlRFEj9H3Oj4qyq0OLZ76cMtUUgqUNtmz"
target="_blank">face-to-face office hours</a>.
	
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-423997-19', 'auto');
  ga('send', 'pageview');

</script>
	</body>
</html>
