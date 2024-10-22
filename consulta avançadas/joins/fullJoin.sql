-- Enunciado: Usando as tabelas funcionarios e departamentos, escreva uma consulta SQL que exiba todos os funcionários e todos os departamentos, independentemente de haver ou não correspondência entre eles. Ou seja, a consulta deve listar:
-- Todos os funcionários com seus respectivos departamentos (se existir).
-- Todos os departamentos, mesmo que não tenham funcionários.
-- Dica: Como o MySQL não suporta diretamente o FULL JOIN, você pode simular com um LEFT JOIN e um RIGHT JOIN combinados usando UNION.

SELECT 
    f.nome AS nome_funcionario,
    d.nome AS nome_departamento
FROM funcionarios f
LEFT JOIN departamentos d 
    ON f.departamento_id = d.id

UNION

SELECT 
    f.nome AS nome_funcionario,
    d.nome AS nome_departamento
FROM funcionarios f
RIGHT JOIN departamentos d 
    ON f.departamento_id = d.id
WHERE f.id IS NULL;