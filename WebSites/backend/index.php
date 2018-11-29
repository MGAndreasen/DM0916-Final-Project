<?php
// Include our configuration
$config = include('../config.php');
include('../classes/dbLayer/connectionDB.php');

echo $config['DBName'];

$db = new connectionDB();

$conn = $db->getConnection();
?>