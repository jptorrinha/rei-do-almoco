<?php
  //abre a conexão
  $PDO = db_connect();

  $sqlMaisVotadoWeek = "
    SELECT
      c.id,
      c.nome,
      c.foto,
      COUNT(*) AS total 
    FROM
      voto v 
      LEFT JOIN
        cadastro c 
        ON c.id = v.id_rei 
    WHERE
      DATE_FORMAT(v.data, '%Y/%m/%d') BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE() 
    GROUP BY
      c.id,
      c.nome,
      c.foto 
    ORDER BY
      total DESC LIMIT 1
  ";
  //busco a referencia do mais votado da semana
  $vWeek = $PDO->prepare($sqlMaisVotadoWeek);
  $vWeek->execute();
  $vencedorWeek = $vWeek->fetch(PDO::FETCH_ASSOC);

  $WeekWin = $vencedorWeek['id'];

  $votosWinWeek = $vencedorWeek['total'];

  $sqlMlastWeek = "
    SELECT
      * 
    FROM
      (
        SELECT
          t2.id_rei,
          count(t2.votos) as vitorias 
        FROM
          (
            SELECT
              t1.id_rei,
              t1.dia,
              total,
              MAX(total) AS votos 
            FROM
              (
                SELECT
                  v.id_rei,
                  DATE_FORMAT(v.data, '%Y/%m/%d') AS dia,
                  COUNT(*) AS total 
                FROM
                  voto v 
                WHERE
                  DATE_FORMAT(v.data, '%Y/%m/%d') BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE() 
                GROUP BY
                  v.id_rei,
                  DATE_FORMAT(v.data, '%Y/%m/%d') 
                ORDER BY
                  dia ASC,
                  total DESC 
              )
              AS t1 
            GROUP BY
              t1.dia
          )
          AS t2 
        GROUP BY
          t2.id_rei
      )
      AS t3 
      LEFT JOIN
        cadastro c 
        ON t3.id_rei = c.id 
    ORDER BY
      vitorias DESC
    LIMIT 1
  ";

  $lastWeekMais = $PDO->prepare($sqlMlastWeek);
  $lastWeekMais->execute();