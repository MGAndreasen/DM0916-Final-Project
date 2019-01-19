<?php
// Includes
require_once('../classes/modelLayer/customer.php');

class CustomerDB
{
	private $getCustomer_SQL				= 'SELECT * FROM customer WHERE id = ?';
	private $getCustomers_SQL				= 'SELECT * FROM customer';
	//private $createCustomer_SQL				= 'INSERT INTO customer VALUES(:enabled, :hash, :salt, :created, :last_access, :email)';
	//private $updateCustomer_SQL				= 'UPDATE customer SET enabled = :enabled, hash = :hash, salt = :salt, created = :created, last_access = :lastAcess, email = :email WHERE id = :id';
	//private $deleteCustomer_SQL				= 'DELETE FROM customer WHERE id = :id';

	public function __construct()
	{
	}

	/*
	public function getCustomer($customerID) {
		global $conn;
		$resultArr = [];
		$query = $conn->prepare($this->$getCustomer_SQL);
		$query->bind_param('i', $customerID);
		$query->execute();
		$result = $query->get_result();
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$customer = new Customer($row['id'], $row['enabled'], $row['hash'], $row['salt'], $row['created'], $row['last_access'], $row['email']);
			array_push($resultArr, $customer);
		}
		else { errorMsg('customerDB','getCustomer','couldnt find any customer with that ID'); }
		return resultArr;
	}
	*/

	public function getCustomers() {
		global $conn;
		$resultArr = [];

		$query = $conn->prepare($this->getCustomers_SQL);
		$query->execute();
		$result = $query->get_result();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
					$customer = new Customer($row['id'], $row['enabled'], $row['hash'], $row['salt'], $row['created'], $row['last_access'], $row['email']);
					array_push($resultArr, $customer);
			}
		}
		else {
			errorMsg('CustomerDB','getCustomer() no customers found!');
		}

		return $resultArr;
	}

	/*
	public function updateCustomer($customer){
		global $conn;
		$query = $conn->prepare($this->$updateCustomer_SQL);
		$query->bind_param(':id', $customer->getID());
		$query->bind_param(':enabled', $customer->getEnabled());
		$query->bind_param(':hash', $customer->getHash());
		$query->bind_param(':salt', $customer->getSalt());
		$query->bind_param(':created', $customer->getCreated());
		$query->bind_param(':last_access', $customer->getLastAccess());
		$query->bind_param(':email', $customer->getEmail());
		$query->execute();
		$result = $query->get_result();

		//Not quite sure on this one for handling error msges.
		if ($result == FALSE) {
			return 'error: couldnt execute ' + $updateCustomer_SQL + ' on id ' + $id;
		}
		else {
			return 1; 
		}
	}
	*/

	/*
	public function createCustomer($customer){
		global $conn;
		$query = $conn->prepare($this->$createCustomer_SQL);
		$query->bind_param(':enabled', $customer->getEnabled());
		$query->bind_param(':hash', $customer->getHash());
		$query->bind_param(':salt', $customer->getSalt());
		$query->bind_param(':created', $customer->getCreated());
		$query->bind_param(':last_access', $customer->getLastAccess());
		$query->bind_param(':email', $customer->getEmail());
		$query->execute();
		$result = $query->get_result();
		
		//Not quite sure on this one for handling error msges.
		if ($result == FALSE) {
			return 'error: couldnt execute ' + $createCustomer_SQL + ' on email ' + $customer->getEmail();
		}
		else {
			return 1; 
		}
	}
	*/

	/*
	public function deleteCustomer($customer){
		$query = $conn->prepare($this->$deleteCustomer_SQL);
		$query->bind_param(':id', $customer->getID());
		$query->execute();
		$result = $query->get_result();

		if ($result == FALSE) {
			return 'error: couldnt execute ' + $deleteCustomer_SQL + ' on id ' + $id;
		}
		else {
			return 1; 
		}
	}
	*/
}
?>