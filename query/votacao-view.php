<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlCandidatos = "SELECT * FROM cadastro WHERE data = '$data' ORDER BY nome ASC";

  $candidatos = $PDO->prepare($sqlCandidatos);
  $candidatos->execute();
  $contador = $candidatos->rowCount();