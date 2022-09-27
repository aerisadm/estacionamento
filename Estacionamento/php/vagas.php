<?php 

include'conexao.php';
 $sql = "SELECT * FROM vagas ORDER BY vaga_id";
      $query = mysqli_query($conexao,$sql);
      $dados = mysqli_num_rows($query);


 ?>