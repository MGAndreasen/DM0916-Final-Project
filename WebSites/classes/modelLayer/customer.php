<?php

class Customer {
    private $id;
	private $name;
	private $projects = array();

	public function __contruct(int $id, string $name){
		$this->$id = $id;
		$this->$name = $name;
	}

	public function getID() :int{
		return $this->$id;
	}

	public function getName() :string{
		return $this->$name;
	}

	public function getProjects() :array{
		return $this->$projects;
	}

	public function setID(int $id){
		$this->$id = $id;
	}

	public function setName(string $name){
		$this->$name = $name;
	}

	public function setProjects($projects){
		$this->$projects = $projects;
	}

	public function jsonSerialize() {
		$jsonProjects = [];
		foreach($this->projects as $project){
			array_push($jsonProjects, $project->jsonSerialize());
		}

        return array (
            'id' => $this->id,
			'name' => $this->name,
			'projects' => $jsonProjects
        );
}
?>