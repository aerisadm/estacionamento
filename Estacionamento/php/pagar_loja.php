<?php 
session_start();
include "conexao.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)){
	$sql = "UPDATE lojas SET pago_loja = '0.00', verificar_pagamento = 'pago' WHERE id_loja = '$id'";
	$result = mysqli_query($conexao, $sql);
	if(mysqli_affected_rows($conexao)){
		$_SESSION['sucesso'] = true;
		header("Location: lojas.php");
	}else{
	
		$_SESSION['erro'] = true;
		header("Location: lojas.php");
	}
}else{	
	$_SESSION['erro'] = true;
	header("Location: lojas.php");
}


 ?>