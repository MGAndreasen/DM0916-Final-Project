<?php
class ConnectionDB
{
	private connection = null;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->connection = new mysqli($config['DBHost'], $config['DBUser'], $config['DBPass'], $config['DBName']);

        if ($this->connection->connect_errno) {
            echo '<br/>', 'Error: Unable to connect to Database.' , '<br>';
            echo "Debugging errno: " .  $this->connection->connect_errno , '<br>';
            echo "Debugging error: " .  $this->connection->connect_error , '<br>';
            unset($this->connection);
            exit;
        }
    }

	public getConnection()
	{
		return $this->connection;
	}
}
?>