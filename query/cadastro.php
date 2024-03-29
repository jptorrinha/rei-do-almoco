<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

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
$dir = '/htdocs/rei-do-almoco/uploads/';

$PDO = db_connect();

// pega os dados do formuário
$foto = $_FILES['foto'];
$nome = $_POST['nome'];
$email = $_POST['email'];

if(isset($nome)){

  //consulta se o email já existe no banco
  $sqlCount = "SELECT * FROM cadastro WHERE email = :email";
  $reis = $PDO->prepare($sqlCount);
  $reis->bindParam(':email', $email);
  $reis->execute();
  $rei = $reis->fetch(PDO::FETCH_ASSOC);

  /* 
    =======================================================================
    Regra de cadastro com apenas um email por dia.
    Se já existir o email no banco não pode cadastrar novamente.
    =======================================================================
  */

  /* START REGRA DO CDASTRO */
  if($email === $rei['email']){
    echo json_encode($erro_email);
    exit;
  }
  /* START REGRA DO CDASTRO */

  $nomeImg = "candidato-" . sanitizeString($nome);

  if(!empty($foto)) {
    //pega a extensao do arquivo
    $extensao = strtolower(substr($_FILES['foto']['name'], -4));

    //define o nome do arquivo
    $imagem = $nomeImg . $extensao;

    //define o nome do arquivo para URl no Banco de Dados
    $URL_img = $nomeImg . $extensao; 

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
      email
    )VALUES(
      :foto, 
      :nome, 
      :email
    )";

  if($enviado){
    try {
      $stmt = $PDO->prepare($sql);
      $stmt->bindParam(':foto', $URL_img);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':email', $email);

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