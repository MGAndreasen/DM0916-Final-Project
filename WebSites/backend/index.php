<?php
// Include our configuration
$config = include('../config.php');

// Load Include files.
include('../classes/dbLayer/connectionDB.php');

// Connect to Mysql (MariaDB)
$dbCtrl = new connectionDB();
$conn = $dbCtrl->getConnection();

// Page goes here!
echo <<<HTMLout
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Backend SPA</title>
  </head>
<body>
Some ajax calls here.
</body>

</html>
HTMLout;
?>