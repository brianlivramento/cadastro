<?php

class Connection {
	
	private $_connection;
	private static $_instance; 
	
	/* Local */
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "root";	
	private $_database = "sist_cadastro";

	public static function getInstance() {
		if(!self::$_instance) { 
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);

		if(mysqli_connect_error()) {
			trigger_error("Nao consegui conectar: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}

	private function __clone() { }

	public function getConnection() {
		return $this->_connection;
	}
}
