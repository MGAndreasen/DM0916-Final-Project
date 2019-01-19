<?php
class Customer {
    private $id;
	private $enabled;
	private $hash;
	private $salt;
	private $created;
	private $lastAccess;
	private $email;

	public function __contruct(int $id, string $enabled, string $hash, string $salt, string $created, string $lastAccess, string $email) {
		$this->id = $id;
		$this->enabled = $enabled;
		$this->hash = $hash;
		$this->salt = $salt;
		$this->created = $created;
		$this->lastAccess = $lastAccess;
		$this->email = $email;
	}

	public function getId() :int{
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

	public function getLastAccess() {
		return $this->lastAccess;
	}

	public function getEmail() :string{
		return $this->email;
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

	public function setEmail(string $email){
		$this->email = $email;
	}

	public function jsonSerialize() {
        return array (
            'id' => $this->id,
			'enabled' => $this->enabled,
			'hash' => $this->hash,
			'salt' => $this->salt,
			'created' => $this->created,
			'lastaccess' => $this->lastAccess,
			'email' => $this->email
        );
	}
}
?>