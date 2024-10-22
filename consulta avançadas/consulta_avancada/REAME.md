-- Criação do banco de dados
CREATE DATABASE loja_produtos;
USE loja_produtos;

-- Criação da tabela de produtos
CREATE TABLE produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50),
    tamanho VARCHAR(20),
    cor VARCHAR(30),
    preco DECIMAL(10,2),
    quantidade_estoque INT,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Inserindo alguns dados de exemplo
INSERT INTO produtos (nome, categoria, tamanho, cor, preco, quantidade_estoque) VALUES
('Camiseta Básica', 'Vestuário', 'M', 'Branco', 49.90, 100),
('Tênis Esportivo', 'Calçados', '42', 'Preto', 199.90, 50),
('Mochila Escolar', 'Acessórios', 'Único', 'Azul', 89.90, 30),
('Calça Jeans', 'Vestuário', 'G', 'Azul', 129.90, 75),
('Boné Casual', 'Acessórios', 'Único', 'Vermelho', 39.90, 60);

-- Adicionando coluna de imagem na tabela produtos
ALTER TABLE produtos ADD COLUMN imagem VARCHAR(255) AFTER nome;

-- Criando tabela de usuários
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nivel ENUM('admin', 'usuario') DEFAULT 'usuario',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Inserindo um usuário admin padrão (senha: admin123)
INSERT INTO usuarios (nome, email, senha, nivel) 
VALUES ('Administrador', 'admin@sistema.com', '$2y$10$8tNYDWxBDLu9pHok1HPbv.WqXJ4e9RwUh5VNWmqVx8kKzkWlnE9Ke', 'admin');