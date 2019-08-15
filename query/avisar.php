<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include '../config/config.php';

$PDO = db_connect();

$sendEmail = array(
	'status' => 'enviado',
	'mensagem' => 'Aviso enviado com sucesso!'
);

$erroEmail = array(
	'status' => 'erro',
	'mensagem' => 'Aconteceu algum coisa ao enviar o convite, tente novamente!'
);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

$id = $_POST['id'];

//Consulto o e-mail no banco de dados
$sql = "SELECT * FROM cadastro WHERE id = :id";
$winSend = $PDO->prepare($sql);
$winSend->bindParam(':id', $id);
$winSend->execute();
$win = $winSend->fetch(PDO::FETCH_ASSOC);

$nome = $win['nome'];
$email = $win['email'];
$assunto = "Você foi o vencedor do dia!!!";
$mensagem = "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><title>Vencedor</title></head><body><div><table style='width: 500px;'><tr><td style='text-align: center;'><h1>Parabéns!!!!</h1></td></tr><tr><td style='text-transform: uppercase; text-align: center;' >{$nome}</td></tr><tr><td style='text-align: center;'>Você foi coroado o Rei do Almoço do dia!</td></tr><tr><td style='text-align: center;'>Sua coroação será em breve, aguarde o comunicado do RH.</td></tr></table></div></body></html>";
$mensagemAltBody = "Parabéns, você foi coroado o Rei do Almoço do dia!!!";

/* Declaração de credencias e host pra disparo de email, nos testes foi usado o Office 365 */
$userServer = ""; // Usuário do servidor SMTP
$userPassword = ""; // Senha do servidor SMTP
$serverSMTP = ""; //Servidor SMTP


/* apenas dispara o envio do formulário caso exista o ID do ganhador */
if(isset($id)){

	$mail = new PHPMailer();

	$mail->SMTPDebug = 0;
	$mail->IsSMTP();
	$mail->IsHTML();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'TLS';
	$mail->CharSet  = 'UTF-8';
	$mail->Host  = $serverSMTP;
	$mail->Port  = '587';
	$mail->Username = $userServer;
	$mail->Password = $userPassword;
	$mail->From  = $userServer;
	$mail->FromName  = $assunto;
	$mail->Subject  = $assunto;
	$mail->Body  = $mensagem;
	$mail->AltBody = $mensagemAltBody;
	$mail->AddAddress($email,$nome);

	try{
		if(!$mail->Send()){
			echo json_encode($erroEmail);
		}else{
			echo json_encode($sendEmail);
		}
	}catch (Exception $e){
		echo $e;
	}
}


