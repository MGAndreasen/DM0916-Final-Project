<?php
function createRandomString($length=128, $from="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz")
{
	$theString = "";

	if($length > 0 && strlen($from) > 0)
	{
		mt_srand((double)microtime()*1000000);

		while(strlen($theString)<$length)
		{
           $theString .= $from[mt_rand(0, strlen($from)-1)];
       }
   }
   return $theString;
}

	/* Test div algos
				foreach (hash_algos() as $v)
				{ 
					$r = hash($v, $testdata, false); 
			        printf("<p>%-12s %3d %s</p>\n", $v, strlen($r), $r); 
				}
				*/
?>