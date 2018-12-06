<?php
class ModelDB
{
	public function __construct()
	{
	}

	public function test()
	{
		global conn;
		$someData = array();

		$someData['test'] = 'Hmm';

		// mysqli, prepared statements
		$query = $conn->prepare('SELECT * FROM users WHERE username = ?');
		$query->bind_param('s', $_GET['username']);
		$query->execute();

		return $someData;
	}
}
?>