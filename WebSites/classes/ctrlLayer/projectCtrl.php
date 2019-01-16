<?php
// Includes
require_once('../classes/dbLayer/projectDB.php');

class ProjectCtrl {
    private static $instance;
	private $mDB = null;
	private $data = null;

	public final static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

	private final function __clone() {}
	private final function __construct() {
		global $data;
		$this->data = &$data;
		$this->mDB = new ProjectDB();

		// Validering af JWT samt rettigheder
		// TBD
	}

	public function getProject($id)	{
		$toReturn = array();
		$toReturn['projects'] = $this->mDB->getProject($id);
		array_push($this->data, $toReturn);
	}

	public function getProjects($customerID) {
		errorMsg('hej','hej','hej');
		errorMsg('med','med','med');
		errorMsg('dig','dig','dig');
		//$toReturn = array();
		//$toReturn['projects'] = $this->mDB->getProjects($customerID);
		//array_push($this->data, $toReturn);
		$this->data['projects'] = $this->mDB->getProjects($customerID);
	}

	public function createProject() {
		
	}

	public function updateProject($id) {
	
	}

	public function deleteProject($id) {
		
	}
}
?>
