<?php
// Includes
require_once('../classes/modelLayer/project.php');

class ProjectDB
{
	private $getCustomerFromCustomerID_SQL	= 'SELECT * FROM customer WHERE id = ?';
	private $getCustomers_SQL				= 'SELECT * FROM customer';

	//private $getEnabled_SQL		= 'SELECT Enabled from customer WHERE id = ?';
	//private $getHash_SQL			= 'SELECT Hash from customer WHERE id = ?';
	//private $getSalt_SQL			= 'SELECT Salt from customer WHERE id = ?';
	//private $getCreated_SQL		= 'SELECT Created from customer WHERE id = ?';
	//private $getLastAccess_SQL	= 'SELECT Last_Access from customer WHERE id = ?';
	//private $getEmail_SQL			= 'SELECT email from customer WHERE id = ?';
	private $updateEnabled_SQL		= 'UPDATE customer SET enabled = ?, WHERE id = ?';
	private $updateHash_SQL			= 'UPDATE customer SET hash = ?, WHERE id = ?';
	private $updateSalt_SQL			= 'UPDATE customer SET salt = ?, WHERE id = ?';
	private $updateCreated_SQL		= 'UPDATE customer SET created = ?, WHERE id = ?';
	private $updateLastAccess_SQL	= 'UPDATE customer SET last_access = ?, WHERE id = ?';
	private $updateEmail_SQL		= 'UPDATE customer SET email = ?, WHERE id = ?';

	private $updateValue_SQL = 'UPDATE :table SET :field = :value WHERE id = :id';

	public function __construct()
	{
	}

	public function updateEnabled($customerID, $value){
		updateValue($customerID, $value, $updateEnabled_SQL);
	}

	public function updateHash($customerID, $value){
		updateValue($customerID, $value, $updateHash_SQL);
	}

	public function updateSalt($customerID, $value){
		updateValue($customerID, $value, $updateSalt_SQL);
	}

	public function updateCreated($customerID, $value){
		updateValue($customerID, $value, $updateCreated_SQL);
	}

	public function updateLastAccess($customerID, $value){
		updateValue($customerID, $value, $updateLastAccess_SQL);
	}

	public function updateEmail($customerID, $value){
		updateValue($customerID, $value, $updateEmail_SQL);
	}

	public function updateValue($id, $value, $sqlStatement){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->sqlStatement);
		$query->bind_param('i', $id);
		$query->execute();
		$result = $query->get_result();

		//Not quite sure on this one for handling error msges.
		if ($result == FALSE) {
			return 'error: couldnt execute ' + sqlStatement + ' with value ' + $value + ' on id ' + $id;
		}
		else {
			return 'succes'; 
		}
	}

	//This could be a general one to save alot of lines. Updates a field in a table with a set value on a set id.
	public function updateValueTEST($table, $field, $value, $id){
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->$updateValue_SQL);
		$query->bind_param(':table', $id);
		$query->bind_param(':field', $field);
		$query->bind_param(':value', $value);
		$query->bind_param(':id', $id);
		$query->execute();
		$result = $query->get_result();

		//Not quite sure on this one for handling error msges.
		if ($result == FALSE) {
			return 'error: couldnt execute ' + sqlStatement + ' with value ' + $value + ' on id ' + $id;
		}
		else {
			return 'succes'; 
		}
	}

	public function getCustomer($customerID){
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


	/* Det roder hernede, */

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
}
?>