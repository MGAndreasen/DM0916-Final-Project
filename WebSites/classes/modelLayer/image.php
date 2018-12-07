<?php
class Model implements JsonSerializable {
    private $id;
	private $filePath;
	private $fileName;

	public function __construct(int $id, string $filePath, string $fileName){
		$this->id = $id;
		$this->filePath = $filePath;
		$this->fileName = $fileName;
	}

	public function getID(): int{
		return $this->id;
	}

	public function getFilePath(): string{
		return $this->filePath;
	}

	public function getFileName(): string{
		return $this->fileName;
	}

	public function setID(int $id): int{
		$this->id = $id;
	}

	public function setFilePath(string $filePath){
		$this->path = $path;
	}

	public function setFileName(string $fileName){
		$this->fileName = $fileName;
	}

	public function jsonSerialize(): array {
        return array (
            'id' => $this->id,
            'path' => $this->path,
        );
    }
}

?>