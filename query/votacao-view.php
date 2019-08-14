<?php
	//dates and times
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('Y-m-d');

  $horaStart = strtotime("10:00:00");
  $horaEnd = strtotime("14:01:00");
  $horaShow = strtotime("14:02:00");
  $time = strtotime('now');
  //end dates and times

  //abre a conexão
  $PDO = db_connect();

  $sqlCandidatos = "SELECT * FROM cadastro WHERE data = '$data' ORDER BY nome ASC";

  $candidatos = $PDO->prepare($sqlCandidatos);
  $candidatos->execute();
  $contador = $candidatos->rowCount();