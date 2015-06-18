<?php
// data richiesta deepzoom, estrae la tile rispettiva

require "../create_deepzoom_tile.php";

$level = 10;
$x = 0;
$y = 2;

$tileDim = 256;

$slidePath = "test.svs";

$tileDir = "slide_files";
if (!file_exists($tileDir)) {
    mkdir($tileDir);
}
$tileDir = $tileDir . "/" . $level;
if (!file_exists($tileDir)) {
    mkdir($tileDir);
}

$tileFilename = $x . "_" . $y . ".jpg";
$tilePath = $tileDir . "/" . $tileFilename;

echo "TILE PATH: $tilePath\n";

if (!file_exists($tilePath)) {
	createDeepZoomTile($level, $x, $y, $tileDim, $slidePath, $tilePath);
}
