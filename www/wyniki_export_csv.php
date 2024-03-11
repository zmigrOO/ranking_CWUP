<?php
// FILEPATH: /X:/xampp/htdocs/wyniki_raw.php
// Connect to the database
$con = mysqli_connect("mysql", "wyniki", "wyniki", "ranking");
$sql = "SELECT *, (`Wynik1`+`Wynik2`+`Wynik3`+`Wynik4`+`Wynik5`) as suma FROM `wyniki` ORDER BY (`Wynik1`+`Wynik2`+`Wynik3`+`Wynik4`+`Wynik5`) DESC";

$result = mysqli_query($con, $sql);
foreach ($result as $row) {
	$rows[] = $row;
}

function array2csv(array &$array)
{
	if (!is_array($array)) {
		return null;
	}
	ob_start();
	$df = fopen("php://output", 'w');
	fputcsv($df, array_keys(reset($array)));
	if (is_array($array)) {
		foreach ($array as $row) {
			fputcsv($df, $row);
		}
	}
	fclose($df);
	return ob_get_clean();
}
function download_send_headers($filename)
{
	// disable caching
	$now = gmdate("D, d M Y H:i:s");
	header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
	header("Last-Modified: {$now} GMT");

	// force download  
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");

	// disposition / encoding on response body
	header("Content-Disposition: attachment;filename={$filename}");
	header("Content-Transfer-Encoding: binary");
}
download_send_headers("wyniki_" . date("Y-m-d") . ".csv");

echo array2csv($rows);
die();


// Return the data as HTML