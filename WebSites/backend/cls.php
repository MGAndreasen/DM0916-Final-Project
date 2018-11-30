<?php
// Include our configuration
$config = include('../config.php');

// Init session
session_start();

// create output array
$data = array();

// Load Include files.
include('../classes/dbLayer/connectionDB.php');

// Connect to Mysql (MariaDB)
$dbCtrl = new connectionDB();
$conn = $dbCtrl->getConnection();


// kode her under

include('../classes/dbLayer/modelCtrl.php');
$modelCtrl = new ModelCtrl();


// output data array as Json
echo json_encode($data, JSON_PRETTY_PRINT);
?>