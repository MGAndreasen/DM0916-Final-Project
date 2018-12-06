<?php
// Includes
require_once('../classes/modelLayer/project.php');
require_once('../classes/modelLayer/projectStructure.php');

class ProjectDB
{
	private $getProjectFromCustomerID_SQL = 'SELECT * FROM project WHERE customer_Id = ?';
	private $getProjects_SQL = 'SELECT * FROM project';
	private $getProjectStructuresFromProjectID_SQL = 'SELECT * FROM project_structur WHERE project_id = ?';
	private $getSubProjectStructuresFromProjectID_SQL = 'SELECT * FROM project_structur WHERE id = ?';

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
				$projectStructures = $this->getProjectStructures((int)$row['id']); 
				$project->setProjectStructures($projectStructures);
				array_push($resultArr, $project);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any projects with that customerID');
		}
		return $resultArr;
	}

	public function getProjectStructures($projectID){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getProjectStructuresFromProjectID_SQL);
		$query->bind_param('i', $projectID);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$projectStructure = new ProjectStructure($row['id'], $row['image_size'], $row['filter_size'], $row['validation_size'], $row['name']);
				$subStructures = $this->getSubProjectStructures($row['parent_id']);
				$projectStructure->setProjectStructures($subStructures);
				array_push($resultArr, $projectStructure);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any projectStruture with that projectID');
		}
		return $resultArr;
	}

	public function getSubProjectStructures($parent_id){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getSubProjectStructuresFromProjectID_SQL);
		$query->bind_param('i', $parent_id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$subProjectStructure = new ProjectStructure($row['id'], $row['image_size'], $row['filter_size'], $row['validation_size'], $row['name']);
				array_push($resultArr, $subProjectStructure);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any projects');
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
				$project = new Project($row['id'], $row['image_size'], $row['enabled'], $row['name']);
				$projectStructures = $this->getProjectStructures((int)$row['id']); 
				$project->setProjectStructures($projectStructures);
				array_push($resultArr, $project);
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