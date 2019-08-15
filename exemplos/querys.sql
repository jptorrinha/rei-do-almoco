SELECT
c.id,
c.nome,
c.foto,
c.data, 
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




SELECT t1.dia, t1.nome, t1.foto, MAX(total) AS votos FROM
(SELECT 
	c.nome, c.foto, DATE_FORMAT(v1.data,'%Y/%m/%d') AS dia, count(c.id) AS total
FROM 
	(SELECT * FROM voto WHERE DATE_FORMAT(data,'%Y/%m/%d')  BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() ) AS v1
    LEFT JOIN cadastro c  ON v1.id_rei = c.id 
GROUP BY 
	c.nome, DATE_FORMAT(v1.data,'%Y/%m/%d')) AS t1
GROUP BY t1.dia