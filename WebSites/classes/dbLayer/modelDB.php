<?php
class ModelDB
{
	//private $getModelSQL = 'SELECT * FROM models WHERE projectID = ?';

	public function __construct()
	{
	}

	public function test()
	{
		global $conn;
		$someData = array();

		$someData['test'] = 'Hmm';

		// mysqli, prepared statements
		$query = $conn->prepare('SELECT * FROM users WHERE username = ?');
		$query->bind_param('s', $_GET['username']);
		$query->execute();

		return $someData;
	}

	public function getModel($projectID){
		$getModelSQL = 'SELECT * FROM models WHERE projectID = ?';
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($getModelSQL);
		$query->bind_param('i', (int)$_GET('projectID'));
		$result = $query->execute();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$id = $row["id"];
				$image_size = $row["image_size"];
				$created = $row["created"];
				$completed = $row["completed"];
				$model = new Model($id, $name, $created, $completed);
				array_push($resultArr, $model);
			}
		} 
		else 
		{
			array_push($resultArr, 'error: couldnt find any models with that projectID');
		}
		return $resultArr;
	}
}
?>