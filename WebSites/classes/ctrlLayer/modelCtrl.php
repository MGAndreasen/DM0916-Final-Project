<?php
class ModelCtrl
{
	private $mDB = null;
	include('../dbLayer/modelDB.php');

	public function __construct()
	{
		global $data;
		$mDB = new ModelDB();
	}
}
?>