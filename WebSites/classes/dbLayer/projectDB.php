<?php
// Includes
require_once('../classes/modelLayer/project.php');

class ModelDB
{
	private $getProjectFromCustomerID_SQL = 'SELECT * FROM project WHERE customer_Id = ?';
	private $getProjects_SQL = 'SELECT * FROM project';

	public function __construct()
	{
	}

	public function getModel($customerID){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->$getProjectFromCustomerID_SQL);
		$query->bind_param('i', $customerID);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$project = new Project($row['id'], $row['image_size'], $row['enabled'], $row['name']);
				array_push($resultArr, $project);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any projects with that customerID');
		}
		return $resultArr;
	}

	public function getModels(){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->$getProjects_SQL);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$model = new Model($row['id'], $row['image_size'], $row['enabled'], $row['name']);
				array_push($resultArr, $model);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any projects');
		}
		return $resultArr;
	}
}
?>