<?php

class Customer {
    private $id;
	private $enabled;
	private $hash;
	private $salt;
	private $created;
	private $lastAccess;
	private $email;
	private $projects = array();

	public function __contruct(int $id, string $email){
		$this->id = $id;
		$this->email = $email;
	}

	public function getID() :int{
		return $this->id;
	}

	public function getEnabled() {
		return $this->enabled;
	}

	public function getHash() {
		return $this->hash;
	}

	public function getSalt() {
		return $this->salt;
	}

	public function getCreated() {
		return $this->created;
	}

	public function getLastAcces() {
		return $this->lastAccess;
	}

	public function getEmail() :string{
		return $this->email;
	}

	public function getProjects() :array{
		return $this->projects;
	}

	public function setID(int $id){
		$this->id = $id;
	}

	public function setEnabled($enabled) {
		$this->enabled = $enabled;
	}

	public function setHash($hash) {
		$this->hash = $hash;
	}

	public function setSalt($salt) {
		$this->salt = $salt;
	}

	public function setCreated($created) {
		$this->created = $created;
	}

	public function setLastAcces($lastAccess) {
		$this->lastAccess = $lastAccess;
	}


	public function setEmail(string $email){
		$this->email = $email;
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
			'enabled' => $this->enabled,
			'hash' => $this->hash,
			'salt' => $this->salt,
			'created' => $this->created,
			'lastAccess' => $this->lastAccess,
			'email' => $this->email,
			'projects' => $jsonProjects
        );
	}
}
?>