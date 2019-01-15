<?php
class Project implements JsonSerializable {
    private $id;
	private $customer_id;
	private $image_size;
	private $enabled;
	private $name;
	
	public function __construct(int $id, int $customer_id, int $image_size, bool $enabled, string $name) {
		$this->id = $id;
		$this->customer_id = $customer_id;
		$this->image_size = $image_size;
		$this->enabled = $enabled;
		$this->name = $name;
	}

	public function getID() {
		return $this->id;
	}

	public function getImage_size() {
		return $this->image_size;
	}

	public function getEnabled() {
		return $this->enabled;
	}

	public function getName() {
		return $this->name;
	}

	public function setÍmage_size(int $size) {
		$this->image_size = $size;
	}

	public function setEnabled($enabled) {
		$this->enabled = $enabled;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function jsonSerialize() {
        return array (
            'id' => $this->id,
			'customer_id' => $this->customer_id,
            'imagesize' => $this->image_size,
			'enabled' => $this->enabled,
			'name' => $this->name
        );
    }
}
?>