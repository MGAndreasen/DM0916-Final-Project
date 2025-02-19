<?php
error_reporting(E_ALL);
set_error_handler("error_handler");
set_exception_handler("error_handler");
register_shutdown_function("error_handler");
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
						@call_user_func_array(array($theCtrl, $func), $parms);
					} else { errorMsg('Ajax.php', $func, 'Did not find methode: '.$func.' on class: '. $theClass); }
				} else { errorMsg('Ajax.php', $func, 'Did not find class: '.$theClass); }
			} else { errorMsg($ctrl, $func, 'Controller fil findes ikke.'); }
		} else { errorMsg($ctrl, $func, 'Ikke valid eller manglende Ctrl eller Func parameter!'); }
	} else { errorMsg(null, null, 'Json ikke korrekt posted.'); }
} else { errorMsg(null, null, 'Request var ikke en HTTP POST.'); }
if(empty($data['errors'])) { $data['status'] = "OK"; } // Hvis ingen fejl, send OK status med tilbage
echo json_encode($data, JSON_PRETTY_PRINT); // output data array as Json

/* FUNC */
function errorMsg($ctrl, $func , $msg) {
	global $data;
	if(!isset($data['errors'])) { $data['errors'] = array(); }
	array_push($data['errors'], array( 'ERRCTRL' => $ctrl, 'ERRFUNC' => $func, 'ERRMSG' => $msg	));
}

function error_handler() {
	global $data;
    $e = error_get_last();
    if($e === null) { $e = func_get_args(); }
    if(empty($e)) { return; }
    if($e[0] instanceof Exception) {
        call_user_func_array(__FUNCTION__, array($e[0]->getCode(),$e[0]->getMessage(),$e[0]->getFile(),$e[0]->getLine(),$e[0]));
        return;
    }
    $e = array_combine(array('number', 'message', 'file', 'line', 'context'), array_pad($e, 5, null));
	errorMsg('Ajax.php','error_handler',$e);
    echo json_encode($data, JSON_PRETTY_PRINT); // output data array as Json
    exit;
}
?>