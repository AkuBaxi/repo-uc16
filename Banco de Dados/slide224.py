# -- Criar o banco de dados se ele não existir
# CREATE DATABASE IF NOT EXISTS seu_banco_de_dados;

# -- Usar o banco de dados
# USE seu_banco_de_dados;

# -- Criar a tabela dados_usuario
# CREATE TABLE IF NOT EXISTS dados_usuario (
#     id INT AUTO_INCREMENT PRIMARY KEY,
#     nome VARCHAR(100) NOT NULL,
#     email VARCHAR(100) NOT NULL UNIQUE,
#     idade INT NOT NULL
# );


import tkinter as tk
from tkinter import messagebox
import mysql.connector

def enviar_dados(nome, email, idade):
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

        # Definir o comando SQL para inserir os dados na tabela
        comando_sql = "INSERT INTO dados_usuario (nome, email, idade) VALUES (%s, %s, %s)"
        valores = (nome, email, idade)

        # Executar o comando SQL para inserir os dados
        cursor.execute(comando_sql, valores)

        # Commit para salvar as alterações no banco de dados
        conexao.commit()

        messagebox.showinfo("Sucesso", "Dados enviados com sucesso!")
    except mysql.connector.Error as e:
        messagebox.showerror("Erro", "Erro ao enviar os dados: " + str(e))
    finally:
        if conexao:
            conexao.close()

def enviar_formulario():
    nome = entry_nome.get()
    email = entry_email.get()
    idade = entry_idade.get()

    if nome.strip() == '' or email.strip() == '' or idade.strip() == '':
        messagebox.showerror("Erro", "Por favor, preencha todos os campos.")
    else:
        enviar_dados(nome, email, idade)

# Criar a janela principal
janela = tk.Tk()
janela.title("Cadastro de Usuário")

# Criar os campos de entrada e rótulos
tk.Label(janela, text="Nome:").grid(row=0, column=0, padx=10, pady=5)
entry_nome = tk.Entry(janela)
entry_nome.grid(row=0, column=1, padx=10, pady=5)

tk.Label(janela, text="Email:").grid(row=1, column=0, padx=10, pady=5)
entry_email = tk.Entry(janela)
entry_email.grid(row=1, column=1, padx=10, pady=5)

tk.Label(janela, text="Idade:").grid(row=2, column=0, padx=10, pady=5)
entry_idade = tk.Entry(janela)
entry_idade.grid(row=2, column=1, padx=10, pady=5)

# Botão para enviar o formulário
botao_enviar = tk.Button(janela, text="Enviar", command=enviar_formulario)
botao_enviar.grid(row=3, column=0, columnspan=2, padx=10, pady=5)

# Iniciar o loop de eventos
janela.mainloop()
