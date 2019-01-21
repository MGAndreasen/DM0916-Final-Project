<?php
header('Content-Type: text/json; charset=utf-8');	// Set HTTP header
ini_set("default_charset", "UTF-8");				// Sets default_charset
mb_internal_encoding("UTF-8");						// Set php multibyte encoding charaterset UTF8
$config = include('../config.php');					// Returns config array from our configfile
require_once('../classes/util/utils.php');			// Includes utility functions
require_once('../classes/util/connectionDB.php');	// Includes dbHandler 
session_start();									// Init session
$data = array();									// create empty output array
$response = array();								// Holds response
if ($_SERVER['REQUEST_METHOD'] === 'POST') {		// Check HTTP REQUEST_METHOD
	if (isset($_REQUEST['resp'])) {					// And if we got a resp field
		@$response = json_decode(utf8_encode($_REQUEST['resp']), true)[0];
		@$ctrl = $response['ctrl'];
		@$func = $response['func'];
		@$parms = $response['parms'];
		if(!empty($ctrl) && mb_stripos($ctrl, "..") === false && !empty($func)) {
			$ctrl = basename(strtolower($ctrl), ".php");
			$func = basename(strtolower($func));
			$path = '../classes/ctrlLayer/'.$ctrl.'Ctrl.php';
			if (realpath($path)) {
				$dbCtrl = new connectionDB();		// Connect to Mysql (MariaDB)
				$conn = $dbCtrl->getConnection();
				require_once($path); // Load Ctrl files.
				// Lav instans af klassen og afvikel funktionen med parameterne
				$theClass = ucfirst($ctrl)."Ctrl";
				if (class_exists($theClass)) {
					$theCtrl = $theClass::getInstance();
					foreach (get_class_methods($theCtrl) as $method) {
					    if (strtolower($method) != strtolower($func)) { continue; }
						else { $func = $method; }
					}
					if(method_exists($theClass, $func)) {
						try{ call_user_func_array(array($theCtrl, $func), $parms); }
						catch(e){ errorMsg('Ajax.php','call_user_func_array','Ctrl: '.$theClass.'</br>Func: '.$func.'Error: '.$e); }
					} else { errorMsg('Ajax.php', $func, 'Did not find methode: '.$func.' on class: '. $theClass); }
				} else { errorMsg('Ajax.php', $func, 'Did not find class: '.$theClass); }
			} else { errorMsg($ctrl, $func, 'Controller fil findes ikke.'); }
		} else { errorMsg($ctrl, $func, 'Ikke valid eller manglende Ctrl eller Func parameter!'); }
	} else { errorMsg(null, null, 'Json ikke korrekt posted.'); }
} else { errorMsg(null, null, 'Request var ikke en HTTP POST.'); }
if(empty($data['errors'])) { $data['status'] = "OK"; } // Hvis ingen fejl, send OK status med tilbage
echo json_encode($data, JSON_PRETTY_PRINT); // output data array as Json
?>