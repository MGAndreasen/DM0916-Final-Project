<?php
// Include our configuration
$config = include('../config.php');

// Init session
session_start();

// allowed Ctrls
$ctrls = array('customer', 'model', 'project', 'user');

// create empty output array
$data = array();
$error = array();



if (isValidCtrl($_GET['ctrl']))
{
	// Load Include files.
	include('../classes/dbLayer/connectionDB.php');

	// Connect to Mysql (MariaDB)
	$dbCtrl = new connectionDB();
	$conn = $dbCtrl->getConnection();
}

// output data array as Json
echo json_encode($data, JSON_PRETTY_PRINT);


// Functions! skal nok placeres andetsteds!


function isValidCtrl(string $ctrl)
{
	global $ctrls;
	if(!in_array($ctrl, $ctrls))
	{
		$msg = errorMsg($ctrl, '0', 'findes ikke.');
		echo json_encode($msg);
		exit;
	}
}

function errorMsg(string $error, string $errorno, $errormsg)
{
	return array(
			'ERROR' => $error,
			'ERRNO' => $errorno,
			'ERRMSG' => $errormsg
	);
}
?>