<?php
// Includes
require_once('../classes/dbLayer/projectDB.php');

class ProjectCtrl {
    private static $instance;
	private final function __construct() {}
    private final function __clone() {}

	private $mDB = null;
	private $data = null;

	public final static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self;    
        }
        return self::$instance;
    }

	private function __construct() {
		global $data;
		$this->data = &$data;
		$this->mDB = new ProjectDB();

		// Validering af JWT samt rettigheder
		// TBD
	}

	public function getProject($id)	{
		$someDataFromDB = $this->mDB->getProject($id);
		array_push($this->data, $someDataFromDB);
	}

	public function getProjects($customerID) {
		$someDataFromDB = $this->mDB->getProjects($customerID);
		array_push($this->data, $someDataFromDB);
	}
}
?>