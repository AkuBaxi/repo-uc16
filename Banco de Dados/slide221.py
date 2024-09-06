# -- Este comando cria um novo banco de dados
# -- Substitua 'nome_do_banco' pelo nome desejado
# CREATE DATABASE nome_do_banco;

# -- Use o banco de dados recém-criado
# USE nome_do_banco;

# -- Opcionalmente, você pode conceder privilégios a um usuário específico
# -- GRANT ALL PRIVILEGES ON nome_do_banco.* TO 'seu_usuario'@'localhost';
# -- FLUSH PRIVILEGES;


import mysql.connector
from mysql.connector import Error

def banco_de_dados(nome_banco):
    try:
        conn = mysql.connector.connect(
            host='localhost',
            user='root',  
            password=''  
        )
        
        if conn.is_connected():
            cursor = conn.cursor()
            cursor.execute(f"CREATE DATABASE {nome_banco}")
            print(f"Banco de dados '{nome_banco}' criado com sucesso!")
        else:
            print("Erro ao conectar ao MySQL.")
        
    except Error as e:
        print(f"Erro: {e}")
    
    finally:a
    if conn.is_connected():
            cursor.close()
            conn.close()


def cap():
    nome_banco = input("Digite o nome do banco de dados que deseja criar: ")  
    banco_de_dados(nome_banco)
    
if __name__ == "__main__":
    main()
