<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    
</head>

<body>
    
    <div class="container">
    <div class="row">

        <div class="col-lg-2">
            <h2>Cadastro</h3>
            <br>

            <form method= "POST" action = "cadastro.php">
                <div class="form-group">                 
                    <input class="form-control" type="text" name="nome" placeholder="Informe seu nome" required>
                    <div class="underline"></div>
                </div>

                <div class="form-group">                    
                    <input class="form-control" type="email" name="usuario" placeholder="Informe seu e-mail"required>
                    <div class="underline"></div>
                </div>


                <div class="form-group">                
                    <input class="form-control"style="margin-top: 25px;" type="number" name="telefone" placeholder="Informe seu telefone"required>
                    <div class="underline"></div>
                </div>


                <div class="form-group">                 
                    <input class="form-control"style="margin-top: 25px;" type="text" name="endereco" placeholder="Informe seu endereço"required>
                    <div class="underline"></div>
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" style="margin-top: 25px;" name="senha" placeholder="Informe sua senha" required>
                    <div class="underline"></div>
                </div>

  
                <button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>

                <a href="formulario_login.php" type="button">Login</a>

                <?php
                    if(isset($_SESSION['usuario_cadastrado'])):
                ?>

                <div name="msg_usuario"> Usuário cadastrado com sucesso </div>

                <?php
                    unset($_SESSION['usuario_cadastrado']);
                    endif;
                ?>
                
                <?php
                    if(isset($_SESSION['usuario_existente'])):
                ?>

                <div name="msg_email">Email Já Cadastrado</div>

                <?php
                    unset($_SESSION['usuario_existente']); 
                    endif;
                ?>

               
            </form>
        
        </div>
    </div>
</div>
</body>
</html>
