<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

//date para cadastro
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');

require '../config/config.php';

$sucesso = array(
  'status' => 'sucesso',
  'mensagem' => 'Candidato cadastrado com sucesso.'
);

$erro = array(
  'status' => 'erro',
  'mensagem' => 'Aconteceu algum coisa ao enviar o seu cadastro, tente novamente!'
);

$erro_email = array(
  'status' => 'email_cadastrado',
  'mensagem' => 'Ops! Esse e-mail já está cadastrado!'
);

$enviado = '';
$thisPath = dirname($_SERVER['DOCUMENT_ROOT']);

//URL definda da aplicação
$url = "http://localhost:8888/rei-do-almoco/uploads/";
$dir = '/htdocs/rei-do-almoco/uploads/';

$PDO = db_connect();

// pega os dados do formuário
$foto = $_FILES['foto'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$data = $_POST['data'];

if(isset($nome)){

  //consulta se o email já existe no banco
  $sqlCount = "
  SELECT * FROM cadastro WHERE email = :email
  ";
  $reis = $PDO->prepare($sqlCount);
  $reis->bindParam(':email', $email);
  $reis->execute();
  $contador = $reis->rowCount();

  if($contador > 0){
    echo json_encode($erro_email);
    exit;
  }

  $nomeImg = "candidato-" . sanitizeString($nome);

  if(!empty($foto)) {
    //pega a extensao do arquivo
    $extensao = strtolower(substr($_FILES['foto']['name'], -4));

    //define o nome do arquivo
    $imagem = $nomeImg . $extensao;

    //define o nome do arquivo para URl no Banco de Dados
    $URL_img = $url . $nomeImg . $extensao; 

    //define o diretorio para onde enviaremos o arquivo
    $diretorio = $thisPath.$dir; 

    //efetua o upload
    move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$imagem);

    $enviado = true;
  }

  // Insere os dados no banco
  $sql = "INSERT INTO 
    cadastro(
      foto, 
      nome, 
      email,
      data
    )VALUES(
      :foto, 
      :nome, 
      :email,
      :data
    )";

  if($enviado){
    try {
      $stmt = $PDO->prepare($sql);
      $stmt->bindParam(':foto', $URL_img);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':data', $data);

      if ($stmt->execute()){
        echo json_encode($sucesso);
      }else{
        echo json_encode($erro);
      }
    }catch (Exception $e){
      echo $e->getMessage();
    }
  }
}
?>