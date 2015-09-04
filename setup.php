<?php
date_default_timezone_set('America/Detroit');

$live = "2015-08-07 00:30:00";
$live = "2015-08-14 12:06:00";
$live = "2015-09-08 12:30:00";
$url = "http://www.dr-chuck.com";
$previous = "https://plus.google.com/u/1/events/clreq3k94t599q36a9pat5c47lg";

$date1 = new DateTime($live);
$now = new DateTime();
$difference_in_seconds = $date1->format('U') - $now->format('U');

