<?php

	$file = '../logs/errors.txt';
	mysqli_report(MYSQLI_REPORT_STRICT);

	$dbhost='localhost';
	$dbuser='root';
	$dbpass='123';
	$db='quiz';

	try
	{
    	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
	}
	catch (Exception $exp)
	{
	    echo "Service unavailable Please try later";
	    $exp -> getMessage();
	    $log = "\n \n \n********************************************";
	    $log .= "-> conn.php connection part \n" . $exp -> getMessage();
	    $current = file_get_contents($file);
			$current .= $log;
			file_put_contents($file, $current);
	    exit;
	}
?>
