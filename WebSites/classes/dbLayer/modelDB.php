<?php
// Includes
require_once('../classes/modelLayer/model.php');

class ModelDB
{
	private $getModelSQL = 'SELECT * FROM model WHERE project_Id = ?';
	private $getModelsSQL = 'SELECT * FROM model';

	public function __construct()
	{
	}

	public function test()
	{
		global $conn;
		$someData = array();

		$someData['test'] = 'Hmm';

		// mysqli, prepared statements
		$query = $conn->prepare('SELECT * FROM users WHERE username = ?');
		$query->bind_param('s', $_GET['username']);
		$query->execute();

		return $someData;
	}

	public function getModel($projectID){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getModelSQL);
		$query->bind_param('i', $projectID);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$model = new Model($row['id'], $row['image_size'], $row['created'], $row['completed']);
				array_push($resultArr, $model);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any models with that projectID');
		}
		return $resultArr;
	}

	public function getModels(){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getModelsSQL);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$model = new Model($row['id'], $row['image_size'], $row['created'], $row['completed']);
				array_push($resultArr, $model);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any models with that projectID');
		}
		return $resultArr;
	}
}
?>