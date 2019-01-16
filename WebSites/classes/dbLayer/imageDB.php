<?php
// Includes
require_once('../classes/modelLayer/project.php');

class ProjectDB
{
	private $createImage_SQL = 'INSERT INTO image VALUE(null,?,?,?,?)';
	private $removeImage_SQL = 'DELETE FROM image WHERE id = ?';
	private $updateImage_SQL = 'UPDATE SET file_name=?, file_path=?, project_id=? FROM image WHERE id = ?';
	private $getImage_SQL = 'SELECT * FROM image WHERE id = ?';
	private $getImages_SQL = 'SELECT * FROM image WHERE project_id = ?';

	public function __construct() {
	}

	// getImages($getimages_Id)
	public function getImages($project_id) {
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->getImages_SQL);
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

	// getImage(int ImageID)
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
}
?>