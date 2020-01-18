<?php
date_default_timezone_set('America/Detroit');

$live = "2020-01-18 12:00:00";

// The list URL
$previous = "https://www.youtube.com/playlist?list=PLlRFEj9H3Oj5gYb-xL_MtNtroy39Blt8w";
$url = "https://www.dr-chuck.com/";

$date1 = new DateTime($live);
$now = new DateTime();
$difference_in_seconds = $date1->format('U') - $now->format('U');

$title = "YADA TITLE";
$description = <<< EOF
YADA paragraph.
EOF
;
