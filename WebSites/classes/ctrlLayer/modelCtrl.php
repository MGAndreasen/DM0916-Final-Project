<?php
// Includes
require_once('../classes/dbLayer/modelDB.php');

class ModelCtrl
{
	private $mDB = null;
	private $data = null;

	public function __construct()
	{
		global $data;
		$this->data = &$data;
		$this->mDB = new ModelDB();
	}

	public function getModel($projectId)
	{
		$someDataFromDB = $this->mDB->getModel($projectId);
		array_push($this->data,$someDataFromDB);
	}

	public function getModels()
	{
		$someDataFromDB = $this->mDB->getModels();
		array_push($this->data,$someDataFromDB);
	}
}
?>