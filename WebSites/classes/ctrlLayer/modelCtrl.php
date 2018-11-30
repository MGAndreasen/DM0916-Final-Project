<?php
// Includes
require_once('../classes/dbLayer/modelDB.php');

class ModelCtrl
{
	private $mDB = null;

	public function __construct()
	{
		global $data;
		$mDB = new ModelDB();
		$someDataFromDB = $mDB->test();
		array_push($data,$someDataFromDB);
	}
}
?>