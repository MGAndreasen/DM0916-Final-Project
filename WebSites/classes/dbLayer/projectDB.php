<?php
// Includes
require_once('../classes/modelLayer/project.php');

class ProjectDB
{
	// SQL Querys
	private $createProject_SQL = 'INSERT INTO project VALUE(null,?,?,?,?)';
	private $removeProject_SQL = 'DELETE FROM project WHERE id = ?';
	private $updateProject_SQL = 'UPDATE SET name=?, customer_id=?, enabled=?, image_size=?  FROM project WHERE id = ?';
	private $getProject_SQL = 'SELECT * FROM project WHERE id = ?';
	private $getProjects_SQL = 'SELECT * FROM project WHERE customer_id = ?';

	// Constructor
	public function __construct() {
	}


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
				$project = new Project($row['id'], $row['customer_id'], $row['image_size'], $row['enabled'], $row['name']);
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
				$project = new Project($row['id'], $row['customer_Id'], $row['image_size'], $row['enabled'], $row['name']);
				array_push($resultArr, $project);
			}
		}
		else 
		{
			errorMsg('projectDB','getProjects','error: couldnt find any projects with that customerID');
		}
		return $resultArr;
	}

/*	
	//Skal indsættes ind i projectDB?
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

	//Skal indsættes ind i projectDB?
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

	//Skal indsættes ind i projectDB?
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

	//Skal indsættes ind i projectDB?
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
	*/
}
?>