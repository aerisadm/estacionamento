<?php 
session_start();
include'conexao.php';
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
        <li><a href="#" class="nav-link px-2 link-secondary">Início</a></li>
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
<main>

  	<div class="container">

    <h1 style="margin-top: 100px;">Seja Bem Vindo</h1>
    <p class="fs-5 col-md-8">Diferentes de todos, nosso site registra todas as informações sobre o carro desde a placa à cor. Com muitas vagas em diferentes pontos do país.</p>

    <div class="mb-5">
      <a href="carro_cadastro.php" class="btn btn-success btn-lg px-4">Estacione seu carro</a>
    </div>
	</div>

    <div style="margin-top:200px"></div>
    <div class="container">

    <h1 class="text-center" style="margin: 50px;">Vagas Disponíveis</h1>
   	
  <div class="row mb-4 text-center">

      <?php   
      $sql = "SELECT * FROM vagas ORDER BY vaga_id";
      $query = mysqli_query($conexao,$sql);
      $dados = mysqli_num_rows($query);

      if($dados>0){   

        for ($i = 1; $i <= 9; $i++) {
       
        $dados = mysqli_fetch_array($query); 

        $img_src = $dados['vaga_tipo'];

        if ($img_src == "vaga_sem_carro.png") {
        
      ?>

      <div class="image col-4">

      <div class="img-thumbnail imgBox">
          <a href="carro_cadastro.php"><img src="<?php echo '../Images/'.$img_src; ?>"/></a>
      </div>

       <div><?php echo $dados['vaga_id'];?></div>

     </div>


      <?php }}}?> 

    </div>

    <a href="vagas_lista.php"><p class="text-end">Ver Todas</p></a>

	</div>

</main>


<div style="margin-top:200px"></div>

<div class="container">

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">Valores</h1>
      <p class="fs-5 text-muted">Nosso estacionamento oferece segurança para o seu carro por 24h/dia.</p>
    </div>
  </header>

  <main>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Primeira Hora/Tarifa Única</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">
            <?php 
            $sql = "SELECT tarifa_unica FROM carros";
            $query = mysqli_query($conexao,$sql);
            $dados = mysqli_fetch_assoc($query);
            ?><?php echo'R$'. $dados['tarifa_unica'] ?>
        <small class="text-muted fw-light"></small></h1>
    
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Segunda Hora Ou +</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><?php echo'R$'. $dados['tarifa_unica']/2 ?>/h+Tarifa Única</small></h1>
     
          </div>
        </div>

      </div>

      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Lojas Parceiras</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">50% De <span style="color: green;">DESCONTO</span></small></h1>
          </div>
        </div>
      </div>
               <a href="vagas_lista.php" type="button" class="w-100 btn btn-lg btn-primary">Estacionar</a>
    </div>

    </div>

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
