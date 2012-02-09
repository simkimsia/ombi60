<?php
header("Content-type: text/csv");
header("Cache-Control: no-store, no-cache");
header('Content-Disposition: attachment; filename="filename.csv"');

$outstream = fopen("php://output",'w');

$test_data = array(
	array( 'Cell 1,A', 'Cell 1,B' ),
	array( 'Cell 2,A', 'Cell 2,B' )
);

foreach( $test_data as $row )
{
	fputcsv($outstream, $row, ',', '"');
}

fclose($outstream);
?>