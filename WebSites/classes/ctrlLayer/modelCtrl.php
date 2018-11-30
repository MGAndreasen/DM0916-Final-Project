<?php
class ModelCtrl
{
	$modelDB = null;
	include('../dbLayer/modelDB.php');

	public function __construct()
	{
		global $data;
		$modelDB = new ModelDB();
	}
}
?>