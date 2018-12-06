<?php
//header('Content-Type: text/html; charset=utf-8');
//ini_set("default_charset", "UTF-8");
//mb_internal_encoding("UTF-8");
//iconv_set_encoding("internal_encoding", "UTF-8");
//iconv_set_encoding("output_encoding", "UTF-8");

// Include our configuration
$config = include('../config.php');

// Init session
session_start();

// create empty output array
$data = array();
$error = array();

$ctrl = basename(strtolower($_GET['ctrl']), ".php").PHP_EOL;
$func = basename(strtolower($_GET['func']));

if (realpath($path))
{
	// Load Include files.
	require_once('../classes/util/connectionDB.php');

	// Load Include files.
	require_once($path);

	// Connect to Mysql (MariaDB)
	$dbCtrl = new connectionDB();
	$conn = $dbCtrl->getConnection();
}
else
{
	array_push($error, errorMsg($ctrl, '0', 'findes ikke.'));
}

// output data array as Json

array_push($data, $error);
echo json_encode($data, JSON_PRETTY_PRINT);


function errorMsg(string $error, string $errorno, $errormsg)
{
	return array(
			'ERROR' => $error,
			'ERRNO' => $errorno,
			'ERRMSG' => $errormsg
	);
}
?>