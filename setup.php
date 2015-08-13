<?php
date_default_timezone_set('America/Detroit');

$live = "2015-08-07 00:30:00";
$live = "2015-08-07 09:55:00";
$url = "http://www.dr-chuck.com";
$url = "https://plus.google.com/events/c7bd91gf20sg5kao88j3obuo0js";

$date1 = new DateTime($live);
$now = new DateTime();
$difference_in_seconds = $date1->format('U') - $now->format('U');

