-- Enunciado: Você tem duas tabelas: funcionarios e departamentos. A tabela funcionarios contém informações sobre os funcionários, e a tabela departamentos contém os departamentos da empresa.
-- Escreva uma consulta SQL para listar o nome dos funcionários e o nome do departamento em que eles trabalham, apenas para funcionários que pertencem a um departamento existente.
-- Dica: Use INNER JOIN para essa consulta.

SELECT 
    f.nome AS nome_funcionario,
    d.nome AS nome_departamento
FROM funcionarios f
INNER JOIN departamentos d 
    ON f.departamento_id = d.id;

    