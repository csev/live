<?php
date_default_timezone_set('America/Detroit');

$live = "2015-08-07 00:30:00";
$live = "2015-08-07 10:00:00";
$url = "http://www.dr-chuck.com";

$date1 = new DateTime($live);
$now = new DateTime();
$difference_in_seconds = $date1->format('U') - $now->format('U');

