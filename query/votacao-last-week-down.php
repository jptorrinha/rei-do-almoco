<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlMlastWeek = "
    SELECT t1.dia, t1.nome, t1.foto, MIN(total) AS votos FROM
    ( SELECT c.id, c.nome, c.foto, v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') AS dia, count(*) AS total
    FROM voto v 
    LEFT JOIN cadastro c  ON v.id_rei = c.id 
    GROUP BY c.id, DATE_FORMAT(v.data,'%Y/%m/%d') ) AS t1
    GROUP BY t1.dia ORDER BY dia DESC LIMIT 5
  ";

  $lastWeekDown = $PDO->prepare($sqlMlastWeek);
  $lastWeekDown->execute();