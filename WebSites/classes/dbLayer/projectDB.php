<?php
// Includes
require_once('../classes/modelLayer/project.php');
require_once('../classes/modelLayer/projectStructure.php');

class ProjectDB
{
	// SQL Querys
	private $getProject_SQL		= 'SELECT * FROM project WHERE id = ?';
	private $getProjects_SQL	= 'SELECT * FROM project WHERE customer_id = ?';
	private $updateProject_SQL	= 'UPDATE project SET image_size = ?, customer_id = ?, enabled = ?, name = ? WHERE id = ?';
	private $createProject_SQL	= 'INSERT INTO project VALUE(null, ?, ?, ?, ?)';
	private $removeProject_SQL	= 'DELETE FROM project WHERE id = ?';

	private $modelStructure_SQL	= 'SELECT * FROM project_structure WHERE project_id = ? AND parent_id = ?';
	 
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
		else { errorMsg('projectDB','getProject','couldnt find any project with that ID'); }
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

	public function createProject($imageSize, $customerId, $enabled, $name) {
		global $conn;
		$conn->autocommit(false);
		$query = $conn->prepare($this->createProject_SQL);
		$query->bind_param('iiis', $imageSize, $customerId, $enabled, $name);
		$query->execute();
		$result = $conn->insert_id;

		$conn->commit();
		$conn->autocommit(true);

		if ($result > 0) {
			return $result;
		}
		return null;
	}

	public function updateProject(int $id, int $image_size, int $customer_id, int $enabled, string $name){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->updateProject_SQL);
		$query->bind_param('iiisi', $image_size, $customer_id, $enabled, $name, $id);
		$query->execute();
		$result = $query->get_result();

		if ($result == FALSE) {
			errorMsg('error: couldnt execute ' + $this->updateProject_SQL + ' on id ' + $id);
			array_push($resultArr, result);
			return $resultArr;
		}
		elseif ($result->num_rows > 0){
			return $resultArr;
		}
	}

	//bookmark ch
	public function removeProject($id){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->removeProject_SQL);
		$query->bind_param('i', $id);
		$query->execute();
		$result = $query->get_result();

		if ($result == FALSE) {
			errorMsg('projectDB', 'removeProject', 'error: couldnt execute ' + $removeProject_SQL + ' on id ' + $id);
		}

		return $resultArr;

	}

	public function getModelToBuild(int $project_id, int $parent_id) {
		global $conn;
		$resultArr = [];

		$query = $conn->prepare($this->modelStructure_SQL);
		$query->bind_param("ii", $project_id, $parent_id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$ps = new ProjectStructure($row['id'], $row['image_size'], $row['filter_size'], $row['validation_size'], $row['name']);

				// indfsadfdsafdsfdsf



				array_push($resultArr, $ps);
			}
		}
		else
		{
			errorMsg('projectDB','getModelToBuild','couldnt find any ('.$project_id.') project_structure with parent_id'.$parent_id);
		}
		
		return $resultArr;
	}


	private function getProjectStructureImages(int $id) {
		
	}
}
?>