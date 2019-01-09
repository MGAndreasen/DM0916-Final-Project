<?php
// Includes
require_once('../classes/modelLayer/project.php');

/*
require_once('../classes/modelLayer/projectStructure.php');
*/

class ProjectDB
{
	private $getProject_SQL = 'SELECT * FROM project WHERE id = ?';
	private $getProjects_SQL = 'SELECT * FROM project customer_Id = ?';

	public function __construct()
	{
	}

	// getProject(int ProjectID)
	public function getProject($id){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getProject_SQL);
		$query->bind_param('i', $id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$project = new Project($row['id'], $row['image_size'], $row['enabled'], $row['name']);
				//$projectStructures = $this->getProjectStructures((int)$row['id']); 
				//$project->setProjectStructures($projectStructures);
				array_push($resultArr, $project);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any projects with that customerID');
		}
		return $resultArr;
	}

	// getProjects($customerID)
	public function getProjects($customerID)
	{
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getProjects_SQL);
		$query->bind_param('i', $customerID);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$project = new Project($row['id'], $row['image_size'], $row['enabled'], $row['name']);
				//$projectStructures = $this->getProjectStructures((int)$row['id']); 
				//$project->setProjectStructures($projectStructures);
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