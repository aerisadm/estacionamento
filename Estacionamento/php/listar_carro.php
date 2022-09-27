<?php 
session_start();
include ('conexao.php');
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

<div class="container">


<h1 class="text-center" style="margin: 50px;">Digite A Placa Do Seu Carro</h1>

<table style="margin-top:50px;" class="table table-dark table-striped">

<form method="POST">

 	<div class="input-group">

    <input class="form-control" type="text" name="placa">

  </div>
  <button formaction="carros_dados.php" style="width: 100%;margin-top: 10px;" class="btn btn-success" type="submit" name="submit">Pesquisar</button> 
  <div>Tarifa Única</div>

 <?php 
  $sql = "SELECT tarifa_unica FROM carros";
  $query = mysqli_query($conexao,$sql);
  $dados = mysqli_fetch_assoc($query);
  ?>

  <?php if(isset($_SESSION['admin'])){ ?>

  <div class="input-group">
    <input class="form-control" value="<?php echo $dados['tarifa_unica'] ?>" type="text" name="tarifa_unica">
  </div>
   <div>Nova Tarifa</div>
  <input class="form-control" type="text" name="nova_tarifa_unica">
 <button formaction="alterar_tarifa.php" style="width: 100%;margin-top: 10px;" class="btn btn-success" type="submit" name="submit">Alterar</button> 

<?php }else{ ?>

  <div class="input-group">
    <input class="form-control" value="<?php echo $dados['tarifa_unica'] ?>" type="text" name="tarifa_unica">
  </div>
<?php } ?>

  

    <tr class="table-dark">

      <td class="table-dark">Placa</td>
      <td class="table-dark">Modelo</td>     
      <td class="table-dark">Marca</td>
      <td class="table-dark">Cor</td>
      <td class="table-dark">Vaga</td>
      <td class="table-dark">Data Entrada</td>
      <td class="table-dark">Data Saída</td>
      <td class="table-dark">Pagamento</td>
      <td class="table-dark">Valor Total</td>
      <td></td>

    </tr>


 <!-- Placa -->

  <?php 
  if (isset($_SESSION['placa'])) {
  ?>

    <td class="table-dark">

    <div><?php echo $_SESSION['placa'];  ?></div>


    </td>

  <?php } ?>



 <!-- Modelo -->

  <?php 
  if (isset($_SESSION['modelo'])) {
  ?>

    <td class="table-dark">

    <div><?php echo $_SESSION['modelo'];  ?></div>

    </td>

  <?php } ?>

<!-- Marca -->

  <?php 
  if (isset($_SESSION['marca'])) {
  ?>

    <td class="table-dark">

    <div><?php echo $_SESSION['marca'];  ?></div>

    </td>

  <?php }?>

 <!-- Cor -->

  <?php 
  if (isset($_SESSION['cor'])) {
  ?>

    <td class="table-dark">

    <div><?php echo $_SESSION['cor']; ?></div>

    </td>

  <?php }?>

<!-- Vaga -->

  <?php 
  if (isset($_SESSION['vaga_id'])) {
  ?>

    <td class="table-dark">

      <div><?php echo $_SESSION['vaga_id']; ?></div>
      <input type="hidden" name="vaga_id" value="<?php echo $_SESSION['vaga_id']; ?>">

    </td>

    <?php }?>


<!--- data_entrada -->  

  <?php 
  if (isset($_SESSION['data_entrada'])) {
  ?>
    
    <td class="table-dark">

    <div><?php echo date($_SESSION['data_entrada']);  ?></div>

    </td>

  <?php }?>

<!--- data_entrada -->  

  <?php 
  if (isset($_SESSION['data_saida'])) {
  ?>
    
    <td class="table-dark">

    <div><?php echo date($_SESSION['data_saida']);  ?></div>

    </td>

  <?php }?>

<!--- pagamento -->  

  <?php 
  if (isset($_SESSION['verificar_pagamento'])) {
  ?>
    
    <td class="table-dark">

    <div><?php echo $_SESSION['verificar_pagamento'];  ?></div>

    </td>

  <?php } ?>

<!--- valor total -->  

  <?php 
  if (isset($_SESSION['valor_total'])) {
  ?>
    
    <td class="table-dark">

    <div><?php echo 'R$'.$_SESSION['valor_total'];  ?></div>

    </td>

  <?php }?>


<!--- id --> 

  <?php if (isset($_SESSION['id_carro'])) {?>

    <td class="table-dark">
      <input type="hidden" name="id_carro" value="<?php echo $_SESSION['id_carro']; ?>">
    </td>

  <?php }?>

   
</table>

  <select class="form-select" name="id_loja" id="id_loja">   

    <option value="" selected = selected>Loja Parceira</option>
    <?php
    $sql = "SELECT * FROM lojas";
    $dados = mysqli_query($conexao,$sql) or die(mysql_error());
    $linha = mysqli_fetch_assoc($dados);
    $total = mysqli_num_rows($dados);
    if($total > 0) {
        do {
        echo "<option value='".$linha['id_loja']."'>".$linha['nome']."</option>";
        }while($linha = mysqli_fetch_assoc($dados));
    }
    ?>
  </select>

<button formaction="pagar.php" style="width: 100%;margin-top: 10px;" class="btn btn-success" type="submit" name="submit">Pagar</button> 

</form>

<?php 
 if (isset($_SESSION['placa_vazia'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Digite a placa</div>


<?php } unset($_SESSION['placa_vazia']); 

?>

<?php 
 if (isset($_SESSION['carro_pago'])) {
?> 

<div style="width:100%;" class="badge bg-success">Pagemento feito com sucesso</div>


<?php } unset($_SESSION['carro_pago']); 

?>

<?php 
 if (isset($_SESSION['carro_erro'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Ocorreu um Erro</div>


<?php } unset($_SESSION['carro_erro']); 

?>


<?php 
 if (isset($_SESSION['carro_inesistente'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Carro não existente</div>


<?php } unset($_SESSION['carro_inesistente']); 

?>

</div>

<div class="container">

  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"></a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"></a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"></a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"></a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"></a></li>
    </ul>
    <p class="text-center text-muted">&copy; 2021 Estacionamento, IFSP</p>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../js/javascript.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>



  </body>
</html>