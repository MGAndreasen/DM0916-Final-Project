<?php
// Includes
require_once('../classes/dbLayer/customerDB.php');
require_once('../classes/modelLayer/customer.php');

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
		$toReturn = array();

		$toReturn['customer'] = $this->mDB->getCustomer($id);
		
		if (sizeof($toReturn) < 1) {
			errorMsg('projectDB','getCustomer','couldnt find customer')
		}
		else {
			array_push($this->data, $toReturn);
		}
	}

	public function getCustomers($customerID) {
		$toReturn = array();
		
		if (sizeof($toReturn) < 1) {
			errorMsg('projectDB','getCustomer','couldnt find any customers');
		}
		else {
		$toReturn['customers'] = $this->mDB->getCustomers();
		array_push($this->data, $toReturn);		
		}


	}

	public function createCustomer($email) {
		
		if (empty($email) || strpos($email, '@') !== TRUE){
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

		//Just initiated it with some values.
		$customer->setEnabled = TRUE;
		$customer->setHash = null;
		$customer->setSalt = null;

		$this->mDB->createCustomer();

		array_push($this->data, $toReturn);
		}
		

	}

	public function updateCustomerEmail($id, $email) {
		if (empty($email) || strpos($email, '@') !== TRUE){
			errorMsg('projectDB','createCustomer','email was not valid');
		}
			else {
			$toReturn = array();
			$customer = $this->mDB->getCustomer($id);
			$customer->setEmail($email);
			$this->mDB->updateCustomer($customer);
			array_push('ok');
		}
	}


	public function removeCustomer($id) {
		$toReturn = array();
		$this->mDB->removeCustomer($customer);
		array_push('ok');
	}
}
?>
