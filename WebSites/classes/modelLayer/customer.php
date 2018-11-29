<?php

class Customer {
    private $id;
	private $name;
	private $projects = array();

	public function __contruct(int $id, string $name){
		$this->$id = $id;
		$this->$name = $name;
	}

	public function getID(){
		return $this->$id;
	}

	public function getName(){
		return $this->$name;
	}

	public function getProjects(){
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
}

?>