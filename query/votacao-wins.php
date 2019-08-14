<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlWins = "
    SELECT 
      c.id,
      c.nome,
      c.foto,
      (SELECT count(*) FROM voto v WHERE c.id = v.id_rei) as votos
    FROM cadastro c
    ORDER BY votos DESC
  ";
  $sqlWin = "SELECT * FROM cadastro WHERE id = :id";

  $wins = $PDO->prepare($sqlWins);
  $wins->execute();
  $win = $wins->fetch(PDO::FETCH_ASSOC);

  $winVotos = $win['votos'];
  $winFoto = $win['foto'];
  $winNome = $win['nome'];
  $winId = $win['id'];
  