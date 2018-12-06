<?php
class Model implements JsonSerializable {
    private $id;
	private $image_size;
	private $created;
	private $completed;

	public function __construct($id, $name, $created, $completed){
		$this->id = $id;
		$this->image_size = $image_size;
		$this->created = $created;
		$this->completed = $completed;
	}

	public function getID() {
		return $this->id;
	}

	public function getImage_size(){
		return $this->image_size;
	}

	public function getCreated(){
		return $this->created;
	}

	public function getCompleted(){
		return $this->completed;
	}

	public function setID(int $id){
		$this->id = $id;
	}

	public function setÍmage_size(int $size){
		$this->image_size = $size;
	}

	public function setCreated($created){
		$this->created = $created;
	}

	public function setCompleted($completed){
		$this->completed = $completed;
	}

	public function jsonSerialize() {
        return array (
            'id' => 1+$this->id,
            'imagesize' => $this->image_size,
			'created' => $this->created,
			'completed' => $this->completed
        );
    }
}

?>