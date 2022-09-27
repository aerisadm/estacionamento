 <?php 
session_start();
include('conexao.php');

$placa = mysqli_real_escape_string($conexao, $_POST['placa']);
$modelo = mysqli_real_escape_string($conexao, $_POST['modelo']);
$cor = mysqli_real_escape_string($conexao, $_POST['cor']);
$marca = mysqli_real_escape_string($conexao, $_POST['marca']);
$vaga_id = mysqli_real_escape_string($conexao, $_POST['vaga_id']);


if(empty($_POST['placa']) || empty($_POST['modelo']) || empty($_POST['marca'])|| empty($_POST['cor'])) {
    $_SESSION['dado_vazio'] = true;
    header('Location: carro_cadastro.php');
    exit();
}
if(empty($_POST['vaga_id'])) {
    $_SESSION['vaga_vazia'] = true;
    header('Location: carro_cadastro.php');
    exit();
}

$sql = "select count(*) as total from carros where placa_carro = '{$placa}' AND verificar_pagamento = 'pendente'";
$result = mysqli_query($conexao,$sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1 ){
    $_SESSION['carro_existente'] = true;
    header("Location: carro_cadastro.php");
    exit();
}

$sql = "INSERT INTO carros (vaga_id,placa_carro,modelo,cor,marca,verificar_pagamento) VALUES ('$vaga_id','$placa','$modelo','$cor','$marca','pendente')";

if($conexao->query($sql) ===  TRUE){

    $sql = "UPDATE vagas SET vaga_tipo = 'vaga_com_carro.png' WHERE vaga_id = '{$vaga_id}'";
    
    if($conexao->query($sql) === TRUE){
    $_SESSION['carro_cadastrado'] =  true;
}}

$conexao->close();

header('Location: carro_cadastro.php');
exit;

?>