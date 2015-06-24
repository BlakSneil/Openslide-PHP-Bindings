<?php

require "../create_deepzoom_tile.php";

$level = 15;
$tileSize = 256;

$slideName = "slide1";

$slideExtension = "svs";

$slidePath = "slides/$slideName.$slideExtension";


$tileDir = "tiles";
if (!file_exists($tileDir)) {
    mkdir($tileDir);
}
$tileDir = "tiles/$slideName";
if (!file_exists($tileDir)) {
    mkdir($tileDir);
}
$tileDir = $tileDir . "/" . $level;
if (!file_exists($tileDir)) {
    mkdir($tileDir);
}


$time_start = microtime(true);

$i = 0;

for ($x = 0; $x < 20; $x++) {
	for ($y = 0; $y < 20; $y++) {

		$tileFilename = $x . "_" . $y . ".jpg";
		$tilePath = $tileDir . "/" . $tileFilename;

		if (file_exists($tilePath)) {
			echo "$i: reading file for level $level with coordinates $x : $y\n";
		} else {
			echo "$i: generating file for level $level with coordinates $x : $y\n";
			createDeepZoomTile($level, $x, $y, $tileSize, $slidePath, $tilePath);
		}

		$i += 1;
	}
}

$time_end = microtime(true);

echo "The process for $i slides lasts " . round(($time_end - $time_start) * 1000) . " milliseconds\n";