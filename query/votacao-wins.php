<?php
  //abre a conexão
  $PDO = db_connect();

  //seleciono o que tem mis votos
  $sqlWins = "
    SELECT id_rei, COUNT(*) AS votos FROM voto WHERE DATE(data) = :data GROUP BY id_rei HAVING COUNT(*) > 1 ORDER BY votos DESC LIMIT 1";
  $wins = $PDO->prepare($sqlWins);
  $wins->bindParam(':data', $data);
  $wins->execute();
  $win = $wins->fetch(PDO::FETCH_ASSOC);
  $winId    = $win['id_rei'];
  $winVotos = $win['votos'];

  //busco a referencia do mais votado
  $sqlVencedor = "SELECT * FROM cadastro WHERE id = :id";
  $vencedores = $PDO->prepare($sqlVencedor);
  $vencedores->bindParam(':id', $winId);
  $vencedores->execute();
  $vencedor = $vencedores->fetch(PDO::FETCH_ASSOC);

  $vNome  = $vencedor['nome'];
  $vFoto  = $vencedor['foto'];
  $vVotos = $winVotos;
  $vID    = $winId;
  
