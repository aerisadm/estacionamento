<?php 
session_start();
include_once("../conexao.php");
?>
<?php

   echo $_SESSION['usuario'];
   echo 'teste';

if(isset($_SESSION['usuario'])){
   echo $_SESSION['usuario'];
$usuario = $_SESSION['usuario'];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexao,$sql);
 
 while ($dados = mysqli_fetch_array($resultado))
 {
   $_SESSION['nome'] = $dados['nome'];
   echo $_SESSION['nome'];
    echo $_SESSION['usuario'];
 }

 mysqli_close($conexao);

}


 ?>