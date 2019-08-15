<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlWins = "
    SELECT t1.dia, t1.id_rei, c.nome, c.foto, MAX(total) AS votos FROM
    ( SELECT v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') AS dia, count(*) AS total
    FROM voto v 
    WHERE DATE_FORMAT(data,'%Y/%m/%d')  BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()
    GROUP BY v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') ORDER BY total DESC) AS t1 
    LEFT JOIN cadastro c on t1.id_rei = c.id
    GROUP BY t1.dia 
    ORDER BY dia DESC LIMIT 1
  ";

  $wins = $PDO->prepare($sqlWins);
  $wins->execute();
  $win = $wins->fetch(PDO::FETCH_ASSOC);

  $winVotos = $win['votos'];
  $winFoto  = $win['foto'];
  $winNome  = $win['nome'];
  $winId    = $win['id_rei'];
  
