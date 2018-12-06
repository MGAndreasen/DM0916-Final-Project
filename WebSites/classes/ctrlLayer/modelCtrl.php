<?php
// Includes
require_once('../classes/dbLayer/modelDB.php');

class ModelCtrl
{
	private $mDB = null;

	public function __construct()
	{
		global $data;
		$this->mDB = new ModelDB();
	}

	public function getModel($projectId)
	{
		$someDataFromDB = $this->mDB->getModel($projectId);
		array_push($data,$someDataFromDB);
	}
}
?>