<?php
// Includes
require_once('../classes/modelLayer/project.php');

class ProjectDB
{
	// SQL Querys
	private $getProject_SQL		= 'SELECT * FROM project WHERE id = ?';
	private $getProjects_SQL	= 'SELECT * FROM project WHERE customer_id = ?';
	private $updateProject_SQL	= 'UPDATE SET name=:name, customer_id=:customer_id, image_size=:image_size, enabled=:enabled FROM project WHERE id = :id';
	private $createProject_SQL	= 'INSERT INTO project VALUE(null, name=:name, image_size=:image_size, customer_Id=:customer_id, enabled=_enabled)';
	private $removeProject_SQL	= 'DELETE FROM project WHERE id = ?';
	 
	// Constructor
	public function __construct() {
	}

	//(int $id, int $image_size, int $customer_id, bool $enabled, string $name) {
	// getProjects($customer_Id)
	public function getProjects($customer_id) {
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getProjects_SQL);
		$query->bind_param('i', $customer_id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$project = new Project($row['id'], $row['image_size'], $row['customer_id'], $row['enabled'], $row['name']);
				array_push($resultArr, $project);
			}
		} else { errorMsg('projectDB','getProjects','couldnt find any projects'); }
		return $resultArr;
	}

	// getProject(int ProjectID)
	public function getProject($id) {
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getProject_SQL);
		$query->bind_param('i', $id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$project = new Project($row['id'], $row['image_size'], $row['customer_id'], $row['enabled'], $row['name']);
				array_push($resultArr, $project);
			}
		}
		else { errorMsg('projectDB','getProjects','error: couldnt find any projects with that customerID'); }
		return $resultArr;
	}

	//Gets all projectstructures inclussive thier childrens projectStructure etc.
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

	//Helper function for getProjectStructures
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

	public function updateProject($project){
		global $conn;
		$query = $conn->prepare($this->$updateProject_SQL);
		$query->bind_param(':customer_id', $project->getCustomerID());
		$query->bind_param(':enabled', $project->getEnabled());
		$query->bind_param(':name', $project->getName());

		$query->execute();
		$result = $query->get_result();

		//Not quite sure on this one for handling error msges.
		if ($result == FALSE) {
			return 'error: couldnt execute ' + $updateProject_SQL + ' on id ' + $id;
		}
		else {
			return 1; 
		}
	}

	public function removeProject($id){
		$query = $conn->prepare($this->$removeProject_SQL);
		$query->bind_param(':id', $project->getID());
		$query->execute();
		$result = $query->get_result();

		if ($result == FALSE) {
			return 'error: couldnt execute ' + $removeProject_SQL + ' on id ' + $id;
		}
		else {
			return 1; 
		}
	}
}
?>