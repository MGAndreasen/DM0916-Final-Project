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

	public function createProject(int $image_size, int $customer_id, int $enabled, string $name) {
		$newProjectId = $this->mDB->createProject($image_size, $customer_id, $enabled, $name);

		//Check if inserted
		if ($newProjectId > 0) {
			$this->getProject($newProjectId);
		}
		else {
			errorMsg('ProjectCtrl','createProject()','Did not insert project correctly');
		}
	}

	public function updateProject($id, int $image_size, int $customer_id, int $enabled, string $name) {
		if ($id > 0) {
			if (!empty($this->mDB->getProject()) {
				$this->mDB->updateProject($id, $image_size, $customer_id, $enabled, $name);
				$this->mDB->getProject($id);
			}
			else {
				errorMsg('ProjectCtrl','createProject()','Project with ' + $id + ' was not found');
			}
		}
		else {
			errorMsg('ProjectCtrl','createProject()','Invaled id');
		}
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
