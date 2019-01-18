<?php


//Not done.
class Model implements JsonSerializable {
	private $id;
	private $imageSize;
	private $filterSize;
	private $validationSize;
	private $name;
	//
	private $testImages;


	private $testImages;
	private $Model_Id;
	private $project_history_structure_id;
	private $project_history_parrent_id;


	public function __construct(int $id, int $imageSize, string $filterSize, string $name){
		$this->id = $id;
		$this->imageSize = $imageSize;
		$this->filterSize = $filterSize;
		$this->validationSize = $validationSize;
		$this->name = $name;


		$this->testImages = new array();
	}

	public function getID(): int{
		return $this->id;
	}


	public function setID(int $id){
		$this->id = $id;
	}


}

?>