<?php
class ProjectStructure implements JsonSerializable {
    private $id;
	private $image_size;
	private $filter_size;
	private $validation_size;
	private $name;
	private $subProjectStructures;
	private $images;

	public function __construct(int $id, string $image_size, string $filter_size, string $validation_size, string $name) {
		$this->id = $id;
		$this->image_size = $image_size;
		$this->filter_size = $filter_size;
		$this->validation_size = $validation_size;
		$this->name = $name;
		$this->subProjectStructures = array();
		$this->images = array();
	}

	public function getID(): int{
		return $this->id;
	}

	public function getImage_size(): int{
		return $this->image_size;
	}

	public function getfilter_size(): int{
		return $this->filter_size;
	}

	public function getValidationSize(): int{
		return $this->validation_size;
	}

	public function getName(): string{
		return $this->name;
	}

	public function getModels(): array{
		return $this->models();
	}

	public function setID(int $id){
		$this->id = $id;
	}

	public function setProjectStructures($subProjectStructures){
		$this->subProjectStructures = $subProjectStructures;
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

	public function jsonSerialize(): array{
        return array (
            'id' => $this->id,
            'imagesize' => $this->image_size,
			'filter_size' => $this->filter_size,
			'validation_size' => $this->validation_size,
			'name' => $this->name,
			'subStructures' => $this->subProjectStructures;
        );
    }	
}
?>