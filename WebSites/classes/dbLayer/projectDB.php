<?php
// Includes
require_once('../classes/modelLayer/project.php');
require_once('../classes/modelLayer/projectStruture.php');

class ProjectDB
{
	private $getProjectFromCustomerID_SQL = 'SELECT * FROM project WHERE customer_Id = ?';
	private $getProjects_SQL = 'SELECT * FROM project';
	private $getProjectStructuresFromProjectID_SQL = 'SELECT * FROM projectStruture WHERE project_id = ?';

	public function __construct()
	{
	}

	public function getProject($customerID){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getProjectFromCustomerID_SQL);
		$query->bind_param('i', $customerID);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$project = new Project($row['id'], $row['image_size'], $row['enabled'], $row['name']);
				$projectStructures = $this->getProjectStructures(); 
				$project->setProjectStructure($projectStructes);
				array_push($resultArr, $project);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any projects with that customerID');
		}
		return $resultArr;
	}

	//TODO
	public function getProjectStructures($projectID){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->$getProjectStructuresFromProjectID_SQL);
		$query->bind_param('i', $projectID);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$projectStruture = new ProjectStruture($row['id'], $row['image_size'], $row['filter_size'], $row['$validation_size'], $row['name']);
				array_push($resultArr, $projectStruture);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any projectStruture with that projectID');
		}
		return $resultArr;


	}

	public function getProjects(){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getProjects_SQL);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$model = new Project($row['id'], $row['image_size'], $row['enabled'], $row['name']);
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