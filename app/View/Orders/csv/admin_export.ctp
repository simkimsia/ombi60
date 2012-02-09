<?php
	header("Content-type: text/csv");
	header("Cache-Control: no-store, no-cache");
	header('Content-Disposition: attachment; filename="filename.csv"');
	$fp = fopen('php://output','w+');
	// Loop through the data array
	foreach ($data as $row)
	{
		fputcsv($fp, $row['Order']);
	}
	ob_flush();
	fclose($fp);
?>