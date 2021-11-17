<?php
include 'db_config.php';

class CDB
{
	private $mysql;

	/**
	 * connects to db
	 */
	public function connect(): void
	{
		global $config;

		$this->mysql = new mysqli($config["DBHost"], $config["DBLogin"], $config["DBPassword"], $config["DBName"])
		or die("Couldn't connect");
	}

	/**
	 * disconnects to db
	 */
	public function disconnect(): void
	{
		$this->mysql->close() or die("There was a problem disconnecting from the database.");
	}

	/**
	 * executes given query
	 * @param string $sql query to be executed
	 */
	public function executeQuery(string $sql)
	{
		$result = $this->mysql->query($sql) or die("Couldn't execute query!!");
		return $result;
	}
}
