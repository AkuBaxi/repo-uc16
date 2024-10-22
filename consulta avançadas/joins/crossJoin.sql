-- Enunciado: Suponha que você deseja gerar uma lista de todas as combinações possíveis entre os funcionários e os departamentos. Ou seja, você deseja ver todos os funcionários combinados com todos os departamentos, independentemente de qual departamento eles realmente pertencem.
-- Escreva uma consulta SQL para gerar essas combinações.
-- Dica: Use CROSS JOIN para essa consulta.

SELECT 
    f.nome AS nome_funcionario,
    d.nome AS nome_departamento
FROM funcionarios f
CROSS JOIN departamentos d;