<?php 
session_start();
include('conexao.php');

$nm_loja = mysqli_real_escape_string($conexao, $_POST['nm_loja']);
$nm_responsavel = mysqli_real_escape_string($conexao, $_POST['nm_responsavel']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);


if(empty($_POST['nm_loja']) || empty($_POST['nm_responsavel']) || empty($_POST['email'])|| empty($_POST['endereco'])) {
    $_SESSION['dado_vazio'] = true;
    header('Location: lojas.php');
    exit();
}


$sql = "INSERT INTO lojas (nome,nome_responsavel,endereco,email,verificar_pagamento) VALUES ('$nm_loja','$nm_responsavel','$endereco','$email','pendente')";

if($conexao->query($sql) ===  TRUE){
    $_SESSION['loja_cadastrada'] =  true;
}else{  
    $_SESSION['erro_loja'] = true;
    header("Location: lojas.php");
}

$conexao->close();

header('Location: lojas.php');
exit;

?>