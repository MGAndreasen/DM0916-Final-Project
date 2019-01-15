<?php
// Includes
require_once('../classes/modelLayer/project.php');

class ProjectDB
{
	private $createProject_SQL = 'INSERT INTO project VALUE(null,?,?,?,?)';
	private $removeProject_SQL = 'DELETE FROM project WHERE id = ?';
	private $updateProject_SQL = 'UPDATE SET name=?, customer_id=?, enabled=?, image_size=?  FROM project WHERE id = ?';
	private $getProject_SQL = 'SELECT * FROM project WHERE id = ?';
	private $getProjects_SQL = 'SELECT * FROM project WHERE customer_Id = ?';

	public function __construct() {
	}

	// getProjects($customer_Id)
	public function getProjects($customer_Id) {
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getProjects_SQL);
		$query->bind_param('i', $customer_Id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$project = new Project($row['id'], $row['customer_Id'], $row['image_size'], $row['enabled'], $row['name']);
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
}
?>