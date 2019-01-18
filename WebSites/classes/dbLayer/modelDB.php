<?php
// Includes
require_once('../classes/modelLayer/model.php');

class ModelDB
{	
	//SQL Queries
	private $getModel_SQL					= 'SELECT * FROM model WHERE project_Id = ?';
	private $getModels_SQL					= 'SELECT * FROM model';
	private $getModelsFromProjectId_SQL		= 'SELECT * FROM model where id = ?';
	private $updateModel_SQL				= 'UPDATE SET image_size=:image_size, created=:created, completed=:completed, WHERE id = :id';
	private $createModel_SQL				= 'INSERT INTO model VALUE(null, image_size=:image_size, created=:created, completed=:completed)';
	private $removeModel_SQL				= 'DELETE FROM model WHERE id = ?';

	public function __construct() {
	}

	public function getModel($modelID){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getModelSQL);
		$query->bind_param('i', $modelID);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$model = new Model($row['id'], $row['image_size'], $row['created'], $row['completed']);
				array_push($resultArr, $model);
			}
		} 
		else {
			errorMsg($resultArr, 'error: couldnt find any models with that projectID');
		}
		return $resultArr;
	}

	//Bookmark CH
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