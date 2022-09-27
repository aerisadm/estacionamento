<?php
session_start();
include('../conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: formulario_login.php');
	exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select * from usuarios where usuario = '{$usuario}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {

	$usuario = mysqli_fetch_assoc($result);
	$_SESSION['usuario'] = $usuario['usuario'];

	if (isset($_SESSION['usuario'])){
      if ($_SESSION['usuario']=="admin@ifsp.edu.br"){
      	  $_SESSION['admin'] = true;
          header('Location: ../main.php');
        }
      else{ 
      		$_SESSION['nome'] = $usuario['nome'];
          header('Location: ../main.php');
        }
 	}	
		exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: formulario_login.php');
	exit();
}


?>