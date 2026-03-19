<?php

	class Conexao {

		private $host = 'localhost';
		private $dbname = 'u937895940_agvtr';
		private $user = 'root';
		private $pass = '1aA@3467985';

		public function conectar() {
			try {

				$conexao = new PDO(
					"mysql:host=$this->host;dbname=$this->dbname",
					"$this->user",
					"$this->pass"
				);

				return $conexao;

			} catch (PDOException $e) {
				echo '<p>'.$e->getMessege().'</p>';
			}
		}
	}

?>