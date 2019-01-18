<?php
class Model implements JsonSerializable {
    private $id;
	private $imageSize;
	private $created;
	private $completed;

	public function __construct(int $id, int $imageSize, string $created, string $completed){
		$this->id = $id;
		$this->imageSize = $imageSize;
		$this->created = $created;
		$this->completed = $completed;
	}

	public function getID(): int{
		return $this->id;
	}

	public function getProject(){
		return $this->project;
	}

	public function getimageSize(): int{
		return $this->imageSize;
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

	public function setimageSize(int $size){
		$this->imageSize = $size;
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
            'imagesize' => $this->imageSize,
			'created' => $this->created,
			'completed' => $this->completed
        );
    }
}
?>