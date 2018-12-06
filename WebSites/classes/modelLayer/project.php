<?php

class Project implements JsonSerializable {
    private $id;
	private $image_size;
	private $enabled;
	private $name;
	private $images = array();
	private $projectStructes = array();

	public function __construct(int $id, string $image_size, string $enabled, string $name){
		$this->id = $id;
		$this->image_size = $image_size;
		$this->enabled = $enabled;
		$this->name = $name;
	}

	public function getID(){
		return $this->id;
	}

	public function getImage_size(){
		return $this->image_size;
	}

	public function getEnabled(){
		return $this->enabled;
	}

	public function getName(){
		return $this->name;
	}

	public function getImages(){
		return $this->images();
	}

	public function getProjectStructure(){
		return $this->models();
	}

	public function setID(int $id){
		$this->id = $id;
	}

	public function setÍmage_size(int $size){
		$this->image_size = $size;
	}

	public function setEnabled($enabled){
		$this->enabled = $enabled;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setImages($images){
		$this->images = $images;
	}
	
	public function setProjectStructures($projectStructures){
		$this->ProjectStructures = $projectStructures; 
	}

	public function jsonSerialize() {
		$jsonProjectStructes = [];
		foreach($this->projectStructes as $projectStructure){
			push_array($jsonProjectStructes, $projectStructure->JsonSerializable());
		}

		$jsonImages = [];
		foreach($this->images as $image){
			push_array($jsonImages, $image->JsonSerializable());
		}

        return array (
            'id' => $this->id,
            'imagesize' => $this->image_size,
			'enabled' => $this->enabled,
			'name' => $this->name,
			'projectStructure' => $jsonProjectStructes,
			'images' => $jsonImages
        );
    }
}

?>