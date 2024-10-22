-- Enunciado: Usando a tabela funcionarios, escreva uma consulta SQL para encontrar funcionários que tenham o mesmo salário. Liste o nome de dois funcionários e o salário que eles têm em comum.
-- Dica: Use SELF JOIN para comparar os salários dentro da mesma tabela.

SELECT 
    f1.nome AS funcionario1,
    f2.nome AS funcionario2,
    f1.salario AS salario_comum
FROM funcionarios f1
INNER JOIN funcionarios f2 
    ON f1.salario = f2.salario
    AND f1.id < f2.id;