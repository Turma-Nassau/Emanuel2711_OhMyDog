<?php 
// Verifica a autenticação do usuario e em caso de erro encaminha para a página de origem dando um retorno do erro!
// Nesse caso, a página de login, o suário só consiguirá acessar determinada página se a sessão do usuario for autenticada
  session_start();
  if (  !isset($_SESSION['autenticado']) || $_SESSION['autenticado'] == 'nao') {
    header('location: login.php?login=erro');
  }
?>

