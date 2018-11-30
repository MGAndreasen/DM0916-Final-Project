<?php
include('../classes/dbLayer/modelCtrl.php');

class ModelCtrl
{
	$modelDB = null;

	public function __construct()
	{
		$modelDB = new ModelCtrl();
		global $data;
	}
}
?>