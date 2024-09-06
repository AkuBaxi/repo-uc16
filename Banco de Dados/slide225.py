# -- Create the database
# CREATE DATABASE IF NOT EXISTS seu_banco_de_dados;

# -- Use the database
# USE seu_banco_de_dados;

# -- Create the users table
# CREATE TABLE IF NOT EXISTS usuarios (
#     id INT AUTO_INCREMENT PRIMARY KEY,
#     usuario VARCHAR(50) NOT NULL UNIQUE,
#     senha VARCHAR(255) NOT NULL
# );

# -- Insert some sample data (optional)
# INSERT INTO usuarios (usuario, senha) VALUES
# ('admin', 'admin123'),
# ('user1', 'password123');

import tkinter as tk
from tkinter import messagebox
import mysql.connector

def verificar_login(usuario, senha):
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

        # Executar uma consulta para verificar se o usuário e senha correspondem
        cursor.execute("SELECT * FROM usuarios WHERE usuario = %s AND senha = %s", (usuario, senha))

        # Obter o resultado da consulta
        resultado = cursor.fetchone()

        if resultado:
            messagebox.showinfo("Sucesso", "Login bem-sucedido!")
            # Aqui você pode alterar a interface para a tela de conexão bem-sucedida
            # Por exemplo, esconder a janela de login e exibir uma nova janela ou widget com a tela de conexão
        else:
            messagebox.showerror("Erro", "Usuário ou senha incorretos.")

    except mysql.connector.Error as e:
        messagebox.showerror("Erro", "Erro ao verificar o login: " + str(e))
    finally:
        if conexao:
            conexao.close()

def realizar_login():
    usuario = entry_usuario.get()
    senha = entry_senha.get()

    if usuario.strip() == '' or senha.strip() == '':
        messagebox.showerror("Erro", "Por favor, preencha todos os campos.")
    else:
        verificar_login(usuario, senha)

# Criar a janela principal
janela = tk.Tk()
janela.title("Login")

# Criar os campos de entrada e rótulos para usuário e senha
tk.Label(janela, text="Usuário:").grid(row=0, column=0, padx=10, pady=5)
entry_usuario = tk.Entry(janela)
entry_usuario.grid(row=0, column=1, padx=10, pady=5)

tk.Label(janela, text="Senha:").grid(row=1, column=0, padx=10, pady=5)
entry_senha = tk.Entry(janela, show="*")
entry_senha.grid(row=1, column=1, padx=10, pady=5)

# Botão para realizar o login
botao_login = tk.Button(janela, text="Login", command=realizar_login)
botao_login.grid(row=2, column=0, columnspan=2, padx=10, pady=5)

# Iniciar o loop de eventos
janela.mainloop()


