<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlMlastWeek = "
    SELECT t2.id_rei, t2.nome, t2.foto, count(*) AS vitorias FROM
    (SELECT t1.dia, t1.id_rei, c.nome, c.foto, MAX(total) AS votos FROM
      ( SELECT v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') AS dia, count(*) AS total
      FROM voto v 
      WHERE DATE_FORMAT(data,'%Y/%m/%d') BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()
      GROUP BY v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') ORDER BY total DESC) AS t1 
    LEFT JOIN cadastro c on t1.id_rei = c.id
    GROUP BY t1.dia 
    ORDER BY dia ASC ) AS t2
    GROUP BY t2.nome LIMIT 1
  ";

  $lastWeekMais = $PDO->prepare($sqlMlastWeek);
  $lastWeekMais->execute();