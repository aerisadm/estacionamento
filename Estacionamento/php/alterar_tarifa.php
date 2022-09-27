<?php 
session_start();
include "conexao.php";

$nova_tarifa_unica = mysqli_real_escape_string($conexao, $_POST['nova_tarifa_unica']); 

if(!empty($nova_tarifa_unica)){
	$sql = "UPDATE carros SET tarifa_unica = '$nova_tarifa_unica' WHERE 1";
	$result = mysqli_query($conexao, $sql);
	if(mysqli_affected_rows($conexao)){
		$_SESSION['tarifa_alterada'] = true;
		header("Location: listar_carro.php");
	}else{
	
		$_SESSION['erro'] = true;
		header("Location: listar_carro.php");
	}
}else{	
	$_SESSION['erro'] = true;
	header("Location: listar_carro.php");
}



?>