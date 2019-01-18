<?php
// Includes
require_once('../classes/modelLayer/project.php');
require_once('../classes/dbLayer/projectDB.php');

class ImageCtrl {
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
		$this->mDB = new ImageDB();

		// Validering af JWT samt rettigheder
		// TBD
	}

	public function getImage($id) {
		$result = $this->mDB->getImage($id);
		if(!empty($result))	{
			$this->data['result']['images'] = $result;
		}
	}

	public function getProjectImages($project_id) {
		$result = $this->mDB->getProjectImages($project_id);

		if(!empty($result))	{
			$this->data['result']['images'] = $result;
		}
	}

	public function deleteImage($id) {
		
	}
}
?>
