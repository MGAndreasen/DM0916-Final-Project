<?php
// Includes
require_once('../classes/dbLayer/projectDB.php');

class ProjectCtrl
{
	private $mDB = null;
	private $data = null;

	public function __construct()
	{
		global $data;
		$this->data = &$data;
		$this->mDB = new ProjectDB();
	}

	public function getProject($id)
	{
		$someDataFromDB = $this->mDB->getProject($id);
		array_push($this->data, $someDataFromDB);
	}

	public function getProjects($customerID)
	{
		$someDataFromDB = $this->mDB->getProjects($customerID);
		array_push($this->data, $someDataFromDB);
	}
}
?>