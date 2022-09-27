<?php
session_start();
include("../conexao.php");

$nome = mysqli_real_escape_string($conexao,trim($_POST['nome']));
$usuario = mysqli_real_escape_string($conexao,trim($_POST['usuario']));
$endereco = mysqli_real_escape_string($conexao,trim($_POST['endereco']));
$telefone = mysqli_real_escape_string($conexao,trim($_POST['telefone']));
$senha = mysqli_real_escape_string($conexao,trim(md5($_POST['senha'])));

$sql = "select count(*) as total from usuarios where usuario = '$usuario'";
$result = mysqli_query($conexao,$sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1 ){
    $_SESSION['usuario_existente'] = true;
    header("Location: formulario_cadastro.php");
    exit;
}

$sql = "INSERT INTO usuarios (usuario,senha,nome,endereco,telefone) VALUES ('$usuario','$senha','$nome','$endereco','$telefone')";

if($conexao->query($sql) ===  TRUE){
    $_SESSION['usuario_cadastrado'] =  true;
}

$conexao->close();

header('Location: formulario_cadastro.php');
exit;

?>