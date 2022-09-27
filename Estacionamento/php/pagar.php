<?php  
session_start();
include "conexao.php";

$id = mysqli_real_escape_string($conexao, $_POST['id_carro']);
$vaga_id = mysqli_real_escape_string($conexao, $_POST['vaga_id']);
$tarifa = mysqli_real_escape_string($conexao, $_POST['tarifa_unica']);
$id_loja = mysqli_real_escape_string($conexao, $_POST['id_loja']);

$sql = "SELECT * FROM carros WHERE id_carro = '$id'";
$query = mysqli_query($conexao,$sql);
$dados = mysqli_fetch_assoc($query);

// verificar se o carro ja foi pago e se existe o carro

if(!empty($id) && $dados['verificar_pagamento'] == 'pendente'){

		 $sql = "UPDATE vagas SET vaga_tipo = 'vaga_sem_carro.png' WHERE vaga_id = '$vaga_id'";
		 $conexao->query($sql);

		 $sql = "SELECT TIMESTAMPDIFF(HOUR,data_entrada,data_saida) as resultado FROM carros WHERE id_carro = '$id'";
		 $result = mysqli_query($conexao,$sql);
		 $dado = mysqli_fetch_assoc($result);

// verificar se passou de 1 hora e se consta uma loja afiliada

		if($dado['resultado'] > 1 && $id_loja >= 1 ){
			$valor_acrescido = $dado['resultado'];  
		    $sql = "UPDATE carros SET data_saida = NOW(),verificar_pagamento = 'pago',valor_total = '$tarifa' * 0.5 + (('$tarifa' * 0.5) * ('$valor_acrescido' - 1)) WHERE id_carro ='$id'";
		    $conexao->query($sql);
		    $sql = "UPDATE lojas SET pago_loja = pago_loja + ('$tarifa' * 0.5), verificar_pagamento = 'pendente' WHERE id_loja ='$id_loja'";
		    $conexao->query($sql);
		    $_SESSION['carro_pago'] =  true;
	     	header('Location: listar_carro.php');
		    exit();

// verificar se passou de 1 hora e se não consta uma loja afiliada

		}elseif ($dado['resultado'] > 1 && $id_loja < 1) {
			$valor_acrescido = $dado['resultado'];  
		    $sql = "UPDATE carros SET data_saida = NOW(),verificar_pagamento = 'pago',valor_total = '$tarifa' + (('$tarifa' * 0.5) * '$valor_acrescido' - 1) WHERE id_carro ='$id'";
		    $conexao->query($sql);
		    $_SESSION['carro_pago'] =  true;
	     	header('Location: listar_carro.php');
		    exit();
		}

// verificar se não passou de 1 hora e se consta uma loja afiliada

		if($dado['resultado'] <= 1 && $id_loja >= 1 ){
		 	$sql = "UPDATE carros SET data_saida = NOW(),verificar_pagamento = 'pago',valor_total = '$tarifa' * 0.5 WHERE id_carro ='$id'";
		    $conexao->query($sql);
		    $sql = "UPDATE lojas SET pago_loja = pago_loja + ('$tarifa' * 0.5), verificar_pagamento = 'pendente'   WHERE id_loja ='$id_loja'";
		    $conexao->query($sql);
 			$_SESSION['carro_pago'] =  true;
	     	header('Location: listar_carro.php');
		    exit();

// verificar se não passou de 1 hora e se não consta uma loja afiliada

		}elseif($dado['resultado'] <= 1 && $id_loja < 1){
			$sql = "UPDATE carros SET data_saida = NOW(),verificar_pagamento = 'pago',valor_total = '$tarifa' WHERE id_carro ='$id'";
		    $conexao->query($sql);
 			$_SESSION['carro_pago'] =  true;
	     	header('Location: listar_carro.php');
		    exit();
		}

}else{
		$_SESSION['carro_erro'] =  true;
     	header('Location: listar_carro.php');
     	exit;
	 }


$conexao->close();

header('Location: listar_carro.php');
exit();

?>
