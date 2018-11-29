<?php
class ConnectionDB
{
	private $connection = null;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
		global $config;
        $this->connection = new mysqli($config['DBHost'], $config['DBUser'], $config['DBPass'], $config['DBName']);
    }

	public function getConnection()
	{
		if($this->connection->connect_errno)
		{
			global $data;
			array_push($data,getError());
			unset($this->connection);
		}

		return $this->connection;
	}

	private function getError()
	{
		return array(
			'ERROR' => 'Unable to connect to Database.',
			'ERRNO' => $this->connection->connect_errno,
			'ERRMSG' => $this->connection->connect_error
		);
	}

	public function closeConnection()
	{
		$this->connection->close();
		unset($this->connection);
	}
}
?>