<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlMlastWeekDown = "
    SELECT c.id, c.nome, c.foto, count(*) AS total
    FROM voto v LEFT JOIN cadastro c ON c.id = v.id_rei
    WHERE DATE_FORMAT(v.data,'%Y/%m/%d')  BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()
    GROUP BY c.id, c.nome, c.foto ORDER BY total ASC LIMIT 1
  ";

  $lastWeekDown = $PDO->prepare($sqlMlastWeekDown);
  $lastWeekDown->execute();