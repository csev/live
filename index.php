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
<html>
	<head>
		<link rel="stylesheet" href="compiled/flipclock.css">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

		<script src="compiled/flipclock.js"></script>
	</head>

	<body style="font-family: sans-serif;">
	<h1>Dr. Chuck's Live Office Hours</h1>
	<p>Next Scheduled Office Hours: <?= $live ?> (Eastern Time USA)</p>
	<p>This page is for live office hours using Google Hangouts 
	in Dr. Chuck's 
<a href="https://www.coursera.org/course/pythonlearn" target="_blank">
Programming for Everybody (Python)</a>
and 
<a href="https://www.coursera.org/learn/insidetheinternet" target="_blank">
Internet History, Technology, and Security</a> courses on Coursera.
</p>
	<p>This page will refresh and automatically send you to 
	the the live office hours URL when the office hours are about 
	to start.</p>
	<div class="clock" style="align: center; margin:2em;"></div>
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
<a href="http://flipclockjs.com/" target="_blank">Uses FlipClock.js</a>
-->

<p>While you wait, you can watch some of my recorded
<a href="https://www.youtube.com/watch?v=wXrDopq8pVw&index=1&list=PLlRFEj9H3Oj4qyq0OLZ76cMtUUgqUNtmz"
target="_blank">face-to-face office hours</a>.
<center>
<a href="https://www.coursera.org/course/pythonlearn" target="_blank">
<img src="https://coursera.s3.amazonaws.com/topics/insidetheinternet/large-icon.png" width="240" style="padding:2px;">
</a>
<a href="https://www.coursera.org/learn/insidetheinternet" target="_blank">
<img src="https://d15cw65ipctsrr.cloudfront.net/29/753da0352c11e494bcf927fb09cbc9/MOOCMap-highres.png" width="240" style="padding:2px;"><br/>
</a>
</center>
	
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
