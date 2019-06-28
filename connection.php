<?php
	class Connection{
		private static $instance = null;
		private $conn;

		private function __construct(){
			$server = "localhost";
			$user = "root";
			$password = "";
			$db = "usuarios";

			try{
				$this->conn = new PDO("mysql:host=$server;dbname=$db",$user,$password);

				// set the PDO error mode to exception
    				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}

			catch(PDOException $e){
				echo "Connection failed: ". $e->getMessage();
			}
		}

		public static function getInstance(){
			if(!isset(self::$instance)){
				self::$instance = new Connection();
			}
			return self::$instance->conn;
		}

		private function __wakeup(){}

		private function __sleep(){}
	}
?>
