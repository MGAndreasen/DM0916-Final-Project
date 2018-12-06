<?php

class Project implements JsonSerializable {
    private $id;
	private $image_size;
	private $enabled:
	private $name;
	private $models = array();

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

	public function getModels(){
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
	
	public function setModels($models){
		$this->models = $models; 
	}

	public function jsonSerialize() {
		$jsonModels = [];
		foreach($this->models as $model){
			push_array($jsonModels, $model->JsonSerializable());
		}

        return array (
            'id' => $this->id,
            'imagesize' => $this->image_size,
			'enabled' => $this->enabled,
			'name' => $this->name,
			'models' => $jsonModels
        );
    }

	
}

?>