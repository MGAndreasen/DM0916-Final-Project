<?php
// Includes
require_once('../classes/modelLayer/customer.php');

class CustomerDB
{
	private $getCustomer_SQL				= 'SELECT * FROM customer WHERE id = ?';
	private $getCustomers_SQL				= 'SELECT * FROM customer';
	private $createCustomer_SQL				= 'INSERT INTO customer VALUES(null, 1, ?, ?, now(), now(), ?)';
	private $deleteCustomer_SQL				= 'DELETE FROM customer WHERE id = ?';

	public function __construct()
	{
	}

	public function getCustomer($customer_id) {
		global $conn;
		$resultArr = [];

		$query = $conn->prepare($this->getCustomer_SQL);
		$query->bind_param('i', $customer_id);
		$query->execute();

		$result = $query->get_result();

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$customer = new Customer($row['id'], $row['enabled'], $row['hash'], $row['salt'], $row['created'], $row['last_access'], $row['email']);
			array_push($resultArr, $customer);
		}
		else { errorMsg('CustomerDB','getCustomer()','did not find any customer with that ID'); }
		return $resultArr;
	}

	public function getCustomerFromEmail($email) {
		global $conn;
		$resultArr = [];

		$query = $conn->prepare($this->getCustomerFromEmail_SQL);
		$query->bind_param('s', $email);
		$query->execute();

		$result = $query->get_result();

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$customer = new Customer($row['id'], $row['enabled'], $row['hash'], $row['salt'], $row['created'], $row['last_access'], $row['email']);
			array_push($resultArr, $customer);
		}
		else { errorMsg('CustomerDB','getCustomerFromEmail()','did not find any customer with that Email'); }
		return $resultArr;
	}

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
			errorMsg('CustomerDB','getCustomers()', 'no customers found!');
		}

		return $resultArr;
	}

	public function createCustomer($email, $hash, $salt) {
		global $conn;
		$conn->begin_transaction();

		$query = $conn->prepare($this->createCustomer_SQL);
		$query->bind_param('sss', $hash, $salt, $email);
		$query->execute();
		$result = $query->get_result();

		$id = $conn->insert_id;

		$conn->commit();

		return $id;
	}


	public function deleteCustomer($id) {
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
}
?>