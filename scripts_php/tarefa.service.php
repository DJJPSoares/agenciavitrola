<?php

	//CRUD
	class TarefaService {

		private $conexao;
		private $tarefa;

		public function __construct(Conexao $conexao, Tarefa $tarefa) {
			$this->conexao = $conexao->conectar();
			$this->tarefa = $tarefa;
		}

		public function inserir() { //creat
			$query = 'insert into contato(nome, email, celular, assunto, mensagem, dataabertura, ip)values(:nome, :email, :celular, :assunto, :mensagem, :dataabertura, :ip)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
			$stmt->execute();
		}
		
	}

?>