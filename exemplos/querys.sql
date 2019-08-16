SELECT
c.id,
c.nome,
c.foto,
v.data, 
(SELECT count(*) FROM voto v WHERE c.id = v.id_rei) as votos
FROM cadastro c WHERE data BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()
ORDER BY votos DESC

SELECT *, MAX(data) AS mais_votado FROM voto t1 INNER JOIN cadastro t2 USING id_rei WHERE t2.data DATE_SUB(mais_votado, INTERVAL 1 WEEK) LIMIT 5


SELECT * FROM voto WHERE data = DATE_SUB(NOW(), INTERVAL 1 WEEK)

SELECT *,WEEK(data),
   WEEK(data,1),WEEK(data,2), WEEK(data,3), WEEK(data,4), WEEK(data,5), WEEK(data,6), WEEK(data,7)
    FROM voto;

  t1.id_rei, c.nome,  DATE_FORMAT(t1.data,'%Y/%m/%d'), COUNT(*) FROM 
(SELECT * FROM voto WHERE data BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() ) AS t1 LEFT JOIN cadastro c ON t1.id_rei = c.id
GROUP BY DATE_FORMAT(t1.data,'%Y/%m/%d')

SELECT id_rei, COUNT(*) AS votos FROM voto WHERE DATA(data) = '2019-08-16' GROUP BY id_rei HAVING COUNT(*) > 1 ORDER BY votos DESC;

SELECT t1.dia, t1.nome, Max(total) AS maximo FROM
(SELECT 
	c.*, DATE_FORMAT(v.data,'%Y/%m/%d') AS dia, count(*) AS total
FROM 
	voto v 
    LEFT JOIN cadastro c  ON v.id_rei = c.id 
GROUP BY 
	c.nome, DATE_FORMAT(v.data,'%Y/%m/%d')) AS t1
GROUP BY t1.dia



Select count(t2.nome) as quantidade, t2.nome, t2.foto from
(Select t1.dia, t1.nome, t1.foto, Max(total) 
 from
	(select 
		c.nome, c.foto, DATE_FORMAT(v.data,'%Y/%m/%d') as dia, count(*) as total
	from 
		voto v 
		left join cadastro c  on v.id_rei = c.id 
	group by 
		c.nome, DATE_FORMAT(v.data,'%Y/%m/%d')) as t1
group by t1.dia) as t2
group by t2.nome


UPDATE voto SET data = replace( data, '2019-08-16', '2019-08-15' );

SELECT t1.dia, t1.nome, t1.foto, MAX(total) AS votos FROM
(SELECT 
	c.id, c.nome, c.foto, DATE_FORMAT(v1.data,'%Y/%m/%d') AS dia, count(c.id) AS total
FROM 
	(SELECT * FROM voto WHERE DATE_FORMAT(data,'%Y/%m/%d')  BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() ) AS v1
    LEFT JOIN cadastro c  ON v1.id_rei = c.id 
GROUP BY 
	c.nome, DATE_FORMAT(v1.data,'%Y/%m/%d')) AS t1
GROUP BY votos ASC


SELECT t2.id_rei, t2.nome, t2.foto, count(*) FROM
(SELECT t1.dia, t1.id_rei, c.nome, c.foto, MAX(total) AS votos FROM
    ( SELECT v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') AS dia, count(*) AS total
    FROM voto v 
    WHERE DATE_FORMAT(data,'%Y/%m/%d')  BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()
    GROUP BY v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') ORDER BY total DESC) AS t1 
LEFT JOIN cadastro c ON t1.id_rei = c.id
GROUP BY t1.dia 
ORDER BY dia ASC ) AS t2
ORDER BY t2.nome limit 1


SELECT 
  c.id,
  c.nome,
  c.foto,
  (SELECT COUNT(*) FROM voto v WHERE c.id = v.id_rei) AS votos
FROM cadastro AS c
WHERE DATE(data) = '2018-08-16'
ORDER BY votos DESC

SELECT t2.id_rei, t2.nome, t2.foto, count(*) AS vitorias FROM
(SELECT t1.dia, t1.id_rei, c.nome, c.foto, MAX(total) AS votos FROM
  ( SELECT v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') AS dia, count(*) AS total
  FROM voto v 
  WHERE DATE_FORMAT(data,'%Y/%m/%d')  BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()
  GROUP BY v.id_rei, DATE_FORMAT(v.data,'%Y/%m/%d') ORDER BY dia ASC, total DESC) AS t1 
LEFT JOIN cadastro c ON t1.id_rei = c.id
GROUP BY t1.dia 
ORDER BY dia ASC ) AS t2
GROUP BY t2.nome ORDER BY vitorias DESC



///final
SELECT
  t2.id_rei,
  t2.nome,
  t2.foto,
  count(*) AS vitorias 
FROM
  (
    SELECT
      t1.dia,
      t1.id_rei,
      c.nome,
      c.foto,
      MAX(total) AS votos 
    FROM
      (
        SELECT
          v.id_rei,
          DATE_FORMAT(v.data, '%Y/%m/%d') AS dia,
          count(*) AS total 
        FROM
          voto v 
        WHERE
          DATE_FORMAT(data, '%Y/%m/%d') BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE() 
        GROUP BY
          v.id_rei,
          DATE_FORMAT(v.data, '%Y/%m/%d') 
        ORDER BY
          dia ASC,
          total DESC
      )
      AS t1 
      LEFT JOIN
        cadastro c 
        ON t1.id_rei = c.id 
        WHERE t1.id_rei = c.id 
    GROUP BY
      t1.dia 
    ORDER BY
      dia ASC 
  )
  AS t2 
GROUP BY
  t2.nome 
ORDER BY
  vitorias DESC



