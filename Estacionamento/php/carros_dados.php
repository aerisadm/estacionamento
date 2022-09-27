<?php
session_start();
include_once("conexao.php");

$placa = $_POST['placa'];

 if (!$placa){
    $_SESSION['placa_vazia'] = true;
    header('Location: listar_carro.php');
    exit;
}

$sql = "select count(*) as total from carros where placa_carro = '{$placa}'";
$result = mysqli_query($conexao,$sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 0 ){
    $_SESSION['carro_inesistente'] = true;
    header("Location: listar_carro.php");
    exit();
}

$sql = "SELECT * FROM carros WHERE placa_carro = '$placa'";
$resultado = mysqli_query($conexao,$sql);
 
 while ($dados = mysqli_fetch_array($resultado))
 {
   $_SESSION['valor_total'] = $dados['valor_total']; 
   $_SESSION['verificar_pagamento'] = $dados['verificar_pagamento']; 
   $_SESSION['vaga_id'] = $dados['vaga_id'];
   $_SESSION['id_carro'] = $dados['id_carro'];
   $_SESSION['placa'] = $dados['placa_carro'];
   $_SESSION['modelo'] = $dados['modelo'];
   $_SESSION['cor'] = $dados['cor'];
   $_SESSION['marca'] = $dados['marca'];
   $_SESSION['data_entrada'] = $dados['data_entrada'];
   $_SESSION['data_saida'] = $dados['data_saida'];
   header('Location: listar_carro.php');
 }

 mysqli_close($conexao);

?>

