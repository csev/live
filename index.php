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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-423997-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-423997-1');
</script>

		<link rel="stylesheet" href="compiled/flipclock.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

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
<div style="margin-left: 10px; float:right">
<iframe width="400" height="225" src="https://www.youtube.com/embed/UjeNA_JtXME?rel=0" frameborder="0" allowfullscreen></iframe>
</div>
	<h1><?= htmlentities($title) ?></h1>
	<p>Next Scheduled Event: <?= $live ?> (Eastern Time USA)</p>
<p>
<?= $description ?>
</p>
	<p>This page will refresh and automatically send you to 
	the the event URL when the event is about 
	to start.</p>
	<div class="clock"></div>
	<div class="message"></div>
<p>While you wait, you can watch some of my recorded
face to face office hours at
<a href="https://www.dr-chuck.com/office"
target="_blank">face-to-face office hours</a><?php
if ( isset($previous) && $previous ) {
echo(' or view the <a href="'.$previous.'" target="_blank">');
echo('the previous live office hours</a>');
}
?>. 
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
	
<!--
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'drchucklive';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
-->
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
