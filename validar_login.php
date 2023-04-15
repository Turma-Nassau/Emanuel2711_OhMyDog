<?php 
	session_start();
	
	class Conexao{

		private $host = 'localhost';
		private $bd_name = 'bd_teste';
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
				echo 'Erro de nº: '.$e->getCode().' Mensagem: '.$e->getMessage();
			}
		
		}

	}

	$conexao = new Conexao();

	$conexao->conectar();

	class AtribuirBD{
		private $conexao = null;

		public function __construct($conexao){
			$this->conexao = $conexao->conectar();

		}

		public function recuperar(){ //read = select
			$query = "select id_usuario, email, senha, nome from tbl_usuario";

			$stmt = $this->conexao->query($query);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

		
	}

	$atribuir = new AtribuirBD($conexao);

	$dados = $atribuir->recuperar();

	$id_usuario = null;
	$perfil_usuario = null;
	$nome_usuario = null;
	$usuario_autenticado = false;
	foreach ($dados as $valor) {
		
		if ($valor['email'] == $_POST['email'] && $valor['senha'] == $_POST['senha']) {
			
			$usuario_autenticado = true;
			$id_usuario = $valor['id_usuario']; 
			$nome_usuario = $valor['nome'];
			print_r($valor);
		}
	}

	//verifica se a variavel possui o valor true. Se sim:
	if ($usuario_autenticado) {
		$_SESSION['autenticado'] = 'sim';
		$_SESSION['id_u'] = $id_usuario;
		$_SESSION['perfil_u'] = $perfil_usuario;
		header('location: index.php'); //encaminha para a prox página
	}else{
		$_SESSION['autenticado'] = 'nao';
		header('location: login.php?login=erro');
	}
?>