<?php 
//Realiza a conexão com o banco de dados
//e se caso não houver o email cadastrado no bd ele retorna para a página e informa o erro

	class Conexao{
		private $host = 'localhost';
		private $bd_name = 'bd_aplication';
		private $usuario = 'root';
		private $senha = '';

		public function conectar(){

			try{			
				$conexao = new PDO(
					"mysql:host=$this->host;dbname=$this->bd_name",
					"$this->usuario",
					"$this->senha"
				);

				return $conexao;

			}catch(PDOException $e){
				echo '<p> Erro de nº: '.$e->getCode().'<br>Mensagem: '. $e->getMessage().'<p>';
			}
		}	
	}
?>

<?php
	if (isset($_GET['email']) && $_GET['email'] == 'notfound') {
		echo '<div>Email não cadastrado</div>';
	}
?>

