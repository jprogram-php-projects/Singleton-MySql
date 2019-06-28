<?php
	require_once 'connection.php';
	
	class RegisterUser{
		
		public function __construct ($dados){
			$name = $dados['nome'];
			$surname = $dados['sobrenome'];
			$age = $dados['idade'];

			try{			
			
				$pdo = Connection::getInstance();

				$sql = "INSERT INTO usuarios (nome, sobrenome, idade) VALUES (?,?,?)";

				$stmt= $pdo->prepare($sql);

				$stmt->execute([$name, $surname, $age]);

				echo "User successfully registered";				
			}

			catch(PDOException $e){
				echo $sql . "<br>" . $e->getMessage();
			}

			$stmt = null;
		}
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$register = new RegisterUser($_POST);
	}

?>