<?php
// Includes
require_once('../classes/util/utils.php');
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

	public function getCustomer($id) {
		$result = $this->mDB->getCustomer($id);
	    if (!empty($result)) {
			$this->data['result']['customers'] = $result;
		}
	}

	public function getCustomers() {
		$result = $this->mDB->getCustomers();

	    if (!empty($result)) {
			$this->data['result']['customers'] = $result;
		}
	}

	public function createCustomer($email, $passwd)	{
		if(!empty($email) && !empty($passwd)) {
			if(strpos($email, '@')) { // fix bedre tjek

				$email = strtolower($email);

				$checkExists = $this->mDB->getCustomerFromEmail($email);
				
				if(empty($checkExists)) { // findes ikke
					// ikke f�rdig imp
					$hash_type = "whirlpool";
					$salt_type = "sha512";								// anden algo
					$site_salt = "5d41402abc4b2a76b9719d911017c592";	// fra Config Array, burde det vaere....
					$randomString = createRandomString(128,"0123456789SomOmJegOrkerAtFindePaaFlereEndDisseABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz".$email); // CHAR(128)  createRandomString(length,"POOLofCHaRsWeCANMixFrom")

					$salt = hash($salt_type, $randomString, false); // CHAR(128) hash af CHAR(128) randomString inkl. af brugers originale email ved oprettelse
					$hash = hash($hash_type, $salt.$passwd.$site_salt,false);  // CHAR(128) af vores unique generede $salt forhaabentlig + brugers indtastet password + den globale salt for hele sitet.

					// Senere til at loggeind igen:
					// 1) find email i db, og retuner salt samt hash
					// 2) hash($hash_type, salt_fra_db . indtastet_password . salt_fra_site_salt);
					// 3) sammenlign resultatet med hash_fra_db, er de ens har man tastet korrekt password, ellers ikke!

					$newCustomerId = $this->mDB->createCustomer($email, $hash, $salt);

					if ($newCustomerId > 0) { // Lets try and fetch
						$this->getCustomer($newCustomerId);
					}
					else { errorMsg('CustomerCtrl','createCustomer()','returned no result'); }
				} else { errorMsg('CustomerCtrl','createCustomer','bruger med denne Email findes allerede'); }
			} else { errorMsg('CustomerCtrl','createCustomer()','Invalid email'); }
		} else { errorMsg('CustomerCtrl','createCustomer()','Missing email or password'); }
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
