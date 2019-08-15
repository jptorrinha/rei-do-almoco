<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlWins = "
    SELECT 
      c.id,
      c.nome,
      c.foto,
      c.data,
      (SELECT count(*) FROM voto v WHERE c.id = v.id_rei) as votos
    FROM cadastro c
    WHERE data = '$data'
    ORDER BY votos DESC LIMIT 1
  ";

  $wins = $PDO->prepare($sqlWins);
  $wins->execute();
  $win = $wins->fetch(PDO::FETCH_ASSOC);

  $winVotos = $win['votos'];
  $winFoto  = $win['foto'];
  $winNome  = $win['nome'];
  $winId    = $win['id'];
  
