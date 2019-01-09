<?php
// Includes
require_once('../classes/modelLayer/project.php');

class ProjectDB
{
	private $getCustomerFromCustomerID_SQL = 'SELECT * FROM customer WHERE customer_Id = ?';
	private $getCustomers_SQL = 'SELECT * FROM customers';

	public function __construct()
	{
	}

	public function getProject($customerID){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->$getCustomerFromCustomerID_SQL);
		$query->bind_param('i', $customerID);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$customer = new Project($row['id'], $row['image_size'], $row['enabled'], $row['name']);
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
				$subStructures = $this->getSubProjectStructures($row['id']);
				$projectStructure->setProjectStructures($subStructures);
				
				//Checks if there exists any subStructures for this structure.
				//so if no cant find a projectStructure with a parrent id matching this projectStructures id
				//there shouldnt be a substructure
				if (!(empty($this->getSubProjectStructures($row['id'])))){
					array_push($resultArr, $projectStructure);
				}


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