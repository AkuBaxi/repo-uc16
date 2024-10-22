-- Enunciado: Ainda utilizando as tabelas funcionarios e departamentos, escreva uma consulta SQL que exiba todos os funcionários, juntamente com o nome do departamento. No entanto, se algum funcionário não estiver associado a um departamento existente, o nome do departamento deve aparecer como NULL.
-- Dica: Use LEFT JOIN para essa consulta.

SELECT 
    f.nome AS nome_funcionario,
    d.nome AS nome_departamento
FROM funcionarios f
LEFT JOIN departamentos d 
    ON f.departamento_id = d.id;