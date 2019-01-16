<?php
class Model implements JsonSerializable {
    private $id;
	private $fileName;
	private $filePath;

	public function __construct(int $id, string $filePath, string $fileName){
		$this->id = $id;
		$this->fileName = $fileName;
		$this->filePath = $filePath;
	}

	public function getID(): int{
		return $this->id;
	}

	public function getFileName(): string{
		return $this->fileName;
	}

	public function getFilePath(): string{
		return $this->filePath;
	}

	public function setID(int $id): int{
		$this->id = $id;
	}

	public function setFileName(string $fileName){
		$this->fileName = $fileName;
	}

	public function setFilePath(string $filePath){
		$this->path = $path;
	}

	public function jsonSerialize(): array {
        return array (
            'id' => $this->id,
            'fileName' => $this->fileName,
			'filePath => $this->filePath'
        );
    }
}
?>