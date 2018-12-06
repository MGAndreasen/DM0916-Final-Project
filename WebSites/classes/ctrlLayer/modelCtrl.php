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
	}

	public function getModel($projectId)
	{
		$someDataFromDB = $mDB->getModel($projectId);
		array_push($data,$someDataFromDB);
	}
}
?>