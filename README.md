# REI DO ALMOÇO

<b>Aplicação: Rei do Almoço.</b>

<b>Descrição do projeto</b>

O projeto precisa armazenar candidatos para votação. 

Esta votação ocorre diariamente, sendo assim os usuários podem candidatar-se apenas uma vez, pois o e-mail está como UNIQUE no banco.

Para prevenir que um usuário de se candidatar mais vezes, o e-mail será utilizado como informação única de cada usuário, portanto não pode existir duplicidade de um e-mail no dia em questão.

A aplicação deve funcionar somente durante o horário de almoço (previamente configurado para ocorrer entre 10:00 e 12:00 tendo como tolerância 12:01).

<b>Configurações do projeto</b>

Requerimentos: MySql, PHP 7.* e uma conexão com a internet (visto que somente com conexão com a internet para enviar e-mails de notificação).

<b>Configurando o Mysql</b>

Importe o banco MySQL
Path do arquivo database/rei_do_almoco.sql

<b>Configurando a conexão do MySql</b>

Acesse config/config.php

Altere as linhas: 4, 5, 6 e 7 conforme as especificações da sua conexão com o banco de dados.

define('DB_HOST', 'localhost');<br>
define('DB_USER', 'root');<br>
define('DB_PASS', 'root');<br>
define('DB_NAME', 'rei_do_almoco');<br>

<b>Configurando o servidor de e-mail para disparar emails de notificação</b>

Acesse query/aviar.php

Altere as linhas: 41, 42 e 43

$userServer 	= ""; 	Usuário do servidor SMTP email<br>
$userPassword = ""; 	Senha do servidor SMTP (senha)<br>
$serverSMTP 	= ""; 	Servidor SMTP<br>
