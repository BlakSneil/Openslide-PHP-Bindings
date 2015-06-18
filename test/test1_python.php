<?php

$level = 16;

date_default_timezone_set('Europe/Rome');
$start = new DateTime();

$i = 0;

for ($x = 50; $x < 70; $x++) {
	for ($y = 50; $y < 70; $y++) {

		echo "$i: requesting region for level $level with coordinates $x : $y\n";

		$qry_str = "/16/" . $x . "_" . $y . ".jpeg";
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/slide_files' . $qry_str); 

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, '3');
		$content = trim(curl_exec($ch));
		curl_close($ch);
//		print $content . "\n";

		$i += 1;
	}
}

$end = new DateTime();

echo "The process for $i slides lasts " . $end->diff($start)->format("%s") . " seconds\n";