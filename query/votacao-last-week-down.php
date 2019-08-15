<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlMlastWeekDown = "
    SELECT t1.dia, t1.id_rei, c.nome, c.foto, MIN(total) AS votos FROM
    ( SELECT v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') AS dia, count(*) AS total
    FROM voto v 
    WHERE DATE_FORMAT(data,'%Y/%m/%d')  BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()
    GROUP BY v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') ORDER BY total ASC) AS t1 
    LEFT JOIN cadastro c ON t1.id_rei = c.id
    GROUP BY t1.dia 
    ORDER BY dia ASC
  ";

  $lastWeekDown = $PDO->prepare($sqlMlastWeekDown);
  $lastWeekDown->execute();