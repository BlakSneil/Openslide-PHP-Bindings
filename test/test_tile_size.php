<?php

/* This test has the objective to */

require "../create_deepzoom_tile.php";

$level = 0;
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

$osr = openslide_open($slidePath);

$time_start = microtime(true);

$i = 0;

$k = 256 / $tileSize;

for ($x = 0; $x < (20 * $k); $x++) {
	for ($y = 0; $y < (20 * $k); $y++) {

		$regionX = $x * $tileSize;
		$regionY = $y * $tileSize;

		$tileFilename = $regionX . "_" . $regionY . ".jpg";
		$tilePath = $tileDir . "/" . $tileFilename;

		echo "$i: generating file for level $level with coordinates $regionX : $regionY\n";

    	write_jpg($osr, $tilePath, $regionX, $regionY, $level, $tileSize, $tileSize, $tileSize, $tileSize);

		$i += 1;
	}
}

$time_end = microtime(true);

echo "The process for $i slides lasts " . round(($time_end - $time_start) * 1000) . " milliseconds\n";