<?php

require_once("loading.php");

$nMax = 30 ;
$nStart = time();
for ($i = 1 ; $i <= $nMax; $i++) {
	progressBar($i, $nMax, $nStart);
	sleep(1);
}
print "\n";



