<?php
header('Content-Type: text/json; charset=utf-8');
ini_set("default_charset", "UTF-8");
mb_internal_encoding("UTF-8");
//iconv_set_encoding("internal_encoding", "UTF-8");
//iconv_set_encoding("output_encoding", "UTF-8");

// Include our configuration
$config = include('../config.php');

// Init session
session_start();

// create empty output array
$data = array();
$error = array();
@$ctrl = $_GET['ctrl'];
@$func = $_GET['func'];

if(!empty($_GET['ctrl']) && mb_stripos($_GET['ctrl'], "..") === false && !empty($_GET['func']))
{
	$ctrl = basename(strtolower($_GET['ctrl']), ".php");
	$func = basename(strtolower($_GET['func']));

	$path = '../classes/ctrlLayer/'.$ctrl.'Ctrl.php';

	if (realpath($path))
	{
		// Load Include files.
		require_once('../classes/util/connectionDB.php');

		// Connect to Mysql (MariaDB)
		$dbCtrl = new connectionDB();
		$conn = $dbCtrl->getConnection();

		// Load Include files.
		require_once($path);

		$theClass = mb_strtoupper($ctrl);
		$theCtrl = new $theClass;
		//$theCtrl->$func();
	}
	else
	{
	array_push($error, errorMsg($ctrl, $func, 'Controller fil findes ikke.'));
	}
}
else
{
	array_push($error, errorMsg($ctrl, $func, 'Ikke valid eller manglende Ctrl eller Func parameter!'));
}

// output data array as Json

array_push($data, $error);
echo json_encode($data, JSON_PRETTY_PRINT);


function errorMsg(string $ctrl, string $func, $msg)
{
	return array(
			'ERRCTRL' => $ctrl,
			'ERRFUNC' => $func,
			'ERRMSG' => $msg
	);
}
?>