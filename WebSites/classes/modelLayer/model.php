<?php
class Model implements JsonSerializable {
    private $id;
	private $image_size;
	private $created;
	private $completed;

	public function __construct(int $id, int $image_size, string $created, string $completed){
		$this->id = $id;
		$this->image_size = $image_size;
		$this->created = $created;
		$this->completed = $completed;
	}

	public function getID(): int{
		return $this->id;
	}

	public function getImage_size(): int{
		return $this->image_size;
	}

	public function getCreated(): string{
		return $this->created;
	}

	public function getCompleted(): string{
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

	public function jsonSerialize(): array{
        return array (
            'id' => $this->id,
            'imagesize' => $this->image_size,
			'created' => $this->created,
			'completed' => $this->completed
        );
    }
}

?>