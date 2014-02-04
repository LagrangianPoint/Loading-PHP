<?php

require_once("loading.php");

$nMax = 30 ;
$nStart = time();
for ($i = 1 ; $i <= $nMax; $i++) {
	progressElapsed($i, $nStart);
	sleep(1);
}
print "\n";


