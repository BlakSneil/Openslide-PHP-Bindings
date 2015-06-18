<?php

require "../create_deepzoom_tile.php";

$level = 16;
$tileSize = 256;

$slidePath = "test.svs";

$tileDir = "tiles";
if (!file_exists($tileDir)) {
    mkdir($tileDir);
}
$tileDir = "tiles/test";
if (!file_exists($tileDir)) {
    mkdir($tileDir);
}
$tileDir = $tileDir . "/" . $level;
if (!file_exists($tileDir)) {
    mkdir($tileDir);
}

date_default_timezone_set('Europe/Rome');
$start = new DateTime();

$i = 0;

for ($x = 100; $x < 120; $x++) {
	for ($y = 100; $y < 120; $y++) {

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

$end = new DateTime();

echo "The process for $i slides lasts " . $end->diff($start)->format("%s") . " seconds\n";