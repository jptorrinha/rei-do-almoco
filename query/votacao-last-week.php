<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlMlastWeek = "
    SELECT t1.dia, t1.nome, t1.foto, Max(total) AS maximo FROM
    (SELECT 
      c.nome, c.foto, DATE_FORMAT(v.data,'%Y/%m/%d') AS dia, count(*) AS total
    FROM 
      voto v 
        LEFT JOIN cadastro c  ON v.id_rei = c.id 
    GROUP BY 
      c.nome, DATE_FORMAT(v.data,'%Y/%m/%d')) AS t1
    GROUP BY t1.dia LIMIT 5
  ";

  $lastWeekMais = $PDO->prepare($sqlMlastWeek);
  $lastWeekMais->execute();