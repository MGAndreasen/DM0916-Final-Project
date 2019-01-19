<?php
class Project implements JsonSerializable {
    private $id;
	private $customerId;
	private $imageSize;
	private $enabled;
	private $name;
	private $projectStructures;
	
	public function __construct(int $id, int $imageSize, int $customerId, int $enabled, string $name) {
		$this->id = $id;
		$this->imageSize = $imageSize;
		$this->customerId = $customerId;
		$this->enabled = $enabled;
		$this->name = $name;
		$this->projectStrutures = array();
	}

	public function getID(): int {
		return $this->id;
	}
	
	public function getImageSize(): int {
		return $this->imageSize;
	}

	public function getCustomerId(): int {
		return $this->customerId;
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

	public function setImageSize(int $size) {
		$this->imageSize = $size;
	}

	public function setCustomerId(int $customerId) {
		$this->customerId = $customerId;
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
			'customerId' => $this->customerId,
            'imagesize' => $this->imageSize,
			'enabled' => $this->enabled,
			'name' => $this->name,
			'projectStrutures' => $this->projectStrutures
        );
    }
}
?>