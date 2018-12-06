<?php
// Include our configuration
$config = include('../config.php');

// Init session
session_start();

// create empty output array
$data = array();

// allowed Ctrls
$ctrls = array('customer', 'model', 'project', 'user');

if(!in_array($_GET['ctrl'], $ctrls))
{
	echo "Ctrl findes ikke!";
}



// Load Include files.
include('../classes/dbLayer/connectionDB.php');

// Connect to Mysql (MariaDB)
$dbCtrl = new connectionDB();
$conn = $dbCtrl->getConnection();

// output data array as Json
echo json_encode($data, JSON_PRETTY_PRINT);
?>