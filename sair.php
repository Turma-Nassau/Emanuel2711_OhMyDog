<?php
//finaliza a sessão e retorna para o index ou página desejada
	session_start();

	session_destroy();
	
	header('Location: index.php');
	
?>