<?php

$level = 16;

$time_start = microtime(true);

$i = 0;

for ($x = 0; $x < 20; $x++) {
	for ($y = 0; $y < 20; $y++) {

		echo "$i: requesting region for level $level with coordinates $x : $y\n";

		$qry_str = "/16/" . $x . "_" . $y . ".jpeg";
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/slide_files' . $qry_str); 

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, '3');
		$content = trim(curl_exec($ch));
		curl_close($ch);

		$i += 1;
	}
}

$time_end = microtime(true);

echo "The process for $i slides lasts " . round(($time_end - $time_start) * 1000) . " milliseconds\n";