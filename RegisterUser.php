<?php
	require_once 'connection.php';
	
	class RegisterUser{
		private $name, $lastName, $age, $email;
		
		public function __construct ($dados){
			$this->name = $dados['name'];
			$this->lastName = $dados['lastname'];
			$this->age = $dados['age'];
			$this->email = $dados['email'];

			$this->checkUser();
		}

		private function checkUser(){
			$pdo = Connection::getInstance();

			$sql = "SELECT email FROM usuarios WHERE email = '$this->email' LIMIT 1";

			$select = $pdo->query($sql);

			$result = $select->fetch(PDO::FETCH_OBJ); // object returns

			if(!isset($result->email)){
				$this->insertUser();		
			}

			else{
				echo "There is already a registration with this email.";
			}

		}

		private function insertUser(){
			try{			
			
				$pdo = Connection::getInstance();

				$sql = "INSERT INTO usuarios (nome, sobrenome, idade, email) VALUES (?,?,?,?)";

				$stmt= $pdo->prepare($sql);

				$stmt->execute([$this->name, $this->lastName, $this->age, $this->email]);

				echo "User successfully registered";				
			}

			catch(PDOException $e){
				echo $sql . "<br>" . $e->getMessage();
			}

			$pdo = null;			
		}
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$register = new RegisterUser($_POST);
	}

?>