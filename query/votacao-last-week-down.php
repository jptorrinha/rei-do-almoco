<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlMlastWeek = "
    SELECT
    c.id,
    c.nome,
    c.foto,
    c.data, 
    (SELECT count(*) FROM voto v WHERE c.id = v.id_rei) as votos
    FROM cadastro c WHERE data BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()
    ORDER BY votos ASC LIMIT 5
  ";

  $lastWeekDown = $PDO->prepare($sqlMlastWeek);
  $lastWeekDown->execute();