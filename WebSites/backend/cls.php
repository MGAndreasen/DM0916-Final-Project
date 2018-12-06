<?php
// Include our configuration
$config = include('../config.php');

// Init session
session_start();

// create output array
$data = array();

// Load Include files.
include('../classes/util/connectionDB.php');

// Connect to Mysql (MariaDB)
$dbCtrl = new connectionDB();
$conn = $dbCtrl->getConnection();

// kode her under

include('../classes/ctrlLayer/modelCtrl.php');
$modelCtrl = new ModelCtrl();
$modelCtrl->getModel(1);

$modelCtrl->getModels();

//include('../classes/dbLayer/modelDB.php');
//$modelDB = new ModelDB();
//array_push($data, $modelDB->getModel(1));

// output data array as Json
echo json_encode($data, JSON_PRETTY_PRINT);
?>