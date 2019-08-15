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
    ORDER BY votos DESC LIMIT 5
  ";

  $lastWeekMais = $PDO->prepare($sqlMlastWeek);
  $lastWeekMais->execute();
  //$WinsWeek = $lastWeekMais->fetch(PDO::FETCH_ASSOC);
  //$contador = $lastWeekMais->rowCount();