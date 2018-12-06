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

include('../classes/ctrlLayer/modelCtrl.php');
$modelCtrl = new ModelCtrl();
$modelCtrl->getModel(1);

$modelCtrl->getModels();

echo '<br> Testing projectCtrl <br>';
include('../classes/ctrlLayer/projectCtrl.php');
$projectCtrl = new ProjectCtrl();
echo '<br> projectCtrl->getProject(1) <br>';
$projectCtrl->getProject(1);
echo '<br> projectCtrl->getProjects <br>';
$projectCtrl->getProjects();

//include('../classes/dbLayer/modelDB.php');
//$modelDB = new ModelDB();
//array_push($data, $modelDB->getModel(1));

// output data array as Json
echo json_encode($data, JSON_PRETTY_PRINT);
?>