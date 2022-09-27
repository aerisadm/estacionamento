<?php
session_start();
include "conexao.php";
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Estacionamento</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../CSS/style.css" rel="stylesheet">

</head>

<body> 

  <div class="container">

    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="bi me-2" width="60" height="44" role="img" aria-label="Bootstrap" src="../images/carro.png"></img>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="main.php" class="nav-link px-2 link-secondary">Início</a></li>
        <li><a href="carro_cadastro.php" class="nav-link px-2 link-dark">Cadastrar</a></li>
        <li><a href="vagas_lista.php" class="nav-link px-2 link-dark">Vagas</a></li>
        <li><a href="listar_carro.php" class="nav-link px-2 link-dark">Seu Carro</a></li>

      </ul> 

 <?php 
                
         if (isset($_SESSION['usuario'])){

              $usuario = $_SESSION['usuario'];

              $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
              $resultado = mysqli_query($conexao,$sql);
               
               while ($dados = mysqli_fetch_array($resultado))
               {
                 $_SESSION['nome'] = $dados['nome']; 
               }



              if ($_SESSION['usuario'] != "admin@ifsp.edu.br"){             
                     echo ' <div class="dropdown">
                          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            '.$_SESSION['nome'].' 
                          </a>

                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="../php/login/logout.php">Sair</a></li>
                          </ul>
                        </div>';
             }
           if (isset($_SESSION['admin'])){
                  echo '
                       <div class="dropdown">
                          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                          </a>

                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="../php/lojas.php">Lojas</a></li>
                            <li><a class="dropdown-item" href="../php/login/logout.php">Sair</a></li>
                          </ul>
                        </div>';
                }
            }
              else{
                     echo '<div class="col-md-3 text-end">
                             <a href="../php/login/formulario_cadastro.php"><button type="button" class="btn btn-outline-primary me-2">Registrar-se</button></a>
                             <a href="../php/login/formulario_login.php"><button type="button" class="btn btn-primary">Entrar</button></a>
                           </div>';                 
           }  
         ?>
    </header>
  </div>

   

<div style="padding: 10px;" class="container">

    <h1 class="text-center" style="margin: 50px;">Lojas Parceiras</h1>

    <table class="table">

        <tr>
            <th>ID_Loja</th>
            <td>Nome</td>
            <td>Dono</td>
            <td>Email</td>
            <td>Endereço</td>
            <td>Total</td>          
            <td>Pagamento</td>

        </tr>
    
       
        <?php 

        $sql = "SELECT * FROM lojas";
    	$result = mysqli_query($conexao,$sql); 

   		 while($dado = $result->fetch_array()){ ?>
        
        <form method='POST'>
        <tr>

        <td>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input type="text" readonly="" name="id" value="<?php echo $dado['id_loja'] ?>" class="form-control"  aria-describedby="basic-addon1">
            </div>
        </td>

        <td>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input readonly="" type="text" name="usuario" value="<?php echo $dado['nome'] ?>" class="form-control" aria-describedby="basic-addon1">
            </div>
        </td>

        <td>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input readonly="" type="text" name="usuario" value="<?php echo $dado['nome_responsavel'] ?>" class="form-control" aria-describedby="basic-addon1">
            </div>
        </td>

        <td>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input readonly="" type="text" name="usuario" value="<?php echo $dado['email'] ?>" class="form-control" aria-describedby="basic-addon1">
            </div>
        </td>


        <td>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input readonly="" type="text" name="usuario" value="<?php echo $dado['endereco'] ?>" class="form-control" aria-describedby="basic-addon1">
            </div>
        </td>

        <td>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input readonly="" type="text" name="usuario" value="<?php echo $dado['pago_loja'] ?>" class="form-control" aria-describedby="basic-addon1">
            </div>
        </td>

        <td>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input readonly="" type="text" name="usuario" value="<?php echo $dado['verificar_pagamento'] ?>" class="form-control" aria-describedby="basic-addon1">
            </div>
        </td>

             <td><?php echo "<a class='btn btn-danger' href='remove.php?id=" . $dado['id_loja'] . "' >Excluir</a>";?></td>
             <td><?php echo "<a class='btn btn-success' href='pagar_loja.php?id=" . $dado['id_loja'] . "' >Pagar</a>";?></td>
       </tr>
        </form>
        <?php }?>
    </table>

<?php 

 if (isset($_SESSION['sucesso'])) {
?> 

<div style="width:100%;" class="badge bg-success">Sucesso</div>


<?php } unset($_SESSION['sucesso']); 

?>

<?php 

 if (isset($_SESSION['erro'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Erro</div>


<?php } unset($_SESSION['erro']); 

?>



</div>

<div class="container">

 	<form method="POST" action="cad_loja.php">

  <h1 class="text-center" style="margin: 50px;">Cadastre Uma Loja</h1>

 <div class="input-group">

    <span class="input-group-text">Nome Loja</span>
    <input class="form-control" type="text" name="nm_loja">

    <span class="input-group-text">Nome Responável</span>
    <input class="form-control" type="text" name="nm_responsavel">

  </div>

  <div style="margin-top:10px;" class="input-group">

    <span  class="input-group-text">Email</span>
    <input class="form-control" type="email" name="email">

     <span class="input-group-text">Endereço</span>
    <input class="form-control" type="text" name="endereco">

  </div>

      <button style="width: 100%;margin-top:10px;" class="btn btn-success" type="submit" name="submit">Cadastrar</button> 

</form>
<?php 

 if (isset($_SESSION['loja_cadastrada'])) {
?> 

<div style="width:100%;" class="badge bg-success">Loja Cadastrada</div>


<?php } unset($_SESSION['loja_cadastrada']); 

?>
<?php 

 if (isset($_SESSION['dado_vazio'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Insira Todos Os Dados</div>


<?php } unset($_SESSION['dado_vazio']); 

?>

<?php 

 if (isset($_SESSION['erro_loja'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Erro</div>


<?php } unset($_SESSION['erro_loja']); 

?>


<div class="container">

  <footer class="py-3 my-4">
    <p class="text-center text-muted">&copy; 2021 Estacionamento, IFSP</p>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../js/javascript.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
    