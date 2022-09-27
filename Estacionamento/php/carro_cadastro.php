<?php 
session_start();
include('conexao.php');
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

 	<form method="POST" action="cad_carro.php">

  <h1 class="text-center" style="margin: 50px;">Cadastre Seu Carro</h1>

  <div class="input-group">

    <span class="input-group-text">Placa</span>
    <input class="form-control" type="text" name="placa">

    <span class="input-group-text">Modelo</span>
    <input class="form-control" type="text" name="modelo">

  </div>

  <div style="margin-top:10px;" class="input-group">

    <span  class="input-group-text">Cor</span>
    <input class="form-control" type="text" name="cor">

     <span class="input-group-text">Marca</span>
    <input class="form-control" type="text" name="marca">

  </div>


    

  <h1 class="text-center" style="margin: 50px;">Escolha Uma Vaga</h1>
    

   <div class="container row mb-3 text-center">

      <?php 

      $sql = "SELECT * FROM vagas ORDER BY vaga_id";
      $query = mysqli_query($conexao,$sql);
      $dados = mysqli_num_rows($query);

      if($dados>0){   
        
        for ($i = 0; $i <7; $i++) {

        $dados = mysqli_fetch_array($query); 

        $img_src = $dados['vaga_tipo'];

        if ($img_src == "vaga_sem_carro.png") {
        
      ?>

    <div class="image col-3">

      <div class="img-thumbnail imgBox" data-selected="<?php echo $dados['vaga_id'];?>">
          <img src="<?php echo '../Images/'.$img_src; ?>"/>
      </div>

       <div><?php echo $dados['vaga_id'];?></div>

     </div>

      
      <?php }}}?> 

     <input hidden="" type="text" name="vaga_id" class="imgSelecionada">
    </div>

     <button style="width: 100%" class="btn btn-success" type="submit" name="submit">Estacionar</button> 

 	</form>


<?php 
 if (isset($_SESSION['dado_vazio'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Insira Todos Dados</div>


<?php } unset($_SESSION['dado_vazio']); 

?>

<?php 
 if (isset($_SESSION['carro_cadastrado'])) {
?> 

<div style="width:100%;" class="badge bg-success">Carro Cadastrado</div>


<?php } unset($_SESSION['carro_cadastrado']); 

?>



<?php 
 if (isset($_SESSION['vaga_vazia'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Selecione Uma Vaga</div>


<?php } unset($_SESSION['vaga_vazia']); 

?>

<?php 
 if (isset($_SESSION['carro_existente'])) {
?> 

<div style="width:100%;" class="badge bg-danger">Carro Existente</div>


<?php } unset($_SESSION['carro_existente']); 

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 
   <script src="../js/javascript.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
      
      $(function() {
    $('.img-thumbnail').on('click', function() {
        var $imgSelected = $(this).attr("data-selected")
        
        $('.img-thumbnail').removeClass('ativo');
        $(this).addClass('ativo');
        
        $('#imgSelecionada').html('<b>' + $imgSelected + '</b> selecionada');
        $('.imgSelecionada').val($imgSelected);
    });
});

    </script>




  </body>
</html>