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
			return null;
		}

		return $this->connection;
	}

	public function getError()
	{
		if ($this->connection->connect_errno) {
            echo '<br/>', 'Error: Unable to connect to Database.' , '<br>';
            echo "Debugging errno: " .  $this->connection->connect_errno , '<br>';
            echo "Debugging error: " .  $this->connection->connect_error , '<br>';
            unset($this->connection);
        }
	}

	public function closeConnection()
	{
		$this->connection->close();
		unset($this->connection);
	}
}
?>