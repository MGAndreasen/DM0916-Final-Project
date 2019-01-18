<?php
// Includes
require_once('../classes/modelLayer/project.php');
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
		$result = $this->mDB->getProject($id);
		if(!empty($result))	{
			$this->data['result']['projects'] = $result;
		}
	}

	public function getProjects($customerID) {
		$result = $this->mDB->getProjects($customerID);

		if(!empty($result))	{
			$this->data['result']['projects'] = $result;
		}
	}

	public function createProject(int $image_size, int $customer_id, bool $enabled, string $name) {
		//if()
		//$model = new project();
	}

	public function updateProject($id) {
	
	}

	public function deleteProject($id) {
		
	}


	public function getModelToBuild($parent_id) {
		$result = $this->mDB->getModelToBuild($parent_id);

		if(!empty($result))	{
			$this->data['result']['modelstructure'] = $result;
		}
	}
}
?>
