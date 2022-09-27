<?php 
session_start();
 ?>


<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="style.css" rel="stylesheet">

  </head>


    
<body>
    
    <div class="container">
        <div class="row">
            

            <div class="col-lg-2">

             <h2>Login</h2>
                <br>

                <form method= "POST" action = "login.php">
                
                   
                    <div class="form-group">
                        <label for="email"></label>
                        <input class="form-control" type="email" name="usuario" placeholder="Informe seu e-mail" required>
                        <div class="underline"></div>
                    </div> 
 
                    <div class="form-group">
                        <label for="senha"></label>
                        <input class="form-control" type="password" name="senha" placeholder="Informe sua senha" required>
                        <div class="underline"></div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="cadastrar">Entrar</button>
                    <a href="formulario_cadastro.php">Ainda não é inscrito? Cadastre-se!</a>
                 
                     <a href="../main.php" type="button">Estacionamento</a>
                </form>           
                
                <?php
                if(isset($_SESSION['nao_autenticado'])):
                ?>

                <div name="mensagem"> Usuário ou senha inválidos </div>
              
                <?php
                endif;
                unset($_SESSION['nao_autenticado']);
                ?>

            </div>
            

            <div class="col"></div>
        </div>
    </div>

    
  </body>
</html>
