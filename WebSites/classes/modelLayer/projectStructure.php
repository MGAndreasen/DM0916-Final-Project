<?php
//	id	project_id	parent_id	image_size	filter_size	validation_size	name
class ProjectStructure implements JsonSerializable {
    private $id;
	private $image_size;
	private $filter_size;
	private $validation_size;
	private $name;
	private $projectStructures = array();

	public function __construct(int $id, string $image_size, string $filter_size, string $validation_size, string $name){
		$this->id = $id;
		$this->image_size = $image_size;
		$this->filter_size = $filter_size;
		$this->validation_size = $validation_size;
		$this->name = $name;
	}

	public function getID(){
		return $this->id;
	}

	public function getImage_size(){
		return $this->image_size;
	}

	public function getfilter_size(){
		return $this->filter_size;
	}

	public function getValidationSize(){
		return $this->validation_size;
	}

	public function getName(){
		return $this->name;
	}

	public function getModels(){
		return $this->models();
	}

	public function setID(int $id){
		$this->id = $id;
	}

	public function setProjectStructures($projectStructes){
		$this->projectStructures = $projectStructes;
	}

	public function setÍmage_size(int $size){
		$this->image_size = $size;
	}

	public function setfilter_size($filter_size){
		$this->filter_size = $filter_size;
	}

	public function setValidationSize($validation_size){
		$this->validation_size = $validation_size;
	}

	public function setName($name){
		$this->name = $name;
	}
	
	public function setModels($models){
		$this->models = $models; 
	}

	public function jsonSerialize() {
		$jsonStrutures = array();
		if(!empty($this->projectStructures)){
			foreach($this->projectStructures as $projectStructure){
				if(!is_string($projectStructure)){
					array_push($jsonStrutures, $projectStructure->jsonSerialize());
				}
			}
		}
		else{
			array_push($jsonStrutures, '');
		}

        return array (
            'id' => $this->id,
            'imagesize' => $this->image_size,
			'filter_size' => $this->filter_size,
			'validation_size' => $this->validation_size,
			'name' => $this->name,
			'subStructures' => $jsonStrutures
        );
    }

	
}

?>