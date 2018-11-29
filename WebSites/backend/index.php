<?php
// Include our configuration
$config = include('../config.php');

// Load Include files.
include('../classes/dbLayer/connectionDB.php');

// Connect to Mysql (MariaDB)
$dbCtrl = new connectionDB();
$conn = $dbCtrl->getConnection();

if($conn === NULL)
{
	$dbCtrl->getError();
	exit;
}

echo "connected!";
?>