# -- Criar o banco de dados se ele não existir
# CREATE DATABASE IF NOT EXISTS seu_banco_de_dados;

# -- Usar o banco de dados
# USE seu_banco_de_dados;

# -- Criar um usuário (se necessário) e conceder privilégios
# -- ATENÇÃO: Ajuste 'seu_usuario' e 'sua_senha' conforme necessário
# CREATE USER IF NOT EXISTS 'seu_usuario'@'localhost' IDENTIFIED BY 'sua_senha';
# GRANT ALL PRIVILEGES ON seu_banco_de_dados.* TO 'seu_usuario'@'localhost';
# FLUSH PRIVILEGES;


import mysql.connector
from mysql.connector import Error

def criar_tabela(nome_tabela):
    try:
        # Conectar ao servidor MySQL
        conexao = mysql.connector.connect(
            host="localhost",
            user="seu_usuario",
            password="sua_senha",
            database="seu_banco_de_dados"
        )

        # Criar um cursor para executar comandos SQL
        cursor = conexao.cursor()

        # Definir o comando SQL para criar a tabela
        comando_sql = f"CREATE TABLE {nome_tabela} (id INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(255))"

        # Executar o comando SQL para criar a tabela
        cursor.execute(comando_sql)

        print("Tabela", nome_tabela, "criada com sucesso!")
    except mysql.connector.Error as e:
        print("Erro ao criar a tabela:", e)
    finally:
        if conexao:
            conexao.close()

def main():
    print("Bem-vindo! Este programa irá criar uma nova tabela no MySQL.")
    nome_tabela = input("Por favor, digite o nome da tabela que deseja criar: ")

    criar_tabela(nome_tabela)

if __name__ == "__main__":
    main()
