<?php
// Includes
require_once('../classes/modelLayer/project.php');

class ImageDB
{
	private $getImage_SQL					   = 'SELECT * FROM image WHERE id = ?';
	private $getImagesFromProject_SQL		   = 'SELECT * FROM image WHERE project_id = ?';
	private $getImagesFromProjectStructure_SQL = 'SELECT * FROM image WHERE projectStruture_id = ?';
	private $createImage_SQL = 'INSERT INTO image VALUE(null,?,?,?,?)';
	private $updateImage_SQL = 'UPDATE SET file_name=?, file_path=?, project_id=? FROM image WHERE id = ?';
	private $removeImage_SQL = 'DELETE FROM image WHERE id = ?';

	public function __construct() {
	}

	public function getImage($id) {
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getImage_SQL);
		$query->bind_param('i', $id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$image = new Project($row['id'], $row['project_Id'], $row['file_name'], $row['file_path=?']);
				array_push($resultArr, $image);
			}
		} 
		else 
		{
			errorMsg('imageDB','getImages','error: couldnt find any images with that imageID');
		}
		return $resultArr;
	}

	public function getImagesFromProject($project_id) {
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->$getImagesFromProject_SQL);
		$query->bind_param('i', $project_id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				image = new Image($row['id'], $row['project_id'], $row['file_name'], $row['file_path=?']);
				array_push($resultArr, $image);
			}
		} else { errorMsg('imageDB','getImages','couldnt find any images'); }
		return $resultArr;
	}

	public function getImagesFromProjectStruture($projectStructure_id) {
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->$getImagesFromProjectStructure_SQL);
		$query->bind_param('i', $project_id);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				image = new Image($row['id'], $row['project_id'], $row['file_name'], $row['file_path=?']);
				array_push($resultArr, $image);
			}
		} else { errorMsg('imageDB','getImages','couldnt find any images'); }
		return $resultArr;
	}

	public function createImage($image){
		global $conn;
		$query = $conn->prepare($this->$createImage_SQL);
		$query->bind_param(':file_name', $image->getFileName();
		$query->bind_param(':file_path', $image->getFilePath();
		$query->execute();
		
		//Not quite sure on this one for handling error msges.
		if ($result == FALSE) {
			errorMsg('imageDB','createImage','couldnt create image'); 
		}
	}

	public function removeImage($id){
		global $conn;
		$query = $conn->prepare($this->$removeImage_SQL);
		$query->bind_param(':id', $id);
		$query->execute();
		
		//Not quite sure on this one for handling error msges.
		if ($result == FALSE) {
			errorMsg('imageDB','removeImage','couldnt remove image'); 
		}
	}
}
?>