-- Enunciado: Você possui duas tabelas: funcionarios e departamentos. A tabela funcionarios contém informações sobre os funcionários, e a tabela departamentos contém os departamentos.
-- Escreva uma consulta SQL que exiba todos os departamentos, juntamente com o nome dos funcionários que trabalham nesses departamentos. Se um departamento não tiver funcionários, o nome do funcionário deve aparecer como NULL.
-- Dica: Use RIGHT JOIN para essa consulta.

SELECT 
    f.nome AS nome_funcionario,
    d.nome AS nome_departamento
FROM funcionarios f
RIGHT JOIN departamentos d 
    ON f.departamento_id = d.id;