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
		$newProject = new Project(null, $image_size, $customer_id, $enabled, $name);
		$newProjectId = $this->mDB->createProject($newProject);

		//Check if inserted
		if ($newProjectId > 0) {
			getCustomer($newProjectId);
		}
		else {
			errorMsg('ProjectCtrl','createProject()','Did not insert project correctly');
		}
	}

	public function updateProject($id) {
	
	}

	public function deleteProject($id) {
		
	}


	public function getModelToBuild(int $project_id, int $parent_id) {
		$result = $this->mDB->getModelToBuild($project_id, $parent_id);

		if(!empty($result))	{
			$this->data['result']['modelstructure'] = $result;
		}
	}
}
?>
