<?php
// Includes
require_once('../classes/modelLayer/customer.php');
require_once('../classes/dbLayer/customerDB.php');

class CustomerCtrl {
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
		$this->mDB = new CustomerDB();

		// Validering af JWT samt rettigheder
		// TBD
	}

	public function getCustomer($id)	{
		errorMsg('CustomerCtrl','function not implemented!');
	/*
		$result = $this->mDB->getCustomer($id);
	    if (!empty($result)) {
			$this->data['result']['customers'] = $result;
		}
		*/
	}

	public function getCustomers() {
		$toReturn = array();
		
		if (sizeof($toReturn) < 1) {
			errorMsg('projectDB','getCustomer','couldnt find any customers');
		}
		else {
			$toReturn['result']['customers'] = $this->mDB->getCustomers();
			array_push($this->data, $toReturn);
		}
	}

	public function createCustomer($email, $passwd) {
		errorMsg('CustomerCtrl','function not implemented!');
	/*
		
		if ((empty($email) || strpos($email, '@')) !== TRUE){
			errorMsg('projectDB','createCustomer','email was not valid');
		}
		else
		{
			$toReturn = array();
			$date = date('m/d/Y h:i:s a', time());

			$customer = new Customer($email);
			$customer->setCreated = $date;
			$customer->setLastAccess = $date;
			$customer->setEmail($email);

			//Just initiated it with some values.s
			$customer->setEnabled = TRUE;
			$customer->setHash = null;
			$customer->setSalt = null;

			$this->mDB->createCustomer();

			array_push($this->data, $toReturn);
		}
		*/
	}

	public function updateCustomerEmail($id, $email, $passwd) {
		errorMsg('CustomerCtrl','function not implemented!');
	/*
		if (empty($email) || strpos($email, '@') !== TRUE) {
			errorMsg('projectDB','createCustomer','email was not valid');
		}
		else {
			$toReturn = array();
			$customer = $this->mDB->getCustomer($id);
			$customer->setEmail($email);
			$this->mDB->updateCustomer($customer);
		}
		*/
	}


	public function removeCustomer($id) {
		errorMsg('CustomerCtrl','function not implemented!');
		/*
		$toReturn = array();
		$this->mDB->removeCustomer($customer);
		*/
	}
}
?>
