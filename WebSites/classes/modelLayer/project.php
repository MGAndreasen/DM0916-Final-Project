<?php
class Project implements JsonSerializable {
    private int $id;
	private int $customer_id;
	private int $image_size;
	private int $enabled;
	private string $name;
	
	public function __construct($id, $customer_id, $image_size, $enabled, $name) {
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
            'imagesize' => $this->image_size,
			'enabled' => $this->enabled,
			'name' => $this->name
        );
    }
}
?>