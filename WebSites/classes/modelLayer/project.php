<?php
class Project implements JsonSerializable {
    private $id;
	private $customer_id;
	private $image_size;
	private $enabled;
	private $name;
	private $projectStructures;
	
	public function __construct(int $id, int $image_size, int $customer_id, int $enabled, string $name) {
		$this->id = $id;
		$this->image_size = $image_size;
		$this->customer_id = $customer_id;
		$this->enabled = $enabled;
		$this->name = $name;
		$this->projectStrutures = array();
	}

	public function getID(): int {
		return $this->id;
	}
	
	public function getImage_size(): int {
		return $this->image_size;
	}

	public function getEnabled(): int {
		return $this->enabled;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getProjectStrutures() {
		return $this->projectStrutues();
	}

	public function setImage_size(int $size) {
		$this->image_size = $size;
	}

	public function setEnabled(int $enabled) {
		$this->enabled = $enabled;
	}

	public function setName(string $name) {
		$this->name = $name;
	}

	public function setProjectStrutures($projectStructures) {
		$this->projectStrutures = $projectStructures;
	}

	public function jsonSerialize() {
        return array (
            'id' => $this->id,
			'customer_id' => $this->customer_id,
            'imagesize' => $this->image_size,
			'enabled' => $this->enabled,
			'name' => $this->name,
			'projectStrutures' => $this->projectStrutures
        );
    }
}
?>