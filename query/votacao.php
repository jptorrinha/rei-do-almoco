<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require '../config/config.php';

$sucesso = array(
  'status' => 'sucesso',
  'mensagem' => 'Voto computado com sucesso.'
);

$erro = array(
  'status' => 'erro',
  'mensagem' => 'Aconteceu algum coisa ao enviar o seu cadastro, tente novamente!'
);

$PDO = db_connect();

// pega os dados do formuário
$id_rei = $_POST['id'];

if(isset($id_rei)){

  // Insere os dados no banco
  $sql = "INSERT INTO voto( id_rei ) VALUES ( :id_rei )";

  try {
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id_rei', $id_rei);

    if ($stmt->execute()){
      echo json_encode($sucesso);
    }else{
      echo json_encode($erro);
    }
  }catch (Exception $e){
    echo $e->getMessage();
  }
}
?>