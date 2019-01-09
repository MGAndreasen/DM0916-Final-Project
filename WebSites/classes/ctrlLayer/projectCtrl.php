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

	public function getProject($customerID)
	{
		$someDataFromDB = $this->mDB->getProject($customerID);
		array_push($this->data['result'], $someDataFromDB);
	}

	public function getProjects()
	{
		$someDataFromDB = $this->mDB->getProjects();
		array_push($this->data['result'], $someDataFromDB);
	}
}
?>