<?php

function secToHMS($nSeconds) {
	$nHours = 0;
	$nMinutes = 0;
	if ( floor($nSeconds / 3600) > 0) {
		$nHours =  floor($nSeconds / 3600);
		$nSeconds = $nSeconds - $nHours * 3600;
	}
	if ( floor($nSeconds / 60) > 0) {
		$nMinutes =  floor( $nSeconds / 60);
		$nSeconds = $nSeconds - $nMinutes * 60;
	}
	$strTimeFormat =  "%02d:%02d:%02d";
	$strTimeData = sprintf($strTimeFormat, $nHours, $nMinutes, $nSeconds  );	
	return $strTimeData;
}


function progressBar($nCurrent, $nTotal, $nInitialTime = NULL , $nBarLength = 50, $strChar = '#' ) {
	$nDigits = strlen((string) $nTotal) + 1;
	$strFormat = "% {$nDigits}d/%d [";
	$strTotals = sprintf($strFormat, $nCurrent,$nTotal );
	
	$fPercent = $nCurrent * 1.0 / $nTotal;
	$nShow = floor($nBarLength - $nBarLength * $fPercent);
	$strBar = str_repeat($strChar, $nBarLength - $nShow)   . str_repeat(' ', $nShow);

	$strPercent = sprintf("] %3d%% " ,$fPercent * 100);

	if ($nInitialTime != NULL) {
		$nDiff = time() - $nInitialTime;
		$nPerLoop = $nDiff / ($nCurrent + 1.0) ;
		$nRemaining =  ceil($nPerLoop * ($nTotal - $nCurrent));
		$strTimeData = " ELAPSED: " . secToHMS($nDiff) ;
		$strETA = " ETA: " . secToHMS($nRemaining) ;
		
		$strTime  = $strTimeData . $strETA;
	} else {
		$strTime = '';
	}

	$strMemory = "    Memory: " .  bcdiv( memory_get_peak_usage(), 1048576, 3) . " MB";
	$strAll = $strTotals . $strBar . $strPercent . $strTime . $strMemory;

	$nCharCount = strlen($strAll);

	print  str_repeat("\010", $nCharCount);
	print $strAll;
	if ($nCurrent == $nTotal) {
		print "\n";
	}
}


function progressElapsed($nCurrent, $nInitialTime = NULL)  {
	$strNumber = sprintf("% 10s", $nCurrent);
	if ($nInitialTime != NULL) {
		$nDiff = time() - $nInitialTime;
		$strTimeData = "      ELAPSED: " . secToHMS($nDiff)  . "   ";
		$strTime = $strTimeData;
	} else {
		$strTime = '';
	}
	$strAll = $strNumber . $strTime  ;
	print str_repeat("\010", strlen($strAll));
	print $strAll;
}




