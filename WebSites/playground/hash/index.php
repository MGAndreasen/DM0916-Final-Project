<?php 
$hashtype = "whirlpool";
$testdata = "hello";
$userid = "1";
$username = "tester@test.org";

echo "<h2>Test:</h2>";
$r = hash($hashtype, $userid, false);
printf("<p>Uids: %s</p>\n", $r);

$r = hash($hashtype, $username, false);
printf("<p>Name: %s</p>\n", $r);

$r = hash($hashtype, $r.$userid, false);
printf("<p>Both: %s</p>\n", $r);


echo "<h2>Alle Algos:</h2>";
foreach (hash_algos() as $v) { 
        $r = hash($v, $testdata, false); 
        printf("<p>%-12s %3d %s</p>\n", $v, strlen($r), $r); 
} 
?> 